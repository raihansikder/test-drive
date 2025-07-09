<a href="{{route('home')}}" class="logo">

            <span class="logo-mini">
                {{-- <img style="width: 80%" src="{{asset("project/images/logo-mini.png")}}" alt="{{config('app.name')}}"/>--}}
                 <span class="logo-lg">{{substr(config('app.name'),0,1)}}</span>
            </span>
    <span class="logo-lg">
                 {{-- <img style="width: 50%" src="{{asset("project/images/logo-large.png")}}" alt="{{config('app.name')}}"/>--}}
                 <span class="logo-lg">{{config('app.name')}}</span>
             </span>
    <span class="logo-lg">{{config('app.name')}}</span>
</a>

<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            {{--@include('template.include.top-menu.message-menu')--}}
            {{--@include('template.include.top-menu.message-menu')--}}
            {{--@include('template.include.top-menu.task-menu')--}}
            {{--@include('mainframe.layouts.default.includes.navigation.top-menu.task-menu')--}}
            @auth
                @include('mainframe.layouts.default.includes.navigation.top-menu.quick-module-finder')
            @endauth
            @include('mainframe.layouts.default.includes.navigation.top-menu.top-right-menu')
            {{--<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>--}}
        </ul>
    </div>
</nav>
