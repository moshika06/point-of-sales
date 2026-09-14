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
                      <a href="{{ route('dashboard.index') }}" class="sidebar-menu-link" title="Dashboard">
                          <i class="bi bi-grid-fill"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sidebar-menu-item">
                      <a href="{{ route('users.index') }}" class="sidebar-menu-link" title="User">
                          <i class="bi bi-person"></i>
                          <span>User</span>
                      </a>
                  </li>
                  <li class="sidebar-menu-item">
                      <a href="{{ route('roles.index') }}" class="sidebar-menu-link" title="Role">
                          <i class="bi bi-person-gear"></i>
                          <span>Role</span>
                      </a>
                  </li>
                  <li class="sidebar-menu-item">
                      <a href="{{ route('products.index') }}" class="sidebar-menu-link" title="Product">
                          <i class="bi bi-bag"></i>
                          <span>Product</span>
                      </a>
                  </li>
                  <li class="sidebar-menu-item">
                      <a href="{{ route('categories.index') }}" class="sidebar-menu-link" title="Category">
                          <i class="bi bi-input-cursor-text"></i>
                          <span>Category</span>
                      </a>
                  </li>
              </ul>
          </div>
          <div class="sidebar-menu-section">
              <div class="sidebar-menu-title">Components</div>
              <ul class="sidebar-menu-list">
                  <li class="sidebar-menu-item">
                      <a href="tables-basic.html" class="sidebar-menu-link" id="menu-basictables" title="Basic Tables">
                          <i class="bi bi-table"></i>
                          <span>Basic Tables</span>
                      </a>
                  </li>
                  <li class="sidebar-menu-item">
                      <a href="ui-buttons.html" class="sidebar-menu-link" id="menu-uibuttons" title="Buttons">
                          <i class="bi bi-menu-button-wide-fill"></i>
                          <span>Buttons & Alerts</span>
                      </a>
                  </li>
              </ul>
          </div>
          <div class="sidebar-menu-section">
              <div class="sidebar-menu-title">Pages</div>
              <ul class="sidebar-menu-list">
                  <li class="sidebar-menu-item">
                      <a href="page-blank.html" class="sidebar-menu-link" id="menu-blankpage" title="Blank Page">
                          <i class="bi bi-file-earmark"></i>
                          <span>Blank Page</span>
                      </a>
                  </li>
                  <li class="sidebar-menu-item">
                      <a href="page-404.html" class="sidebar-menu-link" id="menu-404" title="404 Page">
                          <i class="bi bi-slash-circle"></i>
                          <span>Error 404</span>
                      </a>
                  </li>
              </ul>
          </div>
      </div>
      <div class="sidebar-profile">
          <img src="assets/images/avatar.png" alt="Administrator" class="sidebar-profile-img"
              onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
          <div class="sidebar-profile-info">
              <div class="sidebar-profile-name">Administrator</div>
              <div class="sidebar-profile-email">admin@email.com</div>
          </div>
      </div>
  </div>
