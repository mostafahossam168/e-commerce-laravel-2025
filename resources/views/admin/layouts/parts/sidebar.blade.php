<div class="sidebar">
    <div class="tog-active d-none d-lg-block" data-tog="true" data-active=".app">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="list">
        <li class="list-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}">
                <div>
                    <i class="fa-solid fa-grip"></i>
                    الرئيسية
                </div>
            </a>
        </li>
        @can('read_categories')
            <li class="list-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-list"></i>
                        الاقسام
                    </div>
                </a>
            </li>
        @endcan
        @can('read_products')
            <li class="list-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-boxes-stacked"></i>
                        المنتجات
                    </div>
                </a>
            </li>
        @endcan

        <li class="list-item ">
            <a data-bs-toggle="collapse" href="#users"
                aria-expanded="{{ request()->routeIs('admin.users.*') || request()->routeIs('admin.admins.*') || request()->routeIs('admin.roles.*') ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-users"></i>
                    المستخدمين
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="users"
            class="collapse item-collapse {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.admins.*') || request()->routeIs('admin.roles.*') ? 'show' : '' }} ">
            @can('read_users')
                <li class="list-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="">
                        <div>
                            <i class="fa-solid fa-users"></i>
                            العملاء
                        </div>
                    </a>
                </li>
            @endcan
            @can('read_admins')
                <li class="list-item {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.admins.index') }}" class="">
                        <div>
                            <i class="fa-solid fa-user-tie"></i>
                            المشرفين
                        </div>
                    </a>
                </li>
            @endcan

            @can('read_roles')
                <li class="list-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.roles.index') }}" class="">
                        <div>
                            <i class="fa-solid fa-shield-halved"></i>
                            الصلاحيات
                        </div>
                    </a>
                </li>
            @endcan
        </div>

        @can('read_orders')
            <li class="list-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <a href="{{ route('admin.orders.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-shop"></i>
                        الطلبات
                        <div class="main-badge">{{ \App\Models\Order::count() }}</div>
                    </div>
                </a>
            </li>
        @endcan

        @can('read_contact-us')
            <li class="list-item {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                <a href="{{ route('admin.contacts') }}" class="">
                    <div>
                        <i class="fa-solid fa-handshake-angle"></i>
                        تواصل معنا
                        <div class="main-badge">{{ \App\Models\ContactUs::count() }}</div>

                    </div>
                </a>
            </li>
        @endcan
        @can('read_settings')
            <li class="list-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.show') }}" class="">
                    <div>
                        <i class="fa-solid fa-gear icon"></i>
                        الاعدادات
                    </div>
                </a>
            </li>
        @endcan
    </ul>
</div>
