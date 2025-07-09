<?php

namespace App\Mainframe\Features\Report\Traits;

use DB;
use Str;
use Cache;
use Exception;
use App\Mainframe\Helpers\Mf;
use App\Mainframe\Helpers\Convert;
use Illuminate\Database\Query\Builder;
use App\Mainframe\Features\Report\ReportBuilder;

/** @mixin ReportBuilder $this */
trait Query
{
    /**
     * Set the table or model query as the primary data source
     *
     * @param  Builder|\Illuminate\Database\Eloquent\Model|string  $dataSource
     * @return $this
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource ?: $this->dataSource;

        // If a table name is given then set the table
        if (is_string($this->dataSource)) {
            $this->table = $this->dataSource;
        }

        return $this;
    }

    /**
     * Build query to get the data.
     *
     * @return Builder
     */
    public function resultQuery()
    {
        $query = clone $this->queryDataSource(); # Get Datasource query instance

        $query = $this->querySelect($query); # Select columns

        $query = $this->filter($query); # Apply filters

        $query = $this->injectTenantQuery($query); # Inject tenant

        $query = $this->groupBy($query); # Apply group-by

        $query = $this->orderBy($query); # Apply Order-by

        return $query;
    }

    public function querySelect($query)
    {
        if (count($this->querySelectColumns())) {
            $query->select($this->querySelectColumns());
        }

        return $query;
    }

    public function injectTenantQuery($query)
    {
        # Inject tenant context
        if ($this->user->ofTenant() && $this->hasTenantContext()) {
            $query->where('tenant_id', $this->user->tenant_id);
        }

        return $query;
    }

    /**
     * Check if data source has tenant field
     *
     * @return bool
     */
    public function hasTenantContext()
    {
        return $this->fieldExists('tenant_id');
    }

    /**
     * @return array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function result()
    {
        /*
        |--------------------------------------------------------------------------
        | Note cache results
        |--------------------------------------------------------------------------
        */
        // $this->result = $this->result ?: $this->resultQuery()->paginate($this->rowsPerPage());
        // return $this->result;
        /*
        |--------------------------------------------------------------------------
        | Note cached results
        |--------------------------------------------------------------------------
        */
        try {
            if ($this->result) {
                return $this->result;
            }

            $key = __CLASS__.'-'.Mf::urlKey('result', ['ret']);

            $this->result = Cache::remember($key, $this->cache, function () {
                return $this->resultQuery()->paginate($this->rowsPerPage());
            });

        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }

