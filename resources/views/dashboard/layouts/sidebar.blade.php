<div class="sidebar px-4 py-4 py-md-5 me-0">
    <div class="d-flex flex-column h-100">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="mb-0 brand-icon">
            <span class="logo-icon">
                <img src="{{ asset('images/logo.png') }}" style="width: 280px; margin-top: -52px; margin-left: -35px;">
            </span>
            <span class="logo-text">ECDS</span>
        </a>
        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
            <li class>
                <small class="text-muted mt-2 mb-2 m-1">Dashboard</small>
            </li>
            <li>
                <a class="m-link @yield('home_active')" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <div>
                        <h6 class="mb-0">Home</h6>
                    </div>
                </a>
            </li>

            @canany(['Manage categories', 'Create categories', 'Read categories', 'Update categories', 'Delete categories', 'Print categories'])
                <li>
                    <a class="m-link @yield('category_active')" href="{{ route('categories') }}">
                        <i class="fas fa-tasks"></i>
                        <div>
                            <h6 class="mb-0">Case Categories</h6>
                        </div>
                    </a>
                </li>
            @endcan

            {{--            @canany(['Manage bail', 'Create bail', 'Read bail', 'Update bail', 'Delete bail', 'Print bail',  'Track bail'])--}}
            <li class="collapsed">
                <a class="m-link @yield('cases_active')" data-bs-toggle="collapse" data-bs-target="#menu-Components" href="#">
                    <i class="fas fa-folder-open"></i>
                    <div>
                        <h6 class="mb-0">Cases</h6>
                    </div><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
                </a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse @yield('asset_collapse')" id="menu-Components">

                    <li><a class="ms-link @yield('list_assets_active')" href="{{ route('assets') }}"><span>Case list</span> </a></li>

                    {{--                    @can('Create bail')--}}
                    <li><a class="ms-link @yield('create_asset_active')" href="{{ route('assets.create') }}"><span>New case</span></a></li>
                    {{--                    @endcan--}}
                </ul>
            </li>
            {{--            @endcanany--}}
            <li>
                <a class="m-link @yield('reset_case_active')" href="{{ route('categories') }}">
                    <i class="fas fa-list-alt"></i>
                    <div>
                        <h6 class="mb-0">Reset case counts</h6>
                    </div>
                </a>
            </li>
            <li>
                <a class="m-link @yield('dispose_case_active')" href="{{ route('categories') }}">
                    <i class="fas fa-list-alt"></i>
                    <div>
                        <h6 class="mb-0">Dispose cases</h6>
                    </div>
                </a>
            </li>

            @canany(['Read reports', 'Filter reports', 'Export reports', 'Print reports'])
                <li class>
                    <small class="text-muted m-1">Reports</small>
                </li>

                <li class="collapsed">
                    <a class="m-link @yield('cases_active')" data-bs-toggle="collapse" data-bs-target="#general-report" href="#">
                        <i class="fas fa-folder-open"></i>
                        <div>
                            <h6 class="mb-0">General Reporting</h6>
                        </div><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
                    </a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse @yield('asset_collapse')" id="general-report">
                        <li>
                            <a class="m-link @yield('reports_active')" href="{{ route('reports') }}">
                                <i class="fas fa-chart-pie"></i>
                                <div>
                                    <h6 class="mb-0">Case counts</h6>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="m-link @yield('reports_active')" href="{{ route('reports') }}">
                                <i class="fas fa-line-chart"></i>
                                <div>
                                    <h6 class="mb-0">Case summary</h6>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="m-link @yield('case_distribution_active')" href="{{ route('reports') }}">
                                <i class="fas fa-area-chart"></i>
                                <div>
                                    <h6 class="mb-0">Case distributions</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcanany



            @canany(['manage_system', 'general_admin'])
                <li class>
                    <small class="text-muted m-1">Others</small>
                </li>

                <li>
                    <a class="m-link @yield('setting_active') menu-toggle-option" href="#!">
                        <i class="fas fa-cog"></i>
                        <div>
                            <h6 class="mb-0">Settings</h6>
                        </div>
                    </a>
                </li>
            @endcan
        </ul>
        <!-- Menu: menu collapse btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-muted">
            <span><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>
