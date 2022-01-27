{{-- Master template for only login page. --}}

<!DOCTYPE html>
<html lang="en">

<head>
    {{-- CSS files goes here. --}}
    @include('AssetTracker.Include.head')

    {{-- Title of the document. --}}
    @yield('title')
</head>

<body class="hold-transition login-page">
    {{-- Main content. --}}
    @yield('main')

    {{-- JS/jQuery scripts goes here. --}}
    @include('AssetTracker.Include.foot')
</body>

</html>
