<div class="sidebar-nav">
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- pages -->
                <li class="dropdown {!! (Request::is('sadmin/setting/pages*') ? 'active' : '') !!}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>Pages</span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li {!! (Request::is('sadmin/setting/pages') ? 'class="active" id="active"' : '') !!}>
                            <a href="{{ route("admin.setting.pages") }}">
                                <i class="fa fa-angle-double-right"></i>
                                Pages
                            </a>
                        </li>
                        <li {!! (Request::is('sadmin/setting/pages/create') ? 'class="active" id="active"' : '') !!}>
                            <a href="{{ route("admin.setting.pages.create") }}">
                                <i class="fa fa-angle-double-right"></i>
                                New Page
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- answer and question -->
                <li class="dropdown {!! (Request::is('sadmin/setting/faq*') ? 'active' : '') !!}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Question & Answer<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li {!! (Request::is('sadmin/setting/faq') ? 'class="active" id="active"' : '') !!}>
                            <a href="{{ route("admin.setting.faq") }}">
                                <i class="fa fa-angle-double-right"></i>
                                Question & Answer
                            </a>
                        </li>
                        <li {!! (Request::is('admin/setting/faq/create') ? 'class="active" id="active"' : '') !!}>
                            <a href="{{ route("admin.setting.faq.create") }}">
                                <i class="fa fa-angle-double-right"></i>
                                New Question & Answer
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- contact -->
                <li class="dropdown {!! (Request::is('sadmin/setting/contacts*') ? 'active' : '') !!}">
                    <a href="{{ route("admin.setting.contacts") }}">Contact</a>
                </li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<style>
    /* make sidebar nav vertical */
    @media (min-width: 768px) {
        .sidebar-nav .navbar .navbar-collapse {
            padding: 0;
            max-height: none;
        }
        .sidebar-nav .navbar ul {
            float: none;
            padding: 5px 10px;
        }
        .sidebar-nav .navbar ul:not {
            display: block;
        }
        .sidebar-nav .navbar li {
            float: none;
            display: block;
            border-bottom: 1px solid #ccc;
        }
        .sidebar-nav .navbar li:last-child{
            border-bottom: 0px;
        }
        .sidebar-nav .navbar li a {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            position: relative;
            padding: 5px 10px;
        }
        .sidebar-nav .navbar li a .caret{
            position: absolute;
            right: 10px;
            top: calc(50% - 2px);
        }
        .sidebar-nav .navbar li ul.dropdown-menu{
            width: 100%;
        }
    }
</style>