<?php
/*
|--------------------------------------------------------------------------
| Vars
|--------------------------------------------------------------------------
|
| This view partial can be included with a config variable $var.
| $var is an array and can have following keys.
| if a $var is not set the default value will be use.
|
*/
/**
 *      $var['div'] ?? 'col-md-3';
 *      $var['label']           ?? null;
 *      $var['label_class']     ?? null;
 *      $var['type']            ?? null;
 *      $var['value']           ?? null;
 *      $var['name']            ?? Str::random(8);
 *      $var['params']          ?? [];  // These are the html attributes like css, id etc for the field.
 *      $var['editable']        ?? true;
 */
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 * @var string $formState create|edit
 */

$input = new App\Mainframe\Features\Form\DeleteButton($var, $element ?? null);
// $input->params['name'] = 'genericDeleteBtn';
// $input->params['type'] = 'button';
// $input->params['class'] = 'button';
// $input->params['data-toggle'] = 'modal';
// $input->params['data-target'] = '#deleteModal';
// $input->params['data-route'] = $var;
// $input->params['data-route'] = 'button';
// $input->params['data-route'] = 'button';
?>

{{Form::button($input->value,$input->params)}}

{{--<button name='{{$input->params['name']}}'--}}
{{--        type='button'--}}
{{--        data-toggle='modal'--}}
{{--        data-target='#deleteModal'--}}
{{--        class='{{$input->params['class']}}'--}}
{{--        data-route='{{$input->params['data-route']}}'--}}
{{--        data-redirect_success='{{$input->params['data-redirect_success']}}'--}}
{{--        data-redirect_fail='{{$input->params['data-redirect_fail']}}'--}}
{{--        onClick='initGenericDeleteBtn()'--}}
{{-->--}}
{{--    {!! $input->value!!}--}}
{{--</button>--}}
