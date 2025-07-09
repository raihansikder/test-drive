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
 * @var \App\SupportTicket $element
 * @var \App\SupportTicket $supportTicket
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\SupportTickets\SupportTicketViewProcessor $view
 */
$supportTicket = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-11 col-lg-9 col-xl-8">

            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            <?php
            $levels = [
                [
                    'name' => 'primary_category_id',
                    'label' => 'Primary Category',
                    'model' => \App\SupportTicketCategory::class,
                    'query' => \App\SupportTicketCategory::where('parent_id', 0),
                    'url_param' => 'parent_id',
                ],
                [
                    'name' => 'secondary_category_id',
                    'label' => 'Secondary Category',
                    'model' => \App\SupportTicketCategory::class,
                ],
            ]
            ?>

            @include('form.select-model-chained',['levels'=>$levels])
            @include('form.number',['var'=>['name'=>'contact_no','label'=>'Mobile No.(+88)','div'=>'col-md-3']])

            <?php
            $options = \App\SupportTicket::$statusOptions;
            if ($element->isCreating()) {
                $options = [\App\SupportTicket::SUPPORT_TICKET_STATUS_NEW];
            }
            ?>
            @include('form.select-array',['var'=>['name'=>'status_name','label'=>'Status','div'=>'col-md-3','class'=>'select2','options'=>kv($options)]])

            @include('form.text',['var'=>['name'=>'name','label'=>'Subject(English/Bangla)','div'=>'col-md-12']])
            @include('form.textarea',['var'=>['name'=>'details','label'=>'Details(English/Bangla)','div'=>'col-md-12']])

            @if($view->showReviewerSection())
                <div class="form-group col-md-12">
                    <div class="bordered col-md-12 margin-v-20"
                         style="border: 1px solid royalblue; display: inline-block;  background-color: aliceblue">
                        <h3 class="no-padding no-margin-t pull-left" style="color: royalblue">
                            Reviewer feedback
                        </h3>
                        <div class="clearfix"></div>

                        @include('form.textarea',['var'=>['name'=>'reviewers_note','label'=>"Reviewer's note",'div'=>'col-md-6']])
                        <?php
                        $var = [
                            'name' => 'support_ticket_tag_ids',
                            'label' => 'Tags',
                            'model' => new \App\SupportTicketTag,
                            'name_field' => 'name',
                            'div' => 'col-sm-6',
                        ];
                        ?>
                        @include('form.select-model-multiple', compact('var'))
                    </div>
                </div>
            @endif

            <div class="clearfix"></div>
            @include('form.is-active')
            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('content-bottom')
    @parent
    <div class="row">
        <div class="col-md-12 col-lg-10 col-xl-8">
            <div class="col-md-6 no-padding-l">
                <h3>Supporting Documents</h3><small>Upload one or more files</small>
                @include('form.uploads',['var'=>['limit'=>5,'type'=>\App\Upload::TYPE_SUPPORTING_DOCUMENT]])
            </div>

            <div class="clearfix"></div>
            @if($element->isCreated())
                <div class="col-md-6 no-padding-l">
                    <h3>Comments</h3>
                    @include('form.comments')
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.support-tickets.form.js')
@endsection
