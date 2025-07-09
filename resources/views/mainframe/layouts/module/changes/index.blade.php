@extends($view->defaultTemplate())

<?php
/**
 * @var $view \App\Mainframe\Features\Core\ViewProcessor
 */
?>

@section('title')
    Change log
@endsection

@section('content-top')
    @parent
    @include('mainframe.form.back-link',['var'=>['element'=>$element]])
@endsection

@section('content')
    <div class="clearfix"></div>
    <table class="table table-bordered table-condensed table-hover table-audits" id="changelist">
        <thead>
        <tr>
            <th style="width: 20%">Timestamp</th>
            <th>Changes (Old -> New)</th>
        </tr>
        </thead>
        <tbody>

        @foreach($audits as $audit)
            <?php /** @var \OwenIt\Auditing\Models\Audit $audit */ ?>
            <tr class="no-padding no-margin">
                <td style="width: 20%; font-size: .8em">
                    {{pad($audit->id)}} @ {{$audit->updated_at}}
                    <span class="label btn-bordered-blue">
                        {{strtoupper($audit->event)}}
                    </span> &nbsp;
                    {{optional($audit->user)->email}}
                </td>
                <td class="no-padding no-margin">
                    <table class="table table-hover no-margin no-padding">

                        {{-- @if($loop->first)--}}
                        {{--     <thead>--}}
                        {{--     <tr>--}}
                        {{--         <th style="width: 10%">Field</th>--}}
                        {{--         <th style="width: 45%">Old value</th>--}}
                        {{--         <th style="width: 45%">New Value</th>--}}
                        {{--     </tr>--}}
                        {{--     </thead>--}}
                        {{-- @endif--}}
                        <?php
                        $changes = $audit->getModified();
                        ?>
                        @foreach($changes as $title => $value)
                            <tbody>
                            <tr class="no-padding no-margin">
                                <td style="width: 20%;font-size: .8em"><code>{{$title}}</code></td>
                                <td style="width: 40%;font-size: .8em" class="no-padding no-margin">
                                    @if(isset($value['old']) && is_array($value['old']))
                                        {{echoArray($value['old'])}}
                                    @else
                                        {{$value['old'] ?? ''}}
                                    @endif
                                </td>
                                <td style="width: 40%;font-size: .8em" class="no-padding no-margin">
                                    @if(isset($value['new']) && is_array($value['new']))
                                        {{echoArray($value['new'])}}
                                    @else
                                        {{$value['new'] ?? ''}}
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    @parent
    <script>
        // datatable
        var table = $('#changelist').dataTable({
            "bPaginate": false,
            order: [[0, 'desc']] // Show the latest ones first
        });
    </script>
@endsection
