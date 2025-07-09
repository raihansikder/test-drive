<?php
/**
 * @var \Illuminate\Support\ViewErrorBag $errors
 * @var \Illuminate\Support\MessageBag $messageBag
 */

/**
 * These vars are passed from \App\Mainframe\Features\Responder\Response::defaultViewVars
 */

$response = $response ?? session('response');
$messageBag = $response['messageBag'] ?? null;
$showAlerts = $showAlerts ?? true;

// dd($messageBag);

$css = "callout-danger";
$textCss = "text-red";
if (isset($response['status']) && $response['status'] == 'success') {
    $css = "callout-success";
    $textCss = "text-green";
}

$hasAlerts = false;
if ((isset($response['status'], $response['message']))
    || ($errors instanceof \Illuminate\Support\MessageBag && $errors->any())
    || ($messageBag && $messageBag->count())) {
    $hasAlerts = true;
}

if ($showAlerts && $hasAlerts) {
    $keys = ['errors', 'messages', 'warnings', 'debug'];

    $alerts = [];
    if (isset($messageBag)) {
        foreach ($keys as $key) {
            if ($messages = $messageBag->messages()[$key] ?? []) {
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $alerts = array_merge($alerts, $messages);
            }
        }
    }
    $alerts = collect(Arr::flatten($alerts))->unique()->toArray();
}


?>
@if($showAlerts && $hasAlerts)
    <div class="message-container">
        <div class="callout ajaxMsg errorDiv" id="errorDiv">
            @if(isset($response['status']))
                <h3 class="{{$textCss}}">
                    {{ ucfirst($response['status']) }}
                </h3>
                {{ $response['message'] ?? '' }}
            @endif
            <div class="clearfix"></div>

            @if(count($alerts))
                {!! implode('<br/>',$alerts) !!}<br/>
            @elseif ($errors->any())
                {!! implode('<br/>', $errors->all()) !!}
            @endif
        </div>
    </div>
@endif

<?php session()->forget(['status', 'message', 'error']); ?>
