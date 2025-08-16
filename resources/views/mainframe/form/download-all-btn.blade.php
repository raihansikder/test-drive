<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var \App\Setting $element
 * @var \App\Setting $setting
 * @var \App\Mainframe\Features\Core\ViewProcessor $view
 */

if (!$view->showDownloadAllAsZipButton()) {
    return;
}

$label = $var['label'] ?? "<i class='fi fi-rr-file-download'></i> Download Zip";
$class = $var['class'] ?? "btn btn-default";
$tooltip = $var['tooltip'] ?? "Download all the uploads under this form as a single zip file";

$params = [
    'module_id' => $element->module()->id,
    'element_id' => $element->id,
    'element_uuid' => $element->uuid,
    'zip_file_name' => $var['zip_file_name'] ?? null,
];

$params = array_merge($params, $var['params'] ?? []);

$url = $var['url'] ?? route('download.zip', $params);
?>

<a class="{{$class}}" href="{!! $url !!}" title="{{$tooltip}}" data-toggle="tooltip">
    {!! $label!!}
</a>

@unset($var, $label, $url, $params, $class, $tooltip)
