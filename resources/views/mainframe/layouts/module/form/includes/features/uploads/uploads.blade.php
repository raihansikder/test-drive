<?php
/**
 * @var \Illuminate\Support\ViewErrorBag $errors
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 * @var bool $editable
 * @var array $immutables
 * @var array $var
 */

$var = \App\Mainframe\Features\Form\Form::setUpVar($var, $errors ?? null, $element ?? null, $editable ?? null,
    $immutables ?? null, $hiddenFields ?? null);
$input = new App\Mainframe\Features\Form\Upload($var);

/*
|--------------------------------------------------------------------------
| Get the list/collection of uploads
|--------------------------------------------------------------------------
*/
/** @var \App\Upload[] $uploads */
$uploads = $input->uploads();

?>
<div class="clearfix"></div>

<!-- Upload form and container  -->
<div class="{{$input->containerClass}} {{$input->uid}}" id="{{$input->uid}}">
    @include('mainframe.form.includes.label')
    @if($input->isEditable())
        @include('mainframe.layouts.module.form.includes.features.uploads.upload-form',['input'=>$input])
    @endif
    @include('mainframe.layouts.module.form.includes.features.uploads.uploads-list-default',['uploads'=>$uploads,'input'=>$input])
</div>

<!-- Download Zip  -->
@if($input->allowZipDownload() && count($uploads))
    <a href="{{$input->zipDownloadUrl()}}" class="btn btn-default bg-white">
        <ion-icon name="download-outline"></ion-icon>
        Zip
    </a>
@endif

{{-- js --}}
@section('js')
    @if($input->isEditable())
        <script>
            {{$input->uploaderFunction}}("{{$input->uploadBoxId}}", "{!! $input->postUrl() !!}"); //initUploader()
        </script>
    @endif
    @parent
@endsection

<?php unset($input, $var); ?>
