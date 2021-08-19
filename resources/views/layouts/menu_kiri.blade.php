<nav style="background-color:#052852" class="navbar navbar-expand-sm navbar-default">

    <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="./">Price Monitoring</a>
        <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo2.png') }}" alt="Logo"></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">

        <ul class="nav navbar-nav">
            <h3 class="menu-title">Menu</h3><!-- /.menu-title -->

            <li>
                <a href="{{url('/')}}"> <i class="menu-icon fa fa-id-badge"></i>Link Submission Page</a>
            </li>

            <li>
                <a href="{{url('/link/list')}}"> <i class="menu-icon fa fa-pencil-square"></i>All Submitted Links</a>
            </li>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
