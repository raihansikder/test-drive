<?php
/**
 * @var \App\Module $module
 * @var \App\Mainframe\Modules\SuperHeroes\SuperHero $element
 * @var \App\Project\Features\Core\ViewProcessor $view
 */
?>
<a target="_blank" class="change-log-cta"
   href="{{route("$module->route_name.changes",$element->id)}}">Change log</a>
