<?php
/**
 * @var \App\SupportTicket $element
 */
?>
<p>Support ticket status has been updated to {{$element->status_name}}</p>

<table style="width:100%; border-collapse: collapse;" class="table">
    <tbody>
    <tr>
        <td style="width: 20%;">Title</td>
        <td><a href="{!! $element->editUrl() !!}"> {{$element->id}} - {{$element->name}}</a></td>
    </tr>
    <tr>
        <td>Status</td>
        <td>{!! $element->status_name !!}</a></td>
    </tr>
    <tr>
        <td>Category</td>
        <td style="">{!! $element->primary_category_name !!} » {!! $element->secondary_category_name !!}</td>
    </tr>
    <tr>
        <td>Description</td>
        <td style="">{!! $element->details !!}</td>
    </tr>
    <tr>
        <td>Created By</td>
        <td style="">
            <?php
            $str = $element->created_by;
            if ($element->creator) {
                $str = $element->creator->name."( ".$element->creator->email." )";
            }
            ?>
            {{$str}}
        </td>
    </tr>

    <tr>
        <td>Created At</td>
        <td style="">{{formatDateTime($element->created_at)}}</td>
    </tr>

    </tbody>
</table>
<br/>
<a target="_blank" href="{!! $element->editUrl() !!}"> <u>Click to view details</u></a>
