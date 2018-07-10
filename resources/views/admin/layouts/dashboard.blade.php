@extends('admin.layouts.app')

@section('body')
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('/') }}">{{ config('app.name', 'Administracion') }}</a>
            </div>
            <!-- /.navbar-header -->


            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">


                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        {{--<li {{ (Request::is('/') ? 'class="active"' : '') }}>--}}
                        {{--<a href="{{ url ('admin') }}"><i class="fa fa-dashboard fa-fw"></i> Inventario</a>--}}
                        {{--</li>--}}

                        <li>
                            <a href="#">
                                <i class="fa fa-inventory fa-fw"></i> Inventario<span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href=" {{ route('material.index') }} ">Materiales</a>
                                </li>
                                <li>
                                    <a href="{{ route('stock.index') }}">Bodega</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                Administracion <span class="caret"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href=" {{ route('contratos.index') }} ">Contratos</a>
                                </li>

                                <li>
                                    <a href="{{ route('order.index')  }}">Facturas</a>
                                </li>

                                <li>
                                    <a href="{{ route('proyecciones.index')  }}">Proyecciones</a>
                                </li>

                                <li>
                                    <a href="{{ route('productos.index')  }}">Productos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row" id="mainAjax">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                @yield('section')
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
