<?php

$default = [
    'id' => 'ajaxPostBtn'.randomString(),
    'class' => 'btn',
    'text' => 'Make Ajax Post',
    'url' => "#",
    'redirect_success' => URL::full(),
    'redirect_fail' => "#",
    'data' => [],

];

/** @var array $var */
$var = array_merge($default, $var ?? []);
$var['class'] .= ' ajax-post-btn';

$dataAttrs = '';
foreach ($var['data'] as $k => $v) {
    $dataAttrs .= " data-".$k."='".$v."'";
}

?>

<a id="{{$var['id']}}" class="{{$var['class']}}"
   data-url="{{$var['url']}}"
   data-redirect_success="{!! $var['redirect_success'] !!}"
   data-redirect_fail="{!! $var['redirect_fail'] !!}"
        {!! $dataAttrs !!}> {!! $var['text'] !!}
</a>


@section('js')
    @parent

    <?php
    $params = [
        'redirect_success' => $var['redirect_success'],
        'redirect_fail' => $var['redirect_fail'],
    ];
    foreach ($var['data'] as $k => $v) {
        $params[$k] = $v;
    }
    ?>

    <script>
        $('#{{$var['id']}}').on('click', function () {
            var url = $(this).data('url');
            var btn = $(this);

            btn.addClass('disabled').attr('disabled', true);

            axios.post(url, {
                params: {!! \Illuminate\Support\Js::from($params) !!}
            }).then(function (response) { // Axios' response is wrapped in response.data i.e response.data.status, response.data.data
                showResponseModal(response.data)
                if (response.data.status === 'success') {
                    if (v.count(response.data.redirect)) {
                        window.location.replace(response.data.redirect);
                    }
                }

            }).catch(function (error) {
                // console.log(error)
            })
            .then(function () {
                btn.removeClass('disabled').attr('disabled', false); // Re-enable the button
            });

        });
    </script>

@endsection


@unset($var, $default)
