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
 *  $var['div'] ?? 'col-md-3';
 *  $var['label']           ?? null;
 *  $var['label_class']     ?? null;
 *  $var['type']            ?? null;
 *  $var['value']           ?? null;
 *  $var['name']            ?? Str::random(8);
 *  $var['params']          ?? [];  // These are the html attributes like css, id etc for the field.
 *  $var['editable']        ?? true;
 *
 * @var \Illuminate\Support\ViewErrorBag $errors
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 * @var bool $editable
 * @var array $immutables
 * @var array $var
 */

use App\Mainframe\Features\Form\Text\InputText;

use App\Mainframe\Features\Form\Form;

$var = Form::setUpVar($var, $errors ?? null, $element ?? null, $editable ?? null, $immutables ?? null,
    $hiddenFields ?? null);
$input = new InputText($var);
?>

@if($input->isHidden)
    {{ html()->hidden($input->name, $input->value())->attributes($input->params)}}
@else
    <div class="{{$input->containerClasses()}}" id="{{$input->uid}}">
        {{-- label --}}
        @include('mainframe.form.includes.label')

        @if($input->isEditable)
            @if($input->type == 'password')
                {{ html()->password($input->name)->attributes($input->params) }}
            @elseif(($input->type == 'number'))
                {{ html()->number($input->name, $input->value())->attributes($input->params) }}
            @elseif(($input->type == 'email'))
                {{ html()->email($input->name, $input->value())->attributes($input->params) }}
            @elseif(($input->type == 'tel'))
                {{ html()->tel($input->name, $input->value())->attributes($input->params) }}
            @elseif(($input->type == 'date'))
                {{ html()->date($input->name, $input->value())->attributes($input->params) }}
            @elseif(($input->type == 'time'))
                {{ html()->time($input->name, $input->value())->attributes($input->params) }}
            @elseif(($input->type == 'range'))
                {{ html()->range($input->name, $input->value())->attributes($input->params) }}
            @else
                {{ html()->text($input->name, $input->value())->attributes(array_merge($input->params,['type'=>$input->type])) }}
            @endif
        @else
            @include('mainframe.form.includes.read-only-view')
        @endif

        {{-- Error --}}
        @include('mainframe.form.includes.show-error')
    </div>
@endif

<?php unset($input)  ?>
