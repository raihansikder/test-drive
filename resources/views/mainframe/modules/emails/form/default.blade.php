@extends('project.layouts.module.form.template')
<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var \App\Email $element
 * @var \App\Email $email
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Emails\EmailViewProcessor $view
 */
$email = $element;
?>
@section('content-top')
    @parent
    @if($element->isCreated())
        <div class="btn-group">
            <button class="btn btn-default btn-bordered-green" id="emailSendNowBtn"
                    name="emailSendNowBtn" type="button"
                    data-url="{{route('emails.send-now',$element)}}"
                    data-redirect_success="{{URL::full()}}"
                    data-redirect_fail="#">
                Send Now
                <!--<ion-icon name="send-outline"></ion-icon>-->
            </button>

            <button class="btn btn-default btn-bordered-green" id="emailQueueBtn"
                    name="emailQueueBtn" type="button"
                    data-url="{{route('emails.queue',$element)}}"
                    data-redirect_success="{{URL::full()}}"
                    data-redirect_fail="#">
                Queue
                <i class="fi fi-rr-time-add"></i>
            </button>

            @if(user()->isSuperUser())
                <a class="btn btn-default btn-bordered-green" type="button"
                   href="{{route('emails.preview',$element)}}">
                    Preview
                </a>
            @endif
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            {{---------------|  Form input start |-----------------------}}
            @include('form.text',['var'=>['name'=>'subject','label'=>'Subject','div'=>'col-md-8']])
            <div class="clearfix"></div>
            @include('form.tags',['var'=>['name'=>'to','label'=>'To','div'=>'col-md-8', 'value'=>implode(',',$element->to)]])
            <div class="clearfix"></div>
            @include('form.tags',['var'=>['name'=>'cc','label'=>'Cc','div'=>'col-md-4', 'value'=>implode(',',$element->cc)]])
            @include('form.tags',['var'=>['name'=>'bcc','label'=>'Bcc','div'=>'col-md-4', 'value'=>implode(',',$element->bcc)]])
            <div class="clearfix"></div>

            @include('form.textarea',['var'=>['name'=>'html','label'=>'Body','div'=>'col-md-8', 'class'=>'ckeditor','editor_config'=>'editor_config_extended']])
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-8 no-padding-r">

                    <?php
                    $section = 'linked-module'
                    ?>

                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a data-toggle="collapse" href="#{{$section}}_panel">
                                        <ion-icon name="unlink-outline"></ion-icon>
                                        Linked Module
                                    </a>
                                </h5>
                            </div>
                            <div id="{{$section}}_panel" class="panel-collapse collapse" style="margin:15px 0;">
                                <div class="col-md-12">
                                    @include('form.select-model',['var'=>['name'=>'module_id','label'=>'Module','model'=>App\Module::class,'class'=>'select2','show_inactive'=>true]])
                                    @include('form.text',['var'=>['name'=>'element_id','label'=>'Element Id']])
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    {{--        @include('form.select-model',['var'=>['name'=>'notification_id','label'=>'Notification','model'=>App\Notification::class,'class'=>'select2']])--}}
                    <div class="clearfix"></div>
                    @include('form.plain-text',['var'=>['name'=>'status_name','label'=>'Status','options'=>kv(App\Email::$emailStatusNameTypes)]])
                    @include('form.plain-text',['var'=>['name'=>'attempts','label'=>'Attempts']])
                    @include('form.plain-text',['var'=>['name'=>'last_attempted_at','label'=>'Last attempted at']])
                    @include('form.plain-text',['var'=>['name'=>'successfully_delivered_at','label'=>'Successfully delivered at']])

                </div>
            </div>
            {{---------------|  Form input start |-----------------------}}

            {{-- @include('form.is-active')--}}
            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection



@section('js')
    @parent
    @include('mainframe.modules.emails.form.js')
    @if($element->isCreated())
        <script>
            // ---------------------------------------------------------
            // Handle Send Now/Queue button event
            // ---------------------------------------------------------
            $('#emailSendNowBtn, #emailQueueBtn, #emailPrintBtn').on('click', function () {

                var url = $(this).data('url');
                var redirect_success = $(this).data('redirect_success');

                axios.post(url, {
                    params: {
                        redirect_success: redirect_success
                    }
                }).then(function (response) {
                    showResponseModal(response.data)
                    if (v.count(response.data.redirect)) {
                        window.location.replace(response.data.redirect);
                    }

                }).catch(function (error) {
                    console.log(error);
                });
            })

        </script>
    @endif
@endsection
