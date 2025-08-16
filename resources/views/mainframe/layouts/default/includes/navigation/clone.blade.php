@if($element->isCreated())
    <form class="pull-right module-clone-form" method="post" action="{{route($module->name.'.clone',$element->id)}}">
        @csrf
        <button class="btn btn-bordered-smart-red btn-clone uppercase" type="submit">
            <i class="fi fi-rr-plus"></i>
            Clone
        </button>
    </form>
@endif
