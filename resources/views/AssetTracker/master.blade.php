{{-- Master template for all the views. --}}

<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Include CSS files. --}}
    @include('AssetTracker.Include.head')

    {{-- Title of the document. --}}
    @yield('title')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{-- Navigation bar. --}}
        @include('AssetTracker.Include.nav')

        {{-- Sidebar. --}}
        @include('AssetTracker.Include.sidebar')

        {{-- Cat welcomes the user. --}}
        @yield('cat')
        <div class="content-wrapper">

            {{-- Header, consisting of a heading and breadcrumb. --}}
            @yield('header')

            {{-- The main content. --}}
            @yield('main')
        </div>

        {{-- The footer part of the page. --}}
        @include('AssetTracker.Include.footer')

        {{-- Experimental feature for Dark Mode. You can ignore this. --}}
        @include('AssetTracker.Include.control-sidebar')
    </div>
    {{-- All JS/jQuery scripts goes here. --}}
    @include('AssetTracker.Include.foot')

    {{-- Scripts related to the specific page goes here. --}}
    @yield('extrajs')
</body>

</html>
