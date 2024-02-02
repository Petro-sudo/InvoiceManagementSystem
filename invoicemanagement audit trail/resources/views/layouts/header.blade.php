<nav class="navbar navbar-expand-lg navbar-light">
    <a href="{{route('dashboard')}}" class="inline-block w-auto p-2 mb-10">
        <img src="{{ asset('image/dotleft.jpg') }}" alt="" class="object-cover object-top w-18 h-12 align-top">
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <div class="navbar-nav ml-auto">
            <div class="navbar-form-wrapper">
                <form class="navbar-form form-inline">
                    <div class="input-group search-box">
                        <label type="text" id="search" class="form-control" placeholder="Search Here...">{{Auth::user()->name}}
                            {{Auth::user()->surname}}</label>
                    </div>
                </form>
            </div>
            <a href="{{ route('logout') }}" class="nav-item nav-link"><i class="fa fa-sign-out"> Logout</i></a>
        </div>
    </div>
</nav>