<?php

$levels = $levels ?? [];
$editable = $editable ?? true;

foreach ($levels as &$level) {
    $level['multiple'] = $level['multiple'] ?? true;
    $level['editable'] = $level['editable'] ?? $editable;

}
?>

@include('form.select-model-chained',['levels'=>$levels])
@unset($levels)
