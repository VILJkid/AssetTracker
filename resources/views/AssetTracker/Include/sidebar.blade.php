{{-- Sidebar for navigating through pages and keeping track of where we currently are. --}}

<!-- Main Sidebar Container -->
@php
$sid = session('sid');
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="Asset Tracker Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Asset Tracker</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        {{-- Username will be shown here. --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $sid }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                {{-- Link to dashboard. --}}
                <li class="nav-item {{ request()->is('dashboard*') ? 'active menu-open' : '' }}">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <span class="badge badge-info right">2</span> --}}
                        </p>
                    </a>
                </li>

                <li
                    class="nav-item {{ request()->is('createat*') || request()->is('showat*') || request()->is('createa*') || request()->is('showa*') ? 'active menu-open' : '' }}">

                    {{-- Asset Management Indicator. --}}
                    <a href="#"
                        class="nav-link {{ request()->is('createat*') || request()->is('showat*') || request()->is('createa*') || request()->is('showa*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Asset Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li
                            class="nav-item {{ request()->is('createat*') || request()->is('showat*') ? 'menu-open' : '' }}">

                            {{-- Manage Asset Type Indicator. --}}
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fab fa-microsoft"></i>
                                <p>
                                    Manage Asset Types
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->is('showat*') ? 'active menu-open' : '' }}">

                                    {{-- Link to Show Asset Type. --}}
                                    <a href="/showat" class="nav-link {{ request()->is('showat*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Show Asset Types</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('createat*') ? 'active menu-open' : '' }}">

                                    {{-- Link to Create Asset Type. --}}
                                    <a href="/createat"
                                        class="nav-link {{ request()->is('createat*') ? 'active' : '' }}">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Create Asset Types</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item {{ request()->is('createasset*') || request()->is('showasset*') ? 'menu-open' : '' }}">

                            {{-- Manage Asset Indicator. --}}
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-desktop"></i>
                                <p>
                                    Manage Assets
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->is('showasset*') ? 'active menu-open' : '' }}">

                                    {{-- Link to Show Asset. --}}
                                    <a href="/showasset"
                                        class="nav-link {{ request()->is('showasset*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Show Assets</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('createasset*') ? 'active menu-open' : '' }}">

                                    {{-- Link to Create Asset. --}}
                                    <a href="/createasset"
                                        class="nav-link {{ request()->is('createasset*') ? 'active' : '' }}">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Create Assets</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    {{-- <hr style="color: white;"> --}}

                    {{-- Link to logout. --}}
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-logout">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


{{-- Modal for logout confirmation. --}}
<div class="modal fade" id="modal-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure ? You'll be logged out of the session and unsaved changes will be deleted too!</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-success btn-light" data-dismiss="modal">Close</button>
                <a href="/logout" class="btn btn-outline-dark btn-light">Logout</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
