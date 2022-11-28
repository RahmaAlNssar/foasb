<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">

        <span class="brand-text font-weight-light"> لوحة التحكم</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->username }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            لوحة التحكم

                        </p>
                    </a>

                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.admins.index') }}" class="nav-link {{ request()->segment(2) === 'admins' ? 'active' : '' }}"">
                        <i class="nav-icon fas fa-users"></i>
                        <p>

                            المدراء
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->segment(2) === 'categories' ? 'active' : '' }}"">
                        <i class="nav-icon fas fa-list"></i>
                        <p>

                            الأقسام الرئيسيه
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.subcats.index') }}" class="nav-link {{ request()->segment(2) === 'subcats' ? 'active' : '' }}"">
                        <i class="nav-icon fas fa-list"></i>
                        <p>

                            الأقسام الفرعية
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->segment(2) === 'posts' ? 'active' : '' }}"">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p>

                             البوستات
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->segment(2) === 'orders' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-order"></i>
                        <p>

                             الطلبات
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->segment(2) === 'messages' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>

                             الرسائل
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
