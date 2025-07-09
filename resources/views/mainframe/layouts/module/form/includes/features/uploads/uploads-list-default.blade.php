<?php

use App\Mainframe\Features\Form\Form as MfForm;
use App\Mainframe\Features\Form\Upload as MfFormUpload;

/**
 * @var \App\Module $module
 * @var \App\Upload $upload
 * @var \App\Upload[] $uploads
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 * @var \App\Mainframe\Features\Form\Upload $input
 */

$uploads = $uploads ?: [];

if (!count($uploads)) {
    return;
}

if (!isset($input)) {
    $var = MfForm::setUpVar($var ?? [], $errors ?? null, $element ?? null, $editable ?? null,
        $immutables ?? null, $hiddenFields ?? null);
    $input = $input ?? new MfFormUpload($var);
}
?>

<div class="row sortable {{optional($module)->name}}-file-list file-list">
    @foreach($uploads as $upload)
        <div class="{{$input->cardCss}} col-xs-12 filecard ">

            @if($input->sort)
                <input type="hidden" class="upload-id" name="upload-id[]" value="{{$upload->id}}"/>
            @endif

            <div class="info-box shadow">

                {{-- Preview --}}
                <div class="col-md-3 no-padding img-thumb-div">
                    @if($upload->isPdf())
                        {{-- Show Pdf--}}
                        <a href="{{route('show.image',$upload->id)}}" target="_blank"
                           title="Preview {{$upload->name. " - ". $upload->type}}">
                            <span class="info-box-icon">
                                <img src="{{$upload->thumbnail()}}" alt="{{$upload->name. " - ". $upload->type}}"
                                     class="list-thumb img-responsive"/>
                            </span>
                        </a>
                    @else
                        {{-- Show Image--}}
                        <a href="{{$upload->thumbnail()}}" data-load="imagelightbox"
                           title="Preview {{$upload->name. " - ". $upload->type}}">
                            <span class="info-box-icon">
                                <img src="{{$upload->thumbnail()}}" alt="{{$upload->name. " - ". $upload->type}}"
                                     class="list-thumb img-responsive"/>
                            </span>
                        </a>
                    @endif
                </div>

                <div class="info-box-content uploads-tile-container col-md-8">

                    <!-- Upload file name with link to module  -->
                    <span class="info-box-text">
                        @if(user()->can('view',$upload) && $input->detailLink)
                            <a href="{{ route('uploads.edit', $upload->id) }}"
                               title="View details">{{$upload->name}}</a>
                        @else
                            {{$upload->name}}
                        @endif
                    </span>

                    <!-- Upload details -->
                    <span class="info-box-text text-sm file-info">
                        {{$upload->ext}} {{convertFileSize($upload->bytes)}} <br/>
                        {{ formatDateTime($upload->created_at) }}
                    </span>

                    {{-- Download and other buttons --}}
                    <div class="upload-tile-buttons">

                        <!-- View button -->
                        @if(!$upload->isImage())
                            {{-- Show non-image--}}
                            <a href="{{route('show.image',$upload->id)}}" target="_blank"
                               title="View"
                               class="btn btn-xs btn-default btn-transparent">
                                <ion-icon name="search-outline"></ion-icon>
                            </a>
                        @else
                            <!-- Show Image button-->
                            <a href="{{$upload->thumbnail()}}" data-load=""
                               title="View"
                               class="btn btn-xs btn-default btn-transparent">
                                <ion-icon name="search-outline"></ion-icon>
                            </a>
                        @endif

                        <!-- Edit button -->
                        @if(user()->can('view',$upload) && $input->detailLink)
                            <a href="{{ route('uploads.edit', $upload->id) }}" title="Edit"
                               class="btn btn-xs btn-default btn-transparent">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                        @endif

                        <!-- Download button -->
                        <a href="{{$upload->downloadUrl()}}" title="Download"
                           class="btn btn-xs btn-default btn-transparent">
                            <ion-icon name="arrow-down-circle-outline"></ion-icon>
                        </a>

                        <!-- Delete button -->
                        @if(user()->can('delete',$upload) && $input->deleteBtn)
                                <?php
                                $var = [
                                    'route' => route("uploads.destroy", $upload->id),
                                    'redirect_success' => URL::full(),
                                    'params' => [
                                        'class' => 'btn btn-xs btn-transparent-red pull-right',
                                        'title' => 'Delete',
                                    ],
                                    'value' => '<i class="fa fa-trash"></i>',
                                ];
                                ?>
                            @include('form.delete-button',['var'=>$var])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if($input->sort)
        <div class="col-md-12">
            <button id="{{$input->uid}}-SaveSortBtn" class="btn-save-upload-order btn btn-bordered-blue" type="button"
                    style="display: none">Save new order
            </button>
        </div>
    @endif
</div>


@section('js')
    @parent
    @if(Route::has('uploads.reorder') &&  $input->sort)
        <script>
            /*
            |--------------------------------------------------------------------------
            | Sort and save
            |--------------------------------------------------------------------------
            */

            var container = "#{{$input->uid}}";
            var reorderBtn = "#{{$input->uid}}-SaveSortBtn";

            $("#{{$input->uid}} > .sortable").on("sortupdate", function (event, ui) {
                $("#{{$input->uid}}-SaveSortBtn").show();
            });

            $("#{{$input->uid}}-SaveSortBtn").click(function () {
                $(this).prop('disabled', true);

                axios.post('{{route('uploads.reorder')}}', {
                    ids: getInputAsArray("#{{$input->uid}} .upload-id")
                }).then(response => {
                    showResponseModal(response.data, 3000);
                }).catch(error => {
                    console.log(error);
                }).then(() => {
                    // Re-activate UI
                    $(this).prop('disabled', false);
                });
            });

        </script>
    @endif
@endsection
