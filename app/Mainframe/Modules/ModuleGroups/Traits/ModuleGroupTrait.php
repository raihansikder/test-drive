<?php

namespace App\Mainframe\Modules\ModuleGroups\Traits;

use Str;
use App\Module;
use App\ModuleGroup;

trait ModuleGroupTrait
{
    /**
     * Get Module-groups that are active
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getActiveList()
    {
        return ModuleGroup::whereIsActive(1)->remember(timer('long'))->get();
    }

    /**
     * Get Module-groups that are active
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public static function ofParentId($id = 0)
    {
        return ModuleGroup::whereParentId($id)->whereIsVisible(1)->whereIsActive(1)
            ->orderBy('order')->orderBy('title')->remember(timer('long'))->get();
    }

    /**
     * An array of menu
     *
     * @return array
     */
    public static function tree()
    {
        /** @var \App\ModuleGroup[] $moduleGroups */
        $moduleGroups = ModuleGroup::ofParentId(0);
        $list = [];
        foreach ($moduleGroups as $moduleGroup) {
            if (count($moduleGroup->children())) {
                $list[] = ['type' => 'module_group', 'item' => $moduleGroup, 'children' => $moduleGroup->children()];
            } else {
                $list[] = ['type' => 'module_group', 'item' => $moduleGroup, 'children' => []];
            }
        }
        $modules = Module::ofGroupId(0);
        if (count($modules)) {
            foreach ($modules as $module) {
                $list[] = ['type' => 'module', 'item' => $module];
            }
        }

        return $list;
    }

    /**
     * Show the permission selection checkbox grid in groups details page
     *
     * @param $tree
     * @return string|void
     */
    public static function renderTree($tree = null)
    {
        $tree = $tree ?? ModuleGroup::tree();

        $module_permissions = config('mainframe.permissions.module');
        $html = '';

        if (is_array($tree)) {
            $html .= "<ul>";
            foreach ($tree as $leaf) {
                // $perm = 'perm-'.$leaf['type'].'-'.$leaf['item']->name;
                $perm = $leaf['item']->name;
                $val = $perm;

                $html .= "<div class='clearfix'></div><li class='pull-left'>".
                    "<input name='permission[]' type='checkbox' v-model='permission' value='$val'
				v-on:click='clicked'/>".
                    "<label><b>".$leaf['item']->title."</b> - <small>".$leaf['item']->desc."</small></label> <div class='clearfix'></div>";

                if ($leaf['type'] === 'module') {
                    $html .= "<ul class='pull-left module-permissions'>";
                    foreach ($module_permissions as $k => $v) {
                        $val = "$perm-$k";
                        $html .= "<li>".
                            "<input name='permission[]' type='checkbox' v-model='permission'  value='$val'/>".
                            "<label>".$v."</label>".
                            "</li>";
                    }
                    $html .= "</ul>";
                }

                if (isset($leaf['children']) && count($leaf['children'])) {
                    $html .= self::renderTree($leaf['children']);
                }
                $html .= "</li>";
            }
            $html .= "</ul>";

            return $html;
        }
    }

    /**
     * Get children modules and module_groups
     *
     * @return array
     */
    public function children()
    {
        $list = [];

        $moduleGroups = ModuleGroup::ofParentId($this->id);
        if (count($moduleGroups)) {
            /** @var \App\ModuleGroup $moduleGroups */
            foreach ($moduleGroups as $moduleGroup) {
                if (count($moduleGroup->children())) {
                    $list[] = ['type' => 'module_group', 'item' => $moduleGroup, 'children' => $moduleGroup->children()];
                } else {
                    $list[] = ['type' => 'module_group', 'item' => $moduleGroup, 'children' => []];
                }
            }
        }
        $modules = Module::ofGroupId($this->id);
        if (count($modules)) {
            foreach ($modules as $module) {
                $list[] = ['type' => 'module', 'item' => $module];
            }
        }

        return $list;
    }

    /**
     * Get module_group names as one-dimentional array
     *
     * @param  bool|true  $only_active
     * @return array
     */
    public static function names($only_active = true)
    {
        $q = ModuleGroup::select('name');
        if ($only_active) {
            $q = $q->remember(timer('very-long'))->where('is_active', 1);
        }
        $results = $q->get()->toArray();

        return array_column($results, 'name');
    }

    /**
     * get first level children of a module group
     *
     * @return array
     */
    public function firstLevelChildren()
    {
        $list = [];
        $moduleGroups = ModuleGroup::whereParentId($this->id)->whereIsActive(1)->orderBy('order')->remember(timer('very-long'))->get();
        if (count($moduleGroups)) {
            foreach ($moduleGroups as $moduleGroup) {
                $list[] = ['type' => 'module_group', 'item' => $moduleGroup];
            }
        }
        $modules = Module::whereModuleGroupId($this->id)->whereIsActive(1)->orderBy('order')->remember(timer('very-long'))->get();
        if (count($modules)) {
            foreach ($modules as $module) {
                $list[] = ['type' => 'module', 'item' => $module];
            }
        }

        return $list;
    }

    /**
     * Generate appropriate icon code based on config
     *
     * @return string|null
     */
    public function iconHtml()
    {
        if (Str::contains($this->icon_css, '<')) {
            return $this->icon_css;
        }
        if (Str::contains($this->icon_css, ['fa', 'fi'])) {
            return "<i class='".$this->icon_css."'></i>";
        }
        return "<ion-icon name='".$this->icon_css."'></ion-icon>";
    }
}
