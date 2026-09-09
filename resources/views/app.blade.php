<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Point Of Sales')</title>

    <!-- SEO Optimization -->
    <meta name="description" content="@yield('description', 'Point Of Sales System')">
    <meta name="author" content="Point Of Sales">

    @include('inc.css')

</head>

<body>
    @include('inc.sidebar')

    <div class="main-wrapper">

        @include('inc.nav')

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">@yield('title', 'Point Of Sales')</h1>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/admin/dashboard') }}" class="text-decoration-none text-muted-green">
                            Home
                        </a>
                    </li>
  
                    <li class="breadcrumb-item active text-main" aria-current="page">
                        @yield('breadcrumb', 'Dashboard')
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Content -->
        @yield('content')

        @include('inc.footer')

    </div>

    @include('inc.js')

</body>

</html>
