<?php
/**
 * @var \App\Module $module
 * @var \App\Mainframe\Modules\SuperHeroes\SuperHero $element
 * @var \App\Project\Features\Core\ViewProcessor $view
 */
?>

<input name="redirect_success" type="hidden" class="redirect-success {{$module->route_name}}-redirect-success"
       id="{{$module->route_name}}-redirect-success"
       value="{{ request('redirect_success',route($module->route_name.".index") ) }}"/>

<input name="redirect_fail" type="hidden" class="redirect_fail {{$module->route_name}}-redirect-fail"
       id="{{$module->route_name}}-redirect-fail"
       value="{{ request('redirect_fail',URL::full())  }}"/>

<input name="ret" type="hidden" class="ret {{$module->route_name}}-ret"
       id="{{$module->route_name}}-ret"
       value="{{Request::get('ret')}}"/>
