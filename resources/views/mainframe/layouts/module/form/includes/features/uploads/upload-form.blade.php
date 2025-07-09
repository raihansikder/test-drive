<?php
/**
 * @var App\Mainframe\Features\Form\Upload $input
 */
?>
<div id="{{$input->uploadBoxId}}" class="uploads-container">

    <!-- show type, bucket name  -->
    <div class="col-md-6 pull-right upload-tags" style="margin: 10px 0" id="{{$input->type}}">
        @if(user()->isSuperUser())
            <span class="badge pull-right upload-badge {!! $input->badge!!}">{!! $input->type!!}</span>
            @if(str_starts_with($input->bucket(),'public'))
                <span class="badge pull-right bg-red"> <i class="fa fa-folder"></i> {{$input->bucket()}}</span>
            @else
                <span class="badge pull-right bg-gray"> <i class="fa fa-folder"></i> {{$input->bucket()}}</span>
            @endif
        @endif
    </div>

    @csrf
    <input type="hidden" name="ret" value="json"/>
    <input type="hidden" name="bucket" value="{{$input->bucket()}}"/>
    <input type="hidden" name="tenant_id" value="{{$input->tenantId}}"/>
    <input type="hidden" name="module_id" value="{{$input->moduleId}}"/>
    <input type="hidden" name="element_id" value="{{$input->elementId}}"/>
    <input type="hidden" name="element_uuid" value="{{$input->elementUuid}}"/>
    <input type="hidden" name="uploadable_id" value="{{$input->elementId}}"/>
    <input type="hidden" name="uploadable_type" value="{{$input->uploadableType}}"/>
    @if($input->type)
        <input type="hidden" name="upload_type" value="{{$input->type}}"/>
    @endif
    <div class="file-uploader">Upload file</div>
</div>
