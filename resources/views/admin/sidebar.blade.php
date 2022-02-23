<style>
    .brand-link .brand-image {
        
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
    <img src="/template/images/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">オークション</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    @include('admin.info')
    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        ホームページ
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/auctions" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                    オークション管理
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listAuctions') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>オークション一覧</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listAuctionsIsWait') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>オークション評価</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('listUser') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        ユーザー管理
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/categories" class="nav-link">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>
                        商品管理
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listCategories') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>カテゴリー一覧</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listItems') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>商品一覧</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listBrands') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ブランド一覧</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/series/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>シリーズ一覧</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="admin/news/list" class="nav-link">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        ニュスー管理
                    </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
