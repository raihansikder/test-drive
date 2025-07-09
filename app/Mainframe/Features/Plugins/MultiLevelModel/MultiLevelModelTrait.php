<?php

namespace App\Mainframe\Features\Plugins\MultiLevelModel;

/** @mixin \App\SupportTicket */
trait MultiLevelModelTrait
{

    // /**
    //  * return $this
    //  */
    // public function populate()
    // {
    //
    //     $this->parent_id = $this->parent_id ?? 0;
    //     $this->order = $this->order ?? 999;
    //
    //     return $this;
    // }

    // /**
    //  * Set name_ext field
    //  *
    //  * @return $this
    //  */
    // public function setNameExt()
    // {
    //     $this->name_ext = $this->name;
    //
    //     if ($this->hasTenantContext() && $this->tenant) {
    //         $this->name_ext .= ' ('.$this->tenant->name.')';
    //     }
    //
    //     if ($this->parent) {
    //         $this->name_ext = $this->parent->name_ext.' » '.$this->name;
    //     }
    //
    //     return $this;
    // }

    // public function setNameExt()
    // {
    //
    //     if ($this->parent) {
    //         $str = $this->parent->name_ext.' » '.$this->name;
    //     } else {
    //        //  $str = $this->relatedModule->name;
    //        //  $str = $str.": ".$this->name;
    //     }
    //
    //     $this->name_ext = $str;
    //     return $this;
    // }


    /**
     * Set and array of upper level ids up till origin [3,2,1]
     *
     * @return $this
     */
    public function setUpperLevelIds()
    {
        $ids = [];

        $parentId = $this->parent_id;

        // Recursively get all the ids till origin
        while ($parentId) {
            $parent = self::find($parentId);
            $ids[] = $parentId;
            $parentId = $parent->parent_id;
        }

        $this->upper_level_ids = $ids;

        return $this;
    }

    /**
     * Set and array of lower level ids up till origin [3,2,1]
     *
     * @return $this
     */
    public function setLowerLevelIds()
    {
        $ids = [];
        $children = $this->children;

        foreach ($children as $child) {
            $ids[$child->id] = $child->lower_level_ids;
        }

        $this->lower_level_ids = $ids;

        return $this;
    }

    /**
     * Re-syncs the hierarchy and sets the url
     *
     * @return void
     */
    public static function reSyncParentChild()
    {
        $levels = self::with(['children'])->orderBy('parent_id', 'desc')->get();

        foreach ($levels as $level) {
            /** @var self $level */
            $level->setUpperLevelIds()
                ->setLowerLevelIds()
                ->saveQuietly();
        }

        $levels = self::with(['children'])->orderBy('parent_id', 'asc')->get();
        foreach ($levels as $level) {
            /** @var self $level */
            $level->setUpperLevelIds()
                ->setLowerLevelIds()
                ->saveQuietly();
        }
    }

    /**
     * Get an array of ids including current level ids and all its children ids.
     * This is useful for searching within the level
     *
     * @return array
     */
    public function thisAndAllChildIds()
    {
        return array_merge([$this->id], array_flat_keys($this->lower_level_ids));
    }

    /**
     * Check if an element is the end node and has no futher child
     *
     * @return bool
     */
    public function isEndNode()
    {
        return !$this->children()->remember(timer('long'))->exists();
    }

    /**
     * Find the elements that have no further child
     *
     * @return array
     */
    public static function endNodes()
    {
        $items = self::active()->get();
        $bucket = [];
        foreach ($items as $productLevel) {
            if (!$productLevel->children()->exists()) {
                $bucket[] = $productLevel;
            }
        }

        return $bucket;
    }

    /*
   |--------------------------------------------------------------------------
   | Relations
   |--------------------------------------------------------------------------
   */

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function subLevels()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

}
