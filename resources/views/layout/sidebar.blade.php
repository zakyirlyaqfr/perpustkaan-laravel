<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if(auth()->check() && auth()->user()->id_jenis_user == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboardadmin') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard Admin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.adduser') }}">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Add User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.addrole') }}">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Add Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menu.index') }}">
                    <i class="icon-contract menu-icon"></i>
                    <span class="menu-title">Add Menu</span>
                </a>
            </li>
        @elseif(auth()->check() && auth()->user()->id_jenis_user == 3)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard Dosen</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dosen.addbook') }}">
                    <i class="icon-book menu-icon"></i>
                    <span class="menu-title">Add Book</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dosen.addkategori') }}">
                    <i class="icon-tag menu-icon"></i>
                    <span class="menu-title">Add Kategori</span>
                </a>
            </li>
        @elseif(auth()->check() && auth()->user()->id_jenis_user == 2)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mhs.addpinjaman') }}">
                    <i class="icon-book menu-icon"></i>
                    <span class="menu-title">Add Pinjaman</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mhs.pengembalian') }}">
                    <i class="icon-reload menu-icon"></i>
                    <span class="menu-title">Pengembalian Buku</span>
                </a>
            </li>
        @else
            @foreach($menususer as $menu)
            <li class="nav-item">
                <a class="nav-link" href="{{ $menu->menu_link ?? '#' }}">
                    <!-- Menu Icon -->
                    <i class="{{ $menu->menu_icon }} menu-icon"></i>
                    <span class="menu-title">{{ $menu->menu_name }}</span>

                    <!-- Menu Arrow for Dropdowns -->
                    @if($submenus->where('parent_id', $menu->menu_id)->count() > 0)
                        <i class="menu-arrow"></i>
                    @endif
                </a>

                <!-- Submenu Section -->
                @if($submenus->where('parent_id', $menu->menu_id)->isNotEmpty())
                    <div class="collapse show" id="menu-{{ $menu->menu_id }}">
                        <ul class="nav flex-column sub-menu">
                            @foreach($submenus->where('parent_id', $menu->menu_id) as $submenu)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $submenu->menu_link }}">
                                        {{ $submenu->menu_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
            @endforeach
        @endif
    </ul>
</nav>
