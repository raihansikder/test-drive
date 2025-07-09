<?php
/** @var array $var
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $backToElement
 */
$backToElement = $var['element'];
$showField = $var['field'] ?? 'name';
$label = null;
if ($backToElement) {
    $label = Str::singular($backToElement->module()->title);
}
$label = $var['label'] ?? $label;
?>

@if($backToElement)
    <a class="btn btn-transparent btn-bordered-blue back-link pull-left" href="{{$backToElement->editUrl()}}">
        <i class="fa fa-angle-left pull-left text-smart-red" style="font-size: 17px"></i>

        @if($label)
            <span style='border-right: 1px dotted grey; margin-right: 5px'>
                {{$label}}
            </span>
        @endif

        {{$backToElement->$showField}}
        <span class="pull-right-container" style="padding-left: 5px">
           <small class="label bg-green">{{$backToElement->id}}</small>
        </span>
    </a>
@endif

@unset($var)
