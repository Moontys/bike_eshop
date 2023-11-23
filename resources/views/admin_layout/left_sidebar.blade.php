<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ url('/shop') }}" class="d-block">Mantas Stirpeika</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <div class="user-panel mt-3 pb-3 mb-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="{{url('/admin')}}" class="nav-link {{request()->is('admin') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                DASHBOARD
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{request()->is('all-categories') ? 'menu-open' : ''}} {{request()->is('add-category') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link {{request()->is('all-categories') ? 'active' : ''}} {{request()->is('add-category') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                CATEGORIES
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/all-categories')}}" class="nav-link  {{request()->is('all-categories') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>All Categories</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/add-category')}}" class="nav-link {{request()->is('add-category') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>Add Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{request()->is('all-sliders') ? 'menu-open' : ''}} {{request()->is('add-slider') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link {{request()->is('all-sliders') ? 'active' : ''}} {{request()->is('add-slider') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                SLIDERS
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/all-sliders')}}" class="nav-link {{request()->is('all-sliders') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>All Sliders</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/add-slider')}}" class="nav-link {{request()->is('add-slider') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>Add Slider</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{request()->is('all-products') ? 'menu-open' : ''}} {{request()->is('add-product') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link {{request()->is('all-products') ? 'active' : ''}} {{request()->is('add-product') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                PRODUCTS
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/all-products')}}" class="nav-link {{request()->is('all-products') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>All Products</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/add-product') }}" class="nav-link {{request()->is('add-product') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>Add Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{request()->is('all-orders') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link {{request()->is('all-orders') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                ORDERS
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/all-orders')}}" class="nav-link {{request()->is('all-orders') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>All Orders</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <nav class="mt-2">
            <div class="user-panel mt-3 pb-3 mb-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview {{request()->is('') ? 'menu-open' : ''}} {{request()->is('add-product') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link {{request()->is('') ? 'active' : ''}} {{request()->is('add-product') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                DISCOUNTS
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/all-discounts') }}" class="nav-link {{request()->is('all-products') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>All Discounts</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('')}}" class="nav-link {{request()->is('add-product') ? 'active' : ''}}">
                                    <i class="far fa-file nav-icon"></i>
                                    <p>Add Discount</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

    </div>
</aside>
