@section('content-top')
    @parent
    <div class="btn-group">
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                Profiles
                <i class="fa fa-angle-down"></i>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" target="_blank">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li class="divider"></li>
                <li><a href="#">Link 3</a></li>
            </ul>
        </div>
        
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fi fi-rr-clipboard-check"></i> Actions
                <span class="fa fa-angle-down"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Apply</a></li>
            </ul>
        </div>
        <button type="button" class="btn btn-danger "
                onclick="location.href='http://local';">Goto 1
        </button>
        <button type="button" class="btn btn-danger"
                onclick="location.href='http://local';">Goto 2
        </button>
    </div>
@endsection