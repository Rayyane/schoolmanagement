<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin')}}/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin')}}/img/favicon-final.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Grace International School</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('admin')}}/css/bootstrap.min.css" rel="stylesheet"/>


    <!-- for jQuery     -->
    <script src="{{asset('admin')}}/js/jquery.min.js" type="text/javascript"></script>

    <!-- Animation library for notifications   -->
    <link href="{{asset('admin')}}/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('admin')}}/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('admin')}}/css/themify-icons.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/sl-1.2.6/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <!--  Multiple select     -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/');?>/js/jsUtlt.js"></script>
        <script>
        jsUtlt["siteUrl"] = function(addr){
        addr = typeof addr != "undefined" ? addr : "";
        return "<?php echo url('/');?>"+addr;
        };
        </script>
</head>

<body>
    <div id="app">
    {{--  <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
         <div class="container">
             <a class="navbar-brand" href="{{ url('/') }}">
                 {{ config('app.name', 'Laravel') }}
             </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                 <span class="navbar-toggler-icon"></span>
             </button>

             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <!-- Left Side Of Navbar -->
                 <ul class="navbar-nav mr-auto">

                 </ul>

                 <!-- Right Side Of Navbar -->
                 <ul class="navbar-nav ml-auto">
                     <!-- Authentication Links -->
                     @guest
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                         </li>
                         <li class="nav-item">
                             @if (Route::has('register'))
                                 <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                             @endif
                         </li>
                     @else

                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/areas/create')}}">{{ __('Add New Area') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/areas')}}">{{ __('View all Areas') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/branches/create')}}">{{ __('Add New Branch') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/branches')}}">{{ __('View all Branches') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/shifts/create')}}">{{ __('Add New Shift') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/shifts')}}">{{ __('View all Shifts') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/sessions/create')}}">{{ __('Add New Session') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/sessions')}}">{{ __('View all Sessions') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/teachers/create')}}">{{ __('Add New Teacher') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/teachers')}}">{{ __('View all Teachers') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/levels/create')}}">{{ __('Add New Class') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/levels')}}">{{ __('View all Classes') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/sections')}}">{{ __('View all Sections') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/sections/create')}}">{{ __('Add new Section') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/students/create')}}">{{ __('Add new Student') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/students')}}">{{ __('View All Students') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/accounts/create')}}">{{ __('Add New Area') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{url('/accounts')}}">{{ __('View all Areas') }}</a>
                         </li>
                         <li class="nav-item dropdown">
                             <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 {{ Auth::user()->name }} <span class="caret"></span>
                             </a>

                             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                 </form>
                             </div>
                         </li>
                     @endguest
                 </ul>
             </div>
         </div>
     </nav> --}}
     <div class="wrapper">
        <div class="sidebar" data-background-color="white" data-active-color="info">

            <!--
                Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
                Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
            -->

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{ route('login') }}"><img src="{{asset('admin')}}/img/favicon.jpg" style="width:160px;height:100px;padding-left: 35px" alt="">
                    </a>
                </div>

                <ul class="nav">
                    <li class="{{ Request::is('home') ? 'active' : '' }}">

                        <a href="{{url('/home')}}">
                            <i class="ti-panel"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="user.html">
                            <i class="ti-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li> -->
                    <li class="{{ Request::is('areas*') ? 'active' : '' }}">
                        <a href="{{url('/areas')}}">
                            <i class="ti-map"></i>
                            <p>Areas</p>
                        </a>
                    </li>
                    <li class="{{ Request::is('branches*') ? 'active' : '' }}">
                        <a href="{{url('/branches')}}">
                            <i class="ti-direction-alt"></i>
                            <p>Branches</p>
                        </a>
                    </li>
                    <li class="{{ Request::is('sessions*') ? 'active' : '' }}">
                        <a href="{{url('/sessions')}}">
                            <i class="ti-control-forward"></i>
                            <p>Sessions</p>
                        </a>
                    </li>
                    <li class="{{ Request::is('terms*') ? 'active' : '' }}">
                        <a href="{{url('/terms')}}">
                            <i class="ti-tumblr"></i>
                            <p>Terms</p>
                        </a>
                    </li>
                    <li class="{{ Request::is('shifts*') ? 'active' : '' }}">
                        <a href="{{url('/shifts')}}">
                            <i class="ti-control-shuffle"></i>
                            <p>Shifts</p>
                        </a>
                    </li>
                    
                    <li class="{{ Request::is('teachers*') ? 'active' : '' }}">
                        <a href="{{url('/teachers')}}">
                            <i class="ti-user"></i>
                            <p>Teachers</p>
                        </a>
                    </li>

                    <li class="{{ Request::is('levels*') ? 'active' : '' }}">
                        <a href="{{url('/levels')}}">
                            <i class="ti-view-list"></i>
                            <p>Classes</p>
                        </a>
                    </li>

                    <li class="{{ Request::is('section*') ? 'active' : '' }}">
                        <a href="{{url('/sections')}}">
                            <i class="ti-view-list-alt"></i>
                            <p>Sections</p>
                        </a>
                    </li>

                    <li class="{{ Request::is('students*') ? 'active' : '' }}">
                        <a href="{{url('/students')}}">
                            <i class="ti-pencil-alt2"></i>
                            <p>Students</p>
                        </a>
                    </li>

                    <li class="{{ Request::is('subjects*') ? 'active' : '' }}">
                        <a href="{{url('/subjects')}}">
                            <i class="ti-pencil-alt"></i>
                            <p>Subjects</p>
                        </a>
                    </li>

                    <li class="{{ Request::is('weekly*') ? 'active' : '' }}">
                        <a href="{{url('/weeklytests')}}">
                            <i class="ti-medall"></i>
                            <p>Weekly Test</p>
                        </a>
                    </li>
                    <li class="{{ Request::is('final_report*') ? 'active' : '' }}">
                        <a href="{{url('/final_reports')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                    <li class="{{ Request::is('accounts*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#accountsSection"  class="collapsed">
                            <i class="ti-map"></i>
                            <p>Account</p> 
                        </a>
                        <div class="collapse" id="accountsSection" aria-expanded="false" style="height: 0px; background-color: #ffffcc;">
                            <ul class="nav">
                                <li class="{{ Request::is('fiscal_year*') ? 'active' : '' }}">
                                    <a href="{{url('/fiscal_years')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Fiscal Years</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('business_month*') ? 'active' : '' }}">
                                    <a href="{{url('/business_months')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Business Months</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('prefix*') ? 'active' : '' }}">
                                    <a href="{{url('/prefixes')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Prefix</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('fees_book*') ? 'active' : '' }}">
                                    <a href="{{url('/fees_books')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Fees Books</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('fees_type*') ? 'active' : '' }}">
                                    <a href="{{url('/fees_types')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Fees Types</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('section_wise_fees*') ? 'active' : '' }}">
                                    <a href="{{url('/section_wise_fees')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Section-wise Fees</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('payment_method*') ? 'active' : '' }}">
                                    <a href="{{url('/payment_methods')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Payment Methods</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('collected_fee*') ? 'active' : '' }}">
                                    <a href="{{url('/collected_fees')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Collected Fees</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('categor*') ? 'active' : '' }}">
                                    <a href="{{url('/categories')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('suppl*') ? 'active' : '' }}">
                                    <a href="{{url('/suppliers')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Suppliers</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('voucher*') ? 'active' : '' }}">
                                    <a href="{{url('/vouchers')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Vouchers</p>
                                    </a>
                                </li>

                                <li class="{{ Request::is('financial*') ? 'active' : '' }}">
                                    <a href="{{url('/financial_reports')}}">
                                        <i class="ti-control-play"></i>
                                        <p>Financial Report</p>
                                    </a>
                                </li>

                            </ul>
                        </div>

                    </li>
                    <!-- <li class="{{ Request::is('fiscal_year*') ? 'active' : '' }}">
                        <a href="{{url('/fiscal_years')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Fiscal Years</p>
                        </a>
                    </li> -->
                    <!-- <li class="{{ Request::is('business_month*') ? 'active' : '' }}">
                        <a href="{{url('/business_months')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Business Months</p>
                        </a>
                    </li> -->

                    <!-- <li class="{{ Request::is('fees_book*') ? 'active' : '' }}">
                        <a href="{{url('/fees_books')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Fees Books</p>
                        </a>
                    </li> -->

                    <!-- <li class="{{ Request::is('fees_type*') ? 'active' : '' }}">
                        <a href="{{url('/fees_types')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Fees Types</p>
                        </a>
                    </li> -->

                    <!-- <li class="{{ Request::is('section_wise_fees*') ? 'active' : '' }}">
                        <a href="{{url('/section_wise_fees')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Section-wise Fees</p>
                        </a>
                    </li> -->

                    <!-- <li class="{{ Request::is('payment_method*') ? 'active' : '' }}">
                        <a href="{{url('/payment_methods')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Payment Methods</p>
                        </a>
                    </li> -->

                    <!-- <li class="{{ Request::is('collected_fee*') ? 'active' : '' }}">
                        <a href="{{url('/collected_fees')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Collected Fees</p>
                        </a>
                    </li> -->

                    <!-- <li class="{{ Request::is('categor*') ? 'active' : '' }}">
                        <a href="{{url('/categories')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Categories</p>
                        </a>
                    </li> -->

                    <!-- <li class="{{ Request::is('suppl*') ? 'active' : '' }}">
                        <a href="{{url('/suppliers')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Suppliers</p>
                        </a>
                    </li> -->

                    <!-- <li class="{{ Request::is('voucher*') ? 'active' : '' }}">
                        <a href="{{url('/vouchers')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Vouchers</p>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>

        <div class="main-panel" style="background-color:#f4f3ef;">
            <nav class="navbar navbar-default" style="background-color:#f4f3ef;">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="#">@yield('heading')</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <!-- <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-panel"></i>
                                    <p>Stats</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
                                    <p>Notifications</p>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li> -->
                            <li>
                                <a href="{{ route('logout')}}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')

        @yield('login')
    </main>
</div>
</div>
</div>

@stack('scripts')

<script src="{{asset('admin')}}/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->

<!--  Charts Plugin -->
<script src="{{asset('admin')}}/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('admin')}}/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{asset('admin')}}/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->

<!-- datatable -->


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/sl-1.2.6/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/sl-1.2.6/datatables.min.js"></script>

</body>



</html>
