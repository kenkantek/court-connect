<div class="header-1">
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ route('home.index') }}" class="logo"><img src="{{ asset('resources/home/images/logo_02.png') }}" class="img-responsive logo" alt="logo"></a>
            </div>
           @include('home.layouts.menu')
        </nav>
    </div>
</div>
