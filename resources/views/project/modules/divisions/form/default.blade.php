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
 * @var \App\Division $element
 * @var \App\Division $division
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Divisions\DivisionViewProcessor $view
 */
$division = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-11 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
            @include('form.text',['var'=>['name'=>'name_bn','label'=>'Name (Bangla)']])
            @include('form.number',['var'=>['name'=>'code','label'=>'Code']])
            <div class="clearfix"></div>
            @include('form.number',['var'=>['name'=>'longitude','label'=>'Longitude','params'=>['step'=>'any']]])
            @include('form.number',['var'=>['name'=>'latitude','label'=>'Latitude','params'=>['step'=>'any']]])

            <div class="clearfix"></div>
            @include('form.is-active')
            <div class="clearfix"></div>

            @if($element->isCreated())
                <div class="col-md-9 form-group m-v-20">
                    <h3>Districts</h3>
                    <div class="bordered">
                        @if(user()->can('update',$element))
                            @php
                                /*
                                |--------------------------------------------------------------------------
                                | Dynamic modal content from partial
                                |--------------------------------------------------------------------------
                                */
                                $var = [
                                    'name' => 'createDistrictModal',
                                    'btn_text' => "<ion-icon name='add-outline'></ion-icon> Add ",
                                    'btn_class' => 'btn-bordered-blue',
                                    'url' => route('partials.district-add-modal', ['division_id' => $element->id]),
                                ];
                            @endphp
                            @include('mainframe.layouts.default.includes.modals.dynamic')
                        @endif

                        @php
                            $datatable = new \App\Project\Datatables\DistrictWidgetDatatable();
                            $datatable->addUrlParam(['division_id' => $element->id]);
                            $datatable->name = 'districtDatatable';
                            $datatable->bPaginate = true;
                            //$datatable->minimal();
                        @endphp
                        @include('form.datatable',['datatable'=>$datatable])
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endif
            <div class="clearfix"></div>

            <div class="clearfix"></div>
            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('project.modules.divisions.form.js')
@endsection
