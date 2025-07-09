<?php
/**
 * @var \App\Assignment $element
 */
$assignment = $element;

/** @var \App\Setting $assignable */
$assignable = $assignment->assignable;
?>
The following item is assigned to you for further action.<br/>
Please click below. <br/>

{{Str::singular($assignable->module()->title)}}
<a href="{!! $assignable->editUrl() !!}"> {{'#'.pad($element->id)}} - {{$assignable->name}}</a>
