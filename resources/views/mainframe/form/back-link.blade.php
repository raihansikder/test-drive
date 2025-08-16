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
    <a class="btn btn-xs btn-secondary back-link pull-left" href="{{$backToElement->editUrl()}}">
        <i class="fa fa-angle-left pull-left"></i>

        @if($label)
            <span class="back-link-label">{{$label}}</span>
        @endif

        {{$backToElement->$showField}}
        <span><small class="label bg-gray">{{$backToElement->id}}</small></span>
    </a>
@endif

@unset($var)
