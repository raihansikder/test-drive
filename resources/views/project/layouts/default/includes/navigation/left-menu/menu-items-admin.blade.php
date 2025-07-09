<?php
use App\ModuleGroup;use App\Mainframe\Helpers\View;

/**
 * @var string $currentModuleName
 * @var array $breadcrumbs
 */

?>
<ul class="sidebar-menu">
    @auth()
        <li>
            <a href="{{route("home")}}">
                <ion-icon name="laptop-outline"></ion-icon>
                <span>Dashboard</span>
            </a>
        </li>

        <?php View::renderMenuTree(ModuleGroup::tree(), $currentModuleName, $breadcrumbs); ?>

        <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help Desk</span></a></li>
        {{--<li class="header">LABELS</li>--}}
        {{--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>--}}
        {{--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>--}}
        {{--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
    @endauth
</ul>
