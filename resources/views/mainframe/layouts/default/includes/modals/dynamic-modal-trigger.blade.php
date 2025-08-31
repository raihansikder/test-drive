<?php

$default = [
    // 'name' => Str::random(8).'Modal', // Modal name
    'btn_title' => "",
    'btn_text' => "<i class='fi fi-rr-plus'></i> Add",
    'btn_class' => 'btn-secondary table-header-add-btn', // Button class
    'width' => '700px',
    'url' => '#', // GET partial from this URL
];

/** @var array $var */
$var = array_merge($default, $var);
// $btnId = $var['name']."Btn";
?>

<button class="dynamic-modal-trigger btn {{$var['btn_class']}}"
        {{-- id="{{$btnId}}"--}}
        title="{{$var['btn_title']}}" type="button"
        data-toggle="modal"
        data-url="{!! $var['url'] !!}"
        data-width="{!! $var['width'] !!}"
        data-target="#dynamicModal">
    {!! $var['btn_text'] !!}
</button>

@section('js')
    @parent
@endsection

@unset($var)