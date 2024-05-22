<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Management | KS Gia Huy</title>
        <link rel="icon" href="{{asset('royal/image/favicon.png')}}" type="image/png">
        <!-- Tell the browser to be responsive to screen width -->
        <meta
            content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
            name="viewport"
        />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <link
            rel="stylesheet"
            href="{{
                asset('bower_components/bootstrap/dist/css/bootstrap.min.css')
            }}"
        />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="{{
                asset('bower_components/font-awesome/css/font-awesome.min.css')
            }}"
        />
        <!-- Ionicons -->
        <link
            rel="stylesheet"
            href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}"
        />
        <!-- Theme style -->
        <link
            rel="stylesheet"
            href="{{ asset('dist/css/AdminLTE.min.css') }}"
        />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
        <link
            rel="stylesheet"
            href="{{ asset('dist/css/skins/_all-skins.min.css') }}"
        />
        <!-- Morris chart -->
        <link
            rel="stylesheet"
            href="{{ asset('/bower_components/morris.js/morris.css') }}"
        />
        <!-- jvectormap -->
        <link
            rel="stylesheet"
            href="{{
                asset('bower_components/jvectormap/jquery-jvectormap.css')
            }}"
        />
        <!-- Date Picker -->
        <link
            rel="stylesheet"
            href="{{
                asset(
                    'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'
                )
            }}"
        />
        <!-- Daterange picker -->
        <link
            rel="stylesheet"
            href="{{
                asset(
                    'bower_components/bootstrap-daterangepicker/daterangepicker.css'
                )
            }}"
        />
        <!-- bootstrap wysihtml5 - text editor -->
        <link
            rel="stylesheet"
            href="{{
                asset(
                    'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
                )
            }}"
        />

        <link
            rel="stylesheet"
            href="{{ asset('/datatable_js/jquery.dataTables.min.css') }}"
        />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"
        />

        @yield('css')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="/admin/home" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini" style="color: #1b74e7"
                        ><b>P</b>K</span
                    >
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"
                        ><img
                            style="max-height: 40px"
                            src="{{
                                asset(
                                    'images/icons/logo-shortcut.jpeg'
                                )
                            }}"
                            class="img-fluid"
                    /></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a
                        href="#"
                        class="sidebar-toggle"
                        data-toggle="push-menu"
                        role="button"
                    >
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a
                                    href="#"
                                    class="dropdown-toggle"
                                    data-toggle="dropdown"
                                >
                                    <i class="fa fa-bell-o"></i>
                                    <span
                                        class="label label-danger count-notifications"
                                        style="font-size: 11px"
                                    ></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Thông báo</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu" id="tbody"></ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a
                                    href="#"
                                    class="dropdown-toggle"
                                    data-toggle="dropdown"
                                >
                                    @if(Auth::guard('admin')->check())
                                    <img
                                        src="{{asset('images/admins/'.Auth::guard('admin')->user()->avatar)}}"
                                        class="user-image"
                                        alt="User Image"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset('dist/img/user2-160x160.jpg')
                                        }}"
                                        class="img-image"
                                        alt="User Image"
                                    />@endif

                                    <span class="hidden-xs">
                                        {{Auth::guard('admin')->user()->name}}</span
                                    >
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        @if(Auth::guard('admin')->check())
                                        <img
                                            src="{{asset('images/admins/'.Auth::guard('admin')->user()->avatar)}}"
                                            class="img-circle"
                                            alt="User Image"
                                        />
                                        @else
                                        <img
                                            src="{{
                                                asset(
                                                    'dist/img/user2-160x160.jpg'
                                                )
                                            }}"
                                            class="img-circle"
                                            alt="User Image"
                                        />@endif

                                        <p>
                                            Booking
                                            <small
                                                >{{\Carbon\Carbon::parse(Auth::guard('admin')->user()->created_at)->format('d-m-Y')}}</small
                                            >
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a
                                                href="/admin/change/password"
                                                class="btn btn-default btn-flat"
                                                >Đổi mật khẩu</a
                                            >
                                        </div>
                                        <div class="pull-right">
                                            <a
                                                href="/admin/logout"
                                                class="btn btn-default btn-flat"
                                                >Đăng xuất</a
                                            >
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"
                                    ><i class="fa fa-gears"></i
                                ></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            @if(Auth::guard('admin')->check())
                            <img
                                src="{{asset('images/admins/'.Auth::guard('admin')->user()->avatar)}}"
                                class="img-circle"
                                alt="User Image"
                            />
                            @else
                            <img
                                src="{{ asset('dist/img/user2-160x160.jpg') }}"
                                class="img-circle"
                                alt="User Image"
                            />@endif
                        </div>
                        <div class="pull-left info">
                            <p>
                                @if(Auth::guard('admin')->check()){{Auth::guard('admin')->user()->name}}
                                @endif
                            </p>
                            <a href="#"
                                ><i class="fa fa-circle text-success"></i>
                                Online</a
                            >
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input
                                type="text"
                                name="q"
                                class="form-control"
                                placeholder="Search..."
                            />
                            <span class="input-group-btn">
                                <button
                                    type="submit"
                                    name="search"
                                    id="search-btn"
                                    class="btn btn-flat"
                                >
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>

                        @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->level == 1)
                        <li class="active treeview">
                            <a href="#">
                                <i class="fa fa-sitemap"></i>
                                <span>Quản lý đặt phòng</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="/admin/reservation"
                                        ><i class="fa fa-user-circle"></i> Danh sách đặt phòng
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <li class="active treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Sản phẩm</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="/admin/category"
                                        ><i class="fa fa-list-alt"></i> Loại phòng
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/room"
                                        ><i class="fa fa-newspaper-o"></i> Danh sách phòng khách sạn</a
                                    >
                                </li>
                            </ul>
                        </li>

                        <!-- <li class="active treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Bài viết - Tin tức</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="/admin/category"
                                        ><i class="fa fa-list-alt"></i> Chủ đề
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/tag"
                                        ><i
                                            class="glyphicon glyphicon-tags"
                                        ></i>
                                        Thẻ liên quan</a
                                    >
                                </li>
                                <li>
                                    <a href="/admin/post"
                                        ><i class="fa fa-newspaper-o"></i> Bài
                                        viết</a
                                    >
                                </li>
                            </ul>
                        </li> -->

                        <!-- <li class="active treeview">
                            <a href="#">
                                <i class="fa fa-picture-o"></i>
                                <span>Quảng cáo</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="/admin/slide"
                                        ><i class="fa fa-sliders"></i> Slideshow
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <!-- <li class="active treeview">
                            <a href="#">
                                <i class="fa fa-random"></i>
                                <span>Góp ý phản hồi</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="/admin/contact"
                                        ><i class="fa fa-connectdevelop"></i>
                                        Nội dung phản hồi
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <!-- <li class="active treeview">
                            <a href="#">
                                <i class="fa fa-trophy"></i>
                                <span>Thông tin</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="/admin/edit/intro"
                                        ><i class="fa fa-info-circle"></i> Giới
                                        thiệu
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>
                            <section class="controll">
                                @yield('controll')
                            </section>
                        </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin/home"
                                ><i class="fa fa-dashboard"></i> Home</a
                            >
                        </li>
                        <li class="active">@yield('controll')</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">@yield('content')</section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs"><b>Version</b> 2.8.0</div>
                <strong
                    >Copyright &copy; 2021-2022
                    <a href="">FPT Telecom</a>.</strong
                >
                All rights reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li>
                        <a href="#control-sidebar-home-tab" data-toggle="tab"
                            ><i class="fa fa-home"></i
                        ></a>
                    </li>
                    <li>
                        <a
                            href="#control-sidebar-settings-tab"
                            data-toggle="tab"
                            ><i class="fa fa-gears"></i
                        ></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i
                                        class="menu-icon fa fa-birthday-cake bg-red"
                                    ></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">
                                            Langdon's Birthday
                                        </h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i
                                        class="menu-icon fa fa-user bg-yellow"
                                    ></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">
                                            Frodo Updated His Profile
                                        </h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i
                                        class="menu-icon fa fa-envelope-o bg-light-blue"
                                    ></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">
                                            Nora Joined Mailing List
                                        </h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i
                                        class="menu-icon fa fa-file-code-o bg-green"
                                    ></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">
                                            Cron Job 254 Executed
                                        </h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span
                                            class="label label-danger pull-right"
                                            >70%</span
                                        >
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div
                                            class="progress-bar progress-bar-danger"
                                            style="width: 70%"
                                        ></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span
                                            class="label label-success pull-right"
                                            >95%</span
                                        >
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div
                                            class="progress-bar progress-bar-success"
                                            style="width: 95%"
                                        ></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span
                                            class="label label-warning pull-right"
                                            >50%</span
                                        >
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div
                                            class="progress-bar progress-bar-warning"
                                            style="width: 50%"
                                        ></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span
                                            class="label label-primary pull-right"
                                            >68%</span
                                        >
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div
                                            class="progress-bar progress-bar-primary"
                                            style="width: 68%"
                                        ></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->
                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">
                        Stats Tab Content
                    </div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">
                                General Settings
                            </h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input
                                        type="checkbox"
                                        class="pull-right"
                                        checked
                                    />
                                </label>

                                <p>
                                    Some information about this general settings
                                    option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input
                                        type="checkbox"
                                        class="pull-right"
                                        checked
                                    />
                                </label>

                                <p>Other sets of options are available</p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input
                                        type="checkbox"
                                        class="pull-right"
                                        checked
                                    />
                                </label>

                                <p>
                                    Allow the user to show his name in blog
                                    posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">
                                Chat Settings
                            </h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input
                                        type="checkbox"
                                        class="pull-right"
                                        checked
                                    />
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right" />
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a
                                        href="javascript:void(0)"
                                        class="text-red pull-right"
                                        ><i class="fa fa-trash-o"></i
                                    ></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="{{
                asset('bower_components/jquery/dist/jquery.min.js')
            }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{
                asset('bower_components/jquery-ui/jquery-ui.min.js')
            }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge("uibutton", $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{
                asset('bower_components/bootstrap/dist/js/bootstrap.min.js')
            }}"></script>
        <!-- Morris.js charts -->
        <script src="{{
                asset('bower_components/raphael/raphael.min.js')
            }}"></script>
        <script src="{{
                asset('bower_components/morris.js/morris.min.js')
            }}"></script>
        <!-- Sparkline -->
        <script src="{{
                asset(
                    'bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'
                )
            }}"></script>
        <!-- jvectormap -->
        <script src="{{
                asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')
            }}"></script>
        <script src="{{
                asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')
            }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{
                asset('bower_components/jquery-knob/dist/jquery.knob.min.js')
            }}"></script>
        <!-- daterangepicker -->
        <script src="{{
                asset('bower_components/moment/min/moment.min.js')
            }}"></script>
        <script src="{{
                asset(
                    'bower_components/bootstrap-daterangepicker/daterangepicker.js'
                )
            }}"></script>
        <!-- datepicker -->
        <script src="{{
                asset(
                    'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'
                )
            }}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{
                asset(
                    'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'
                )
            }}"></script>
        <!-- Slimscroll -->
        <script src="{{
                asset(
                    'bower_components/jquery-slimscroll/jquery.slimscroll.min.js'
                )
            }}"></script>
        <!-- FastClick -->
        <script src="{{
                asset('bower_components/fastclick/lib/fastclick.js')
            }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('dist/js/demo.js') }}"></script>

        <script src="{{
                asset('/datatable_js/jquery.dataTables.min.js')
            }}"></script>
    </body>
</html>
