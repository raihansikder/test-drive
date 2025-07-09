<?php
/**
 * @var \App\Module $module
 * @var \App\Mainframe\Modules\SuperHeroes\SuperHero $element
 * @var \App\Project\Features\Core\ViewProcessor $view
 */
?>
<div class="pull-right delete-cta no-padding">
    <?php
    $var = [
        'route' => route($module->route_name.".destroy", $element->id),
        'redirect_success' => route($module->route_name.".index"),
    ];
    ?>
    @include('form.delete-button',['var'=>$var])
</div>
