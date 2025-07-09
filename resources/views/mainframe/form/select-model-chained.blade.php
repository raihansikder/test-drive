<?php
/*
|--------------------------------------------------------------------------
| Model chained dropdown
|-------------------------------------------------------------------------
| https://activationltd.atlassian.net/browse/MF-159
*/

use App\Mainframe\Features\Modular\BaseModule\BaseModule;

$levels = $levels ?? [];

if (!isset($levels)) {
    $levels = [
        //['model' => \App\Division::class, 'name' => 'division_id', 'label' => 'Division'],
        //['model' => \App\District::class, 'name' => 'district_id', 'label' => 'District'],
    ];
}
$emptyValue = $emptyValue ?? '';
?>

@foreach($levels as $level)
    <?php
    /**
     * @var $loop
     * @var array $level
     * @var array $levels
     * @var BaseModule $class
     * @var BaseModule $previousLevelClass
     **/
    $class = $level['model'];
    $urlParam = Str::singular((new $class)->getTable())."_id";
    $levels[$loop->index]['url_param'] = $levels[$loop->index]['url_param'] ?? $urlParam;
    $levels[$loop->index]['multiple'] = $levels[$loop->index]['multiple'] ?? false;


    if (!$loop->first && !isset($level['query'])) {
        $previous = $loop->index - 1;
        $previousLevel = $levels[$previous];

        $previousLevelClass = $previousLevel['model'];
        $targetField = $previousLevel['target_field'] ?? $previousLevel['url_param']; // division_id

        $previousLevelVal = -99;
        if (isset($element)) {
            $previousLevelVal = $element->{$previousLevel['name']};
        }

        $level['query'] = $level['query'] ?? $class::query()->where($targetField, $previousLevelVal);
    }
    ?>
    @if($levels[$loop->index]['multiple'])
        @include('form.select-model-multiple',['var'=>$level])
    @else
        @include('form.select-model',['var'=>$level])
    @endif
@endforeach

@section('js')
    @parent

    @foreach($levels as $level)
        <?php
        /**
         * @var array $level
         * @var $loop
         * @var BaseModule $currentModel
         */
        $currentSelect = 'select_'.$level['name']; // select_division_id
        $currentModel = new $level['model'];
        ?>

        @if(!$loop->last)

            <?php
            $childLevel = $levels[$loop->index + 1];
            $childSelect = 'select_'.$childLevel['name']; // select_district_id
            $childOldValue = 'old_'.$childSelect; // select_district_id

            /** @var BaseModule $currentModel */
            $childModel = new $childLevel['model'];
            $url = $childLevel['url'] ?? route($childModel->module()->name.'.list-json',
                    [
                        'is_active' => '1',
                        'force_all_data' => 'yes',
                        'columns' => 'id,name'
                    ]);

            $url_param = $level['url_param'] ?? $level['name'];

            $currentSelectId = $level['id'] ?? $level['name'];
            $childSelectId = $childLevel['id'] ?? $childLevel['name'];

            $childLevel['editable'] = true;
            if (!isset($childLevel['editable']) && isset($editable)) {
                $childLevel['editable'] = $editable;

                // Check immutability
                if ($editable && isset($immutables, $childLevel['name'])) {
                    $childLevel['editable'] = !in_array($childLevel['name'], $immutables);
                }
            }
            ?>

            <script>
                /*************************************************
                 * Chained dropdown for level: {{$level['name'] }}
                **************************************************/

                        {{-- var myVar = {{ 'true' }}; --}}
                        {{-- console.log(myVar); --}}

                var {{$currentSelect}} = $('select[id={{$currentSelectId}}]');
                var {{$childSelect}} = $("select[id={{$childSelectId}}]");

                {{$currentSelect}}.select2();
                {{$childSelect}}.select2();

                // https://select2.github.io/select2/ > Events
                {{$currentSelect}}.on('change', function () {

                    var val = $(this).select2('val');
                    {{$childSelect}}.select2('enable', false);

                    if (!val || val == 0) {
                        {{$childSelect}}.select2("val", "").empty().select2('enable', true);
                        {{$childSelect}}.append("<option value='{{$emptyValue}}'>" + "-" + "</option>"); // Add empty selection
                        {{$childSelect}}.trigger('change');
                        return;
                    }

                    axios.get('{!! $url !!}', {
                        params: {
                            {{$url_param}}: $(this).select2('val')
                        }
                    }).then((response) => {

                        var {{$childOldValue}} = {{$childSelect}}.select2('val'); // Temporarily store value to assign after ajax loading
                        {{$childSelect}}.select2("val", "").empty().select2('enable', false); // Clear and disable child

                        @if(!$childLevel['multiple'])
                                {{$childSelect}}.append("<option value='{{$emptyValue}}'>" + "-" + "</option>"); // Add empty selection
                        @endif

                        $.each(response.data.data.items, function (i, obj) { // Load options
                            $({{$childSelect}}).append("<option value='" + obj.id + "'>" + obj.name + "</option>");
                        });

                        @if($childLevel['editable'])
                                {{$childSelect}}.select2('enable', true); // Enable back child after the ajax call
                        @endif

                                {{$childSelect}}.val({{$childOldValue}}).select2(); // Assign back old selection

                        // Note: Recently commented
                        {{$childSelect}}.trigger('change');
                    });
                });
                // Force trigger change only if there is no query set
                @if(!isset($childLevel['query']))
                        {{$childSelect}}.trigger('change');
                @endif

                // Force triggers a 'change' event  so that child options refresh based on current parent selection.
                {{-- {{$currentSelect}}.trigger('change'); --}}

            </script>
        @endif
    @endforeach
@endsection

@unset($levels,$emptyValue, $url_param, $url)
