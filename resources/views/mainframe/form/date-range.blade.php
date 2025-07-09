<?php
/*
|--------------------------------------------------------------------------
| Vars
|--------------------------------------------------------------------------
|
| This view partial can be included with a config variable $var.
| $var is an array and can have following keys.
| if a $var is not set the default value will be use.
|
*/
/**
 *      $var['div'] ?? 'col-md-3';
 *      $var['label']           ?? null;
 *      $var['label_class']     ?? null;
 *      $var['type']            ?? null;
 *      $var['value']           ?? null;
 *      $var['name']            ?? Str::random(8);
 *      $var['params']          ?? [];  // These are the html attributes like css, id etc for the field.
 *      $var['editable']        ?? true;
 *
 * @var \Illuminate\Support\ViewErrorBag $errors
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 * @var bool $editable
 * @var array $immutables
 * @var array $var
 */

$var = \App\Mainframe\Features\Form\Form::setUpVar($var, $errors ?? null, $element ?? null, $editable ?? null,
    $immutables ?? null, $hiddenFields ?? null);
$input = new App\Mainframe\Features\Form\Text\DateRange($var);

$input->format = config('mainframe.config.date_format'); // Format to show in the datepicker
?>
@if($input->isHidden)
    {{ Form::hidden($input->name, $input->value()) }}
@else
    <div class="{{$input->containerClasses()}}" id="{{$input->uid}}">

        {{-- label --}}
        @include('mainframe.form.includes.label')

        {{-- input --}}
        @if($input->isEditable)
            @include('form.hidden',['var'=>['name'=>$input->name.'_from', 'class'=>'hidden datepicker-hidden filter-input']])
            @include('form.hidden',['var'=>['name'=>$input->name.'_till', 'class'=>'hidden datepicker-hidden filter-input']])
            <button type="button" class="date-range-picker {{$input->params['class']}}"
                    id="{{$input->dateRangePickerBtnId()}}">
                {!! $input->rangeAllText() !!}
            </button>
        @else
            @include('mainframe.form.includes.read-only-view')
        @endif

        {{-- Error --}}
        @include('mainframe.form.includes.show-error')
    </div>
@endif

@section('js')
    @if(!$input->isHidden && $input->isEditable)

        <script>
            //http://www.daterangepicker.com/
            var dateRangePickerBtnId = '{{$input->dateRangePickerBtnId()}}'; // {InputId}DateRangeBtn
            var daterangepicker_{{$input->params['id']}} = $('#' + dateRangePickerBtnId).daterangepicker(
                {
                    ranges: {
                        // 'All': [moment().subtract(100, 'years'), moment().endOf('month')],
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(1, 'days'),
                    endDate: moment().add(1, 'days'),
                    locale: {
                        format: "{{$input->jsDateFormat()}}",
                        cancelLabel: 'Clear',
                        autoApply: false,
                        autoUpdateInput: false
                    },

                },
                function (start, end, label) {
                    $('#{{$input->name}}_from').val(start.format('YYYY-MM-DD')); // Assign SQL native date format in hte hidden field
                    $('#{{$input->name}}_till').val(end.format('YYYY-MM-DD'));
                    $('#' + dateRangePickerBtnId).html(start.format('{{$input->jsDateFormat()}}') + ' - ' + end.format('{{$input->jsDateFormat()}}'));
                }
            ).on('apply.daterangepicker', function (ev, picker) {
                // console.log(picker.startDate.format('YYYY-MM-DD'));
                // console.log(picker.endDate.format('YYYY-MM-DD'));
                let start = picker.startDate;
                let end = picker.endDate;

                $('#{{$input->name}}_from').val(start.format('YYYY-MM-DD')); // Assign SQL native date format in hte hidden field
                $('#{{$input->name}}_till').val(end.format('YYYY-MM-DD'));
                $('#' + dateRangePickerBtnId).html(start.format('{{$input->jsDateFormat()}}') + ' - ' + end.format('{{$input->jsDateFormat()}}'));


            }).on('cancel.daterangepicker', function (ev, picker) {
                $('#{{$input->name}}_from, #{{$input->name}}_till').val('');
                $('#' + dateRangePickerBtnId).html(' - ');
            });

        </script>

        @if(request($input->name.'_from') && request($input->name.'_till'))
            <script>
                //Date range will be shown as per the given inputs
                var date_from = "{{date_create(request($input->name.'_from'))->format($input->dateFormat())}}";
                var date_till = "{{date_create(request($input->name.'_till'))->format($input->dateFormat())}}";

                $('#' + dateRangePickerBtnId).data('daterangepicker').setStartDate(date_from);
                $('#' + dateRangePickerBtnId).data('daterangepicker').setEndDate(date_till);
                $('#' + dateRangePickerBtnId).html(date_from + ' - ' + date_till + ' ');
            </script>
        @endif
    @endif

    @parent
@stop

<?php unset($input) ?>
