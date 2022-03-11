<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin') }}" class="brand-link">
    <img src="/template/images/logo.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">オークション</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    @include('admin.info')
    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-gavel"></i>
                    <p>
                    オークション管理
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listAuctions') }}" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>オークション一覧</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listAuctionsIsWait') }}" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
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
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>
                        商品管理
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listCategories') }}" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>カテゴリー一覧</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listItems') }}" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>商品一覧</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listBrands') }}" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>ブランド一覧</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('listNews') }}" class="nav-link">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        ニュスー管理
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('listSliders') }}" class="nav-link">
                    <i class="nav-icon fas fa-sliders-h"></i>
                    <p>
                        スライダー管理
                    </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
