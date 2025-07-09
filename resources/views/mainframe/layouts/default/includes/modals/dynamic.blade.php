<?php
$default = [
    'name' => Str::random(8).'Modal', // Modal name
    // 'btn_text' => "<ion-icon name='add-outline'></ion-icon> Open Modal", // Test to show on butotn
    'btn_class' => '', // Button class
    'width' => '700px',
    'url' => '#', // GET URL
];

/** @var array $var */
$var = array_merge($default, $var);
?>
@if($var['btn_text'])
    <button type="button" class="btn {{$var['btn_class']}}"
            data-toggle="modal" id="{{$var['name']}}Btn"
            data-target="#{{$var['name']}}">
        {!! $var['btn_text'] !!}
    </button>
@endif
{{-- Modal  --}}
@section('content-bottom')
    @parent
    <div class="modal fade {{Str::kebab($var['name'])}}-modal" id="{{$var['name']}}" role="dialog"
         aria-labelledby="{{$var['name']}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: {{$var['width']}}">
            <div class="modal-content" id="dynamicContent">
                {{-- Section: Dynamic form content--}}
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $('#{{$var['name']}}Btn').on('click', function () {
            axios.get('{!! $var['url'] !!}').then(function (response) { // Axios' response is wrapped in response.data i.e response.data.status, response.data.data
                $('#{{$var['name']}} #dynamicContent').html(response.data);
            }).catch(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection

@unset($var)
