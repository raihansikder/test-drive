@if(!$input->isHidden)
    <div class="form-control readonly {{$input->name}} height-auto" id="{{$input->id}}">
        {!!  $input->print()  !!}
    </div>
@endif
{{ Form::hidden($input->name, $input->value(),$input->params)}}