        return $this->result ?: []; // Return an empty array to gracefully handle iterated loop

    }

    /**
     * Rows per page. If grouped then show all rows.
     *
     * @return mixed
     */
    public function rowsPerPage()
    {

        $total = $this->total();

        // For groupBy query show all in one page
        if ($this->hasGroupBy() || $this->expectsAllData()) {
            return $total ?: 1;
        }

        $rowsPerPage = request('rows_per_page', $this->rowsPerPage ?? 50);

        if (strtolower($rowsPerPage) == 'all') {
            return 9999999; // A very large number
        }
        return $rowsPerPage;
    }

    /**
     * Get total number of rows
     *
     * @return int
     */
    public function total()
    {
        try {
            if ($this->total && is_int($this->total)) {
                return $this->total;
            }
            $key = __CLASS__.'-'.Mf::urlKey('total', ['ret']).'-total';

            $this->total = Cache::remember($key, $this->cache, function () {
                return $this->totalQuery()->count();
            });

            return $this->total;
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        return $this->total;

    }

    /**
     * Query to get total number of rows
     *
     * @return \Illuminate\Database\Eloquent\Model|Builder|mixed|string
     */
    public function totalQuery()
    {
        $query = clone $this->queryDataSource();
        $query = $this->filter($query);

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | Build query
    |--------------------------------------------------------------------------
    |
    | Below is a step-by-step query building process broken down into  all
    | possible units. Functions are used instead of variables to define
    | some of the configuration so that logic an be applied inside
    | the function if needed.
    |
    */

    /**
     * Query to initially select table or a model.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|Builder
     */
    public function queryDataSource()
    {
        // Source is a table
        if (is_string($this->dataSource)) {
            return DB::table($this->dataSource);
        }

        // Source is a model/collection
        return $this->dataSource;
    }

    /**
     * Construct the SQL SELECTS for the final query.
     *
     * @return array
     */
    public function querySelectColumns()
    {
        $keys = $this->selectedColumns();                    // Manually selected columns, Default all if none selected.
        $keys = $this->includeDefaultColumns($keys); // Default selected columns behind the scene
        $keys = $this->excludeSelectedGhostColumns($keys);   // Exclude any column name that does not actually exists
        $keys = $this->queryAddColumnForGroupBy($keys);
        $keys = $this->queryAddFieldsForRelations($keys);

        return $keys;
    }

    /**
     * Get the required relationships as array
     *
     * @return array|false|string[]
     */
    public function queryRelations()
    {
        $relations = [];
        if (request('with')) {
            $relations = explode(',', request('with'));
        }

        return $relations;
    }

    /**
     * Map relationships with fields that needs to be available in select columns
     *
     * @return string[]
     */
    public function relationFieldMap()
    {
        return [
            'creator' => 'created_by',
            'updater' => 'updated_by',
        ];
    }

    /**
     * Add additional field to make the model relationship work
     *
     * @param  array  $keys
     * @return array
     */
    public function queryAddFieldsForRelations($keys = [])
    {
        foreach ($this->relationFieldMap() as $relationship => $col) {
            if (!in_array($col, $keys) && in_array($col, $this->queryRelations())) {
                $keys[] = $col;
            }
        }

        return $keys;
    }

    /**
     * Add the columns that should be always included in query.
     *
     * @param  array  $keys
     * @return array
     */
    public function includeDefaultColumns($keys = [])
    {
        // $defaultColumns = array_merge($this->defaultColumns(), $this->defaultColumns());
        $defaultColumns = $this->defaultColumns();

        foreach ($defaultColumns as $col) {
            // if (!in_array($col, $keys) && in_array($col, $this->dataSourceColumns())) {
            if (!in_array($col, $keys)) {
                $keys[] = $col;
            }
        }

        return $keys;
    }

    /**
     * Columns that should be always included in the select column query.
     * Usually this is id field. This is useful to generate a url
     * to the linked element.
     *
     * @return array
     */
    public function defaultColumns()
    {
        return ['id'];
        // return [];
    }

    /**
     * Columns that should be always included in the select column query.
     * Usually this is id field. This is useful to generate a url
     * to the linked element.
     *
     * @return array
     * @deprecated Use defaultColumns() instead
     */
    public function defaultSelectedColumns()
    {
        return $this->defaultColumns();
    }

    /**
     * Remove ghost columns from the array of select columns.
     *
     * @param  array  $keys
     * @return array
     */
    public function excludeSelectedGhostColumns($keys = [])
    {
        $temp = [];
        foreach ($keys as $key) {
            if (!in_array($key, $this->ghostColumnOptions())) {
                $temp[] = $key;
            }
        }

        return $temp;
    }

    /**
     * @param $query Builder|\Illuminate\Database\Eloquent\Builder
     * @return Builder
     */
    public function orderBy($query)
    {
        $orderBy = $this->sanitizedOrderByStr();

        if (strlen($orderBy)) {
            // $query = $query->orderByRaw(request('order_by'));
            $query->orderByRaw($orderBy);
        }

        $query = $this->ghostColumnOrderBy($query);

        return $query;
    }

    /**
     * Ghost column sort filed map
     *
     * @return array
     */
    public function ghostColumnOrders()
    {
        return [
            // 'order_sl' => [ // ghost column
            //     'model' => new Order, // Model
            //     'order_by' => 'tenant_sl', // actual column name in model representing ghost column
            //     'column_1' => 'orders.id', // primary key in model
            //     'column_2' => 'customer_jobs.order_id', // foreign key main class
            // ],
        ];
    }

    /**
     * Apply order by on ghost column
     *
     * @param $query
     * @return mixed
     */
    public function ghostColumnOrderBy($query)
    {
        $ghostColumns = $this->ghostColumnOrders();
        foreach ($ghostColumns as $ghostColumn => $v) {
            if ($direction = $this->orderColumnDirection($ghostColumn)) {
                $model = $v['model'];
                $query->orderBy(
                    $model::select($v['order_by'])->whereColumn($v['column_1'], $v['column_2']),
                    $direction
                );
            }
        }

        return $query;
    }

    /**
     * Break the request param for order by into an array
     *
     * @return array
     */
    public function orderByArray()
    {
        $orderByArray = [];

        # Order by passed as param
        $str = request('order_by');
        if (!strlen(trim($str))) {
            return $orderByArray;
        }

        $array = csvToArray($str); // field1 asc, field2 des --> ['field1 asc','field2 desc']
        foreach ($array as $clause) {
            $pieces = explode(' ', $clause); // 'field1 asc' --> [ 0=>'field1', 1=>'asc']

            if (isset($pieces[0])) {
                $key = trim($pieces[0]); // 'field1'

                if (!$this->columnIsSortable($key)) {
                    return $orderByArray;
                }

                $orderByArray[$key] = 'ASC';
                if (isset($pieces[1])) {
                    $order = trim($pieces[1]); //
                    $orderByArray[$key] = $order;
                }
            }
        }

        return $orderByArray;
    }

    /**
     * Sanitized orderByRaw string for
     *
     * @return string|null
     */
    public function sanitizedOrderByStr()
    {
        $str = null;
        $orderByArray = $this->orderByArray();

        if (!count($orderByArray)) {
            return $str;
        }

        foreach ($orderByArray as $k => $v) {
            if ($this->hasColumn($k)) {
                $str .= $k.' '.$v.',';
            } elseif ($column = $this->selectedColumFromSqlAlias($k)) {
                $str .= $column.' '.$v.',';
            } elseif ($column = $this->selectedColumFromDotFields($k)) {
                $str .= $column.' '.$v.',';
            } elseif ($k == 'total' && $this->hasGroupBy()) {
                $str .= $k.' '.$v.',';
            } else {
                $str .= "`$k` $v,";
            }
        }

        $str = trim($str, ' ,');

        return $str;
    }

    /**
     * If an alias for a field is used i.e. users.id as applicant_id
     * then get the actual column name(users.id) from alias (applicant_id)
     *
     * @param $alias
     * @return string|null
     */
    public function selectedColumFromSqlAlias($alias)
    {
        $column = collect($this->querySelectColumns())
            ->filter(function ($value, $key) use ($alias) {
                if (is_string($value)) {
                    return Str::contains($value, " as $alias");
                }
            })->first();

        if ($column) {
            return Str::before($column, ' as');
        }
        return null;
    }

    public function selectedColumFromDotFields($column)
    {
        $column = collect($this->querySelectColumns())
            ->filter(function ($value, $key) use ($column) {
                if (is_string($value)) {
                    return Str::contains($value, ".$column");
                }
            })->first();

        if ($column) {
            return Str::before($column, ' as');
        }
        return null;
    }

    /**
     * Check if a field is available in order column
     *
     * @param $column
     * @return bool|mixed
     */
    public function orderHas($column)
    {
        $orders = $this->orderByArray();

        return $orders[$column] ?? false;
    }

    /**
     * Get the order type ASC/DESC of the column
     *
     * @param $column
     * @return bool|mixed
     */
    public function orderColumnDirection($column)
    {
        return $this->orderHas($column);
    }

    /**
     * Add groupBy clause to the query builder.
     *
     * @param $query Builder
     * @return Builder
     */
    public function groupBy($query)
    {
        if ($this->hasGroupBy()) {
            return $query->groupBy($this->groupByFields());
        }

        return $query;
    }

    /**
     * Determine the group by field field names. Usually this is input
     * from the report generator form.
     *
     * @return array
     */
    public function groupByFields()
    {
        return Convert::csvToArray(request('group_by'));
    }

    /**
     * @return array|bool
     */
    public function hasGroupBy()
    {
        return $this->groupByFields() ?: false;
    }

    /**
     * Adds the custom COUNT/SUM column in SQL SELECT.
     *
     * @param  array  $keys
     * @return array
     */
    public function queryAddColumnForGroupBy($keys = [])
    {
        if ($this->hasGroupBy()) {
            $keys[] = DB::raw('count(*) as total');
        }

        return $keys;
    }

    /**
     * Due to existence of a group by clause some additional column
     * needs to be shown. This function returns the array of those additional columns.
     *
     * @return array
     */
    public function additionalSelectedColumnsDueToGroupBy()
    {
        // considering COUNT(*) as total exists in the query builder. However this
        // doesn't always have to be total. For example it can be sum if there
        // query has SUM(*) as sum
        return ['total'];
        //$merge[] = 'sum';
    }

    /**
     * Due to existence of a group by clause some additional alias columns are required
     * this array maps with the additionalSelectedColumnsDueToGroupBy.
     * `@return array
     */
    public function additionalAliasColumnsDueToGroupBy()
    {
        // considering COUNT(*) as total exists in the query builder. However this
        // doesn't always have to be total. For example it can be sum if there
        // query has SUM(*) as sum
        return ['Total'];
        //$merge[] = 'sum';
    }

    /**
     * Check if the response expects full data
     *
     * @return bool
     */
    public function expectsAllData()
    {
        if (in_array($this->outputType(), ['excel', 'print'])) {
            return true;
        }
        if (request('force_all_data') == 'yes') {
            return true;
        }

        return false;
    }

    /**
     * Cache key generator
     *
     * @return string
     */
    public function signature()
    {
        return Mf::httpRequestSignature(($this->resultQuery()->toSql()));
    }
}
