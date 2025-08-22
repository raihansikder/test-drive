<?php
/**
 * @var \App\Module $module
 * @var \App\Mainframe\Modules\SuperHeroes\SuperHero $element
 * @var \App\Project\Features\Core\ViewProcessor $view
 */

$prefix = $module->name;
?>

<input name="redirect_success" type="hidden" class="redirect-success {{$prefix}}-redirect-success"
       id="{{$prefix}}-redirect-success"
       value="{{ request('redirect_success',route($module->name.".index") ) }}"/>

<input name="redirect_fail" type="hidden" class="redirect_fail {{$prefix}}-redirect-fail"
       id="{{$prefix}}-redirect-fail"
       value="{{ request('redirect_fail',URL::full())  }}"/>

<input name="ret" type="hidden" class="ret {{$prefix}}-ret"
       id="{{$prefix}}-ret"
       value="{{Request::get('ret')}}"/>


<input name="_meta[refresh_datatable_id]" class=" {{$prefix}}-refresh_datatable_id" type="hidden">
<input name="_meta[hide_class]" class=" {{$prefix}}-hide_class" type="hidden">
