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

        <div class="page-header">
            <div>
                @if (request()->routeIs('dashboard.index'))
                    <h1 class="page-title">
                        <a href="{{ route('dashboard.index') }}" class="dashboard-title-link">
                            @yield('title', 'Point Of Sales')
                        </a>
                    </h1>
                @elseif (request()->routeIs('users.index'))
                    <h1 class="page-title">
                        <a href="{{ route('users.index') }}" class="user-title-link">
                            @yield('title', 'User')
                        </a>
                    </h1>
                @elseif (request()->routeIs('roles.index'))
                    <h1 class="page-title">
                        <a href="{{ route('roles.index') }}" class="role-title-link">
                            @yield('title', 'Role')
                        </a>
                    </h1>
                @elseif (request()->routeIs('products.index'))
                    <h1 class="page-title">
                        <a href="{{ route('products.index') }}" class="product-title-link">
                            @yield('title', 'Product')
                        </a>
                    </h1>
                @elseif (request()->routeIs('categories.index'))
                    <h1 class="page-title">
                        <a href="{{ route('categories.index') }}" class="category-title-link">
                            @yield('title', 'Category')
                        </a>
                    </h1>
                @else
                    <h1 class="page-title">
                        @yield('title', 'Point Of Sales')
                    </h1>
                @endif
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/admin/dashboard') }}" class="text-decoration-none text-muted-green">Home</a>
                    </li>
                    <li class="breadcrumb-item active text-main" aria-current="page">
                        @yield('breadcrumb', 'Dashboard')
                    </li>
                </ol>
            </nav>
        </div>

        <!--Page Content-->
        @yield('content')

        @include('inc.footer')

    </div>

    @include('inc.js')

</body>

</html>
