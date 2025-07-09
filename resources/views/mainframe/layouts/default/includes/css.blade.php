<?php

/**
 * Define the list of CSS to include
 *
 * @var string[] $scripts
 */
$scripts = [
    'mainframe/templates/admin/plugins/select2-3.5.1/select2.css',
    'css/all.css',
    'mainframe/js/plugins/imagelightbox/imagelightbox.css',
    'mainframe/css/hover/hover-min.css',
    'mainframe/uicons/rr/css/uicons-regular-rounded.css',
    // 'mainframe/uicons/ts/css/uicons-thin-straight.css',
    'mainframe/css/mainframe.css?v='.date('Ymd'),
];

// Merge CSS from mainframe config
$scripts = array_merge($scripts, config('mainframe.config.load.css'));
?>


{{-- Font-awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
{{-- Google font Material icons --}}
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>

@foreach($scripts as $script)
    <link rel="stylesheet" href="{{asset($script)}}">
@endforeach


@section('css')
    {{-- css --}}
@show
