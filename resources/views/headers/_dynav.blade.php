
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">My Blog</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

                @foreach($navItems as $nav)
                    <li
                            @if ( Request::path()=='/' && Request::path()==$nav['url'] )
                            class="active"
                            @elseif ( Request::path()!='/' && strtok(Request::path(),'/')==$nav['url'] )
                            class="active"
                            @endif >
                        <a href="@if ($nav['url']=='/') / @else /{{$nav['url']}} @endif">{{studly_case($nav['title'])}}</a>
                    </li>
                @endforeach


            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li @if ( Request::path()=='login' ) class="active" @endif ><a href="{{ url('/login') }}">Login</a></li>
                    <li @if ( Request::path()=='register' ) class="active" @endif ><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown @if ( Request::path()!='/' && strtok(Request::path(),'/')=='user' ) active @endif">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/user/dashboard">
                                    <i class="glyphicon glyphicon-dashboard"></i> Dashboard
                                </a></li>
                            <li role="presentation" class="divider"></li>
                            <li>


                                <a href="/user/profile">
                                    <i class="glyphicon glyphicon-user"></i> Profile
                                </a>
                            </li>
                            <li role="presentation" class="divider"></li>

                            <li>
                                <a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>

            <form class="navbar-form" role="search" method="GET" action="/search">
                <div class="form-group" style="display:inline;">
                    <div class="input-group search-bar" style="display:table;">

                        <input class="form-control" name="q" placeholder="Search Here" autocomplete="off" autofocus="autofocus" type="text">
                        <div class="input-group-btn">

                        </div>
                        <span class="input-group-addon" style="width:1%;">
                            <span class="glyphicon glyphicon-search"></span>
                        </span>
                    </div>
                </div>
            </form>

        </div>
    </div>
</nav>