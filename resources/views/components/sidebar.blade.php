   <!-- ======= Sidebar ======= -->
   <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @php
            $userRole = auth()->user()->role;
        @endphp

        @if ($userRole === 'admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? '' : 'collapsed' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.product.*') ? '' : 'collapsed' }}" href="{{ route('admin.product.index') }}">
                    <i class="bi bi-box-seam"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.purchase.*') ? '' : 'collapsed' }}" href="{{ route('admin.purchase.index') }}">
                    <i class="bi bi-cart"></i>
                    <span>Penjualan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.user.*') ? '' : 'collapsed' }}" href="{{ route('admin.user.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Pengguna
                        
                    </span>
                </a>
            </li>
        @endif

        @if ($userRole === 'petugas')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? '' : 'collapsed' }}" href="{{ route('petugas.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.product.*') ? '' : 'collapsed' }}" href="{{ route('petugas.product.index') }}">
                    <i class="bi bi-box-seam"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.purchase.*') ? '' : 'collapsed' }}" href="{{route('petugas.purchase.index')}}">
                    <i class="bi bi-cart"></i>
                    <span>Penjualan</span>
                </a>
            </li>
        @endif
    </ul>
</aside>