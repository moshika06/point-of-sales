<style>
    .dashboard-link,
    .dashboard-title-link,
    .user-link,
    .user-title-link,
    .role-link,
    .role-title-link,
    .product-link,
    .product-title-link,
    .category-link,
    .category-title-link {
        transition: all 0.2s ease;
    }

    /* Dashboard */
    body:has(.dashboard-link:hover) .dashboard-title-link {
        color: #0d6efd;
    }

    body:has(.dashboard-title-link:hover) .dashboard-link {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .dashboard-link:hover {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .dashboard-title-link:hover {
        color: #0d6efd;
    }

    /* User */
    body:has(.user-link:hover) .user-title-link {
        color: #0d6efd;
    }

    body:has(.user-title-link:hover) .user-link {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .user-link:hover {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .user-title-link:hover {
        color: #0d6efd;
    }

    /* Role */
    body:has(.role-link:hover) .role-title-link {
        color: #0d6efd;
    }

    body:has(.role-title-link:hover) .role-link {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .role-link:hover {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .role-title-link:hover {
        color: #0d6efd;
    }

    /* Product */
    body:has(.product-link:hover) .product-title-link {
        color: #0d6efd;
    }

    body:has(.product-title-link:hover) .product-link {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .product-link:hover {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .product-title-link:hover {
        color: #0d6efd;
    }

    /* Category */
    body:has(.category-link:hover) .category-title-link {
        color: #0d6efd;
    }

    body:has(.category-title-link:hover) .category-link {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .category-link:hover {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .category-title-link:hover {
        color: #0d6efd;
    }
</style>
<div class="sidebar-wrapper" id="sidebar">
    <a href="{{ '/admin/dashboard' }}" class="sidebar-brand">
        <i class="bi bi-asterisk"></i>
        <span>Admin</span>
    </a>
    <div class="flex-grow-1 overflow-y-auto">
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Menu</div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard.index') }}" class="sidebar-menu-link dashboard-link" title="Dashboard">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('users.index') }}" class="sidebar-menu-link user-link" title="User">
                        <i class="bi bi-person"></i>
                        <span>User</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('roles.index') }}" class="sidebar-menu-link role-link" title="Role">
                        <i class="bi bi-person-gear"></i>
                        <span>Role</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('products.index') }}" class="sidebar-menu-link product-link" title="Product">
                        <i class="bi bi-bag"></i>
                        <span>Product</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('categories.index') }}" class="sidebar-menu-link category-link" title="Category">
                        <i class="bi bi-input-cursor-text"></i>
                        <span>Category</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-profile">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
            <div class="sidebar-profile-email">{{ auth()->user()->email ?? '-' }}</div>
        </div>
    </div>
</div>
