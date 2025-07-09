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
 * @var \App\Upazila $element
 * @var \App\Upazila $upazila
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Upazilas\UpazilaViewProcessor $view
 */
$upazila = $element;
?>
@section('content-top')
    @parent
    @include('mainframe.form.back-link',['var'=>['element'=>$element->district]])
@endsection

@section('content')
    <div class="col-md-12 no-padding">
        @if($formState == 'create')
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif
        {{---------------|  Form input start |-----------------------}}
        <?php
        $levels = [
            ['name' => 'division_id', 'label' => 'Division', 'model' => \App\Division::class],
            [
                'name' => 'district_id',
                'label' => 'District',
                'model' => \App\District::class,
                'query' => \App\District::where('division_id', $element->division_id)
            ],
        ];
        ?>
        @include('form.select-model-chained',['levels'=>$levels])

        <div class="clearfix"></div>
        @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
        @include('form.text',['var'=>['name'=>'name_bn','label'=>'Name (Bangla)']])
        @include('form.number',['var'=>['name'=>'code','label'=>'Code']])
        <div class="clearfix"></div>
        @include('form.plain-text',['var'=>['name'=>'combined_code','label'=>'Combined Code','tooltip'=>'Auto Generated']])
        @include('form.number',['var'=>['name'=>'longitude','label'=>'Longitude']])
        @include('form.number',['var'=>['name'=>'latitude','label'=>'Latitude']])

        <div class="clearfix"></div>
        @include('form.is-active')
        {{---------------|  Form input start |-----------------------}}

        @include('form.action-buttons')
        {{ Form::close() }}
    </div>
@endsection



@section('js')
    @parent
    @include('project.modules.upazilas.form.js')
@endsection
