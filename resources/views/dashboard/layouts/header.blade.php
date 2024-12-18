<div class="header">
    <nav class="navbar py-4">
        <div class="container-xxl">

            <!-- header rightbar icon -->
            <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">

                 <div class="dropdown notifications" hidden>
                    <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25px"
                            height="25px" viewBox="0 0 38 38">
                            <path
                                d="M36,34v-2h-2.98c-0.598-0.363-1.081-3.663-1.4-5.847c-0.588-4.075-1.415-9.798-4.146-13.723  C26.584,12.154,25.599,12,24.5,12c-3.646,0-5.576,1.657-7.106,4.086C15.089,19.746,14,30.126,14,33c0,2.757,2.243,5,5,5  c2.414,0,4.435-1.721,4.898-4H36z"
                                style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);">
                            </path>
                            <path class="st0"
                                d="M33.02,32c-0.598-0.363-1.081-3.663-1.4-5.847c-0.851-5.899-2.199-15.254-9.101-17.604  C23.433,7.643,24,6.386,24,5c0-2.757-2.243-5-5-5s-5,2.243-5,5c0,1.386,0.567,2.643,1.482,3.549  c-6.902,2.35-8.25,11.705-9.101,17.604C6.209,27.324,5.991,28.813,5.733,30h2.042c0.192-0.961,0.376-2.127,0.586-3.562  C9.36,19.501,10.73,10,19,10c8.27,0,9.64,9.501,10.641,16.442c0.386,2.636,0.682,4.394,1.108,5.558H2v2h12.101  c0.464,2.279,2.485,4,4.899,4c2.415,0,4.435-1.721,4.899-4H36v-2H33.02z M19,8c-1.654,0-3-1.346-3-3s1.346-3,3-3s3,1.346,3,3  S20.654,8,19,8z M19,36c-1.304,0-2.416-0.836-2.829-2h5.658C21.416,35.164,20.304,36,19,36z">
                            </path>
                        </svg>
                        <span class="pulse-ring"></span>
                    </a>
                    <div id="NotificationsDiv"
                        class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0">
                        <div class="card border-0 w380">
                            <div class="card-header border-0 p-3">
                                <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                    <span>Notifications</span>
                                    <span class="badge text-white">06</span>
                                </h5>
                            </div>
                            <div class="tab-content card-body">
                                <div class="tab-pane fade show active">
                                    <ul class="list-unstyled list mb-0">
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle"
                                                    src="{{ asset('/images/avatar.png') }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span
                                                            class="font-weight-bold">Chloe Walkerr</span>
                                                        <small>2MIN</small>
                                                    </p>
                                                    <span class="">Added New Task 2021-07-15 <span
                                                            class="badge bg-success">Add</span></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <div class="avatar rounded-circle no-thumbnail">AH</div>
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span
                                                            class="font-weight-bold">Alan Hill</span>
                                                        <small>13MIN</small>
                                                    </p>
                                                    <span class="">Invoice generator </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a class="card-footer text-center border-top-0" href="#"> View all
                                notifications</a>
                        </div>
                    </div>
                </div>



                <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center">
                    <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown"
                       data-bs-display="static">
                        <img class="avatar lg rounded-circle img-thumbnail" src="{{ asset('images/profile.png') }}"
                             alt="profile">
                    </a>
                    <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                        <div class="card border-0 w280">
                            <div class="card-body pb-0">
                                <div class="d-flex py-1">
                                    <img class="avatar rounded-circle" src="{{ asset('images/profile.png') }}"
                                         alt="profile">
                                    <div class="flex-fill ms-3">
                                        <p class="mb-0"><span
                                                class="font-weight-bold">{{ Auth::user()->full_name }}</span>
                                        </p>
                                        <small class="">{{ Auth::user()->email }}</small>
                                    </div>
                                </div>

                                <div>
                                    <hr class="dropdown-divider border-dark">
                                </div>
                            </div>
                            <div class="list-group m-2 ">
                                <a href="{{ route('profile.edit') }}"
                                   class="list-group-item list-group-item-action border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px"
                                         height="24px" viewBox="0 0 38 38" class="me-3">
                                        <path xmlns="http://www.w3.org/2000/svg"
                                              d="M36.15,38H1.85l0.16-1.14c0.92-6.471,3.33-7.46,6.65-8.83c0.43-0.17,0.87-0.36,1.34-0.561  c0.19-0.08,0.38-0.17,0.58-0.26c1.32-0.61,2.14-1.05,2.64-1.45c0.18,0.48,0.47,1.13,0.93,1.78C15.03,28.78,16.53,30,19,30  c2.47,0,3.97-1.22,4.85-2.46c0.46-0.65,0.75-1.3,0.931-1.78c0.5,0.4,1.319,0.84,2.64,1.45c0.2,0.09,0.39,0.17,0.58,0.26  c0.47,0.2,0.91,0.391,1.34,0.561c3.32,1.37,5.73,2.359,6.65,8.83L36.15,38z M20,13v4h-2v-4H20z"
                                              style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);">
                                        </path>
                                        <path xmlns="http://www.w3.org/2000/svg" class="st0"
                                              d="M21.67,17.34C21.22,18.27,20.29,19,19,19s-2.22-0.73-2.67-1.66l-1.79,0.891C15.31,19.78,16.88,21,19,21  s3.69-1.22,4.46-2.77L21.67,17.34z M15,10.85c-0.61,0-1.1,0.38-1.1,1.65s0.49,1.65,1.1,1.65s1.1-0.38,1.1-1.65S15.61,10.85,15,10.85  z M23,10.85c-0.61,0-1.1,0.38-1.1,1.65s0.489,1.65,1.1,1.65s1.1-0.38,1.1-1.65S23.61,10.85,23,10.85z M35.99,36.86  c-0.92-6.471-3.33-7.46-6.65-8.83c-0.43-0.17-0.87-0.36-1.34-0.561c-0.19-0.09-0.38-0.17-0.58-0.26c-1.32-0.61-2.14-1.05-2.64-1.45  c-0.521-0.42-0.7-0.8-0.761-1.29C26.55,22.74,28,19.8,28,17V4.56l-1.18,0.21C26.1,4.91,25.58,5,25.05,5  c-1.439,0-2.37-0.24-3.35-0.49C20.71,4.26,19.68,4,18.21,4c-1.54,0-2.94,0.69-3.83,1.9l1.61,1.18C16.5,6.39,17.31,6,18.21,6  c1.22,0,2.08,0.22,3,0.45C22.22,6.71,23.36,7,25.05,7c0.32,0,0.63-0.02,0.95-0.06V17c0,3.44-2.62,7-7,7s-7-3.56-7-7V6.29  C12.23,5.59,13.61,2,18.21,2c1.61,0,2.76,0.28,3.88,0.55C23.06,2.78,23.98,3,25.05,3C26.12,3,27.19,2.74,28,2.47V0.34  C27.34,0.61,26.17,1,25.05,1c-0.83,0-1.6-0.18-2.49-0.4C21.38,0.32,20.05,0,18.21,0c-5.24,0-7.64,3.86-8.18,5.89L10,17  c0,2.8,1.45,5.74,3.98,7.47c-0.06,0.49-0.24,0.87-0.76,1.29c-0.5,0.4-1.32,0.84-2.64,1.45c-0.2,0.09-0.39,0.18-0.58,0.26  c-0.47,0.2-0.91,0.391-1.34,0.561c-3.32,1.37-5.73,2.359-6.65,8.83L1.85,38h34.3L35.99,36.86z M4.18,36c0.81-4.3,2.28-4.9,5.24-6.12  c0.62-0.25,1.29-0.53,2-0.86c1.09-0.5,2.01-0.949,2.73-1.479c0.8-0.56,1.36-1.22,1.64-2.12C16.76,25.78,17.83,26,19,26  s2.24-0.22,3.21-0.58c0.28,0.9,0.84,1.561,1.64,2.12c0.721,0.53,1.641,0.979,2.73,1.479c0.71,0.33,1.38,0.61,2,0.86  c2.96,1.22,4.43,1.83,5.24,6.12H4.18z">
                                        </path>
                                    </svg>Profile Page
                                </a>

                                @can('Manage backups')
                                    <a href="{{ route('admin.backups') }}" class="list-group-item list-group-item-action border-0 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px"
                                             height="24px" viewBox="0 0 32 32" class="me-3">
                                            <path xmlns="http://www.w3.org/2000/svg"
                                                  d="M15.5,27.482C5.677,24.8,4.625,10.371,4.513,7.497C11.326,7.402,14.5,5.443,15.5,4.661  c0.999,0.782,4.174,2.742,10.986,2.836C26.375,10.371,25.323,24.8,15.5,27.482z"
                                                  style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);">
                                            </path>
                                            <path xmlns="http://www.w3.org/2000/svg" class="st2"
                                                  d="M14.13,21.5c-0.801,0-1.553-0.311-2.116-0.873c-0.57-0.57-0.883-1.327-0.881-2.132  c0.001-0.8,0.314-1.55,0.879-2.11c0.555-0.563,1.297-0.876,2.093-0.885c0.131-0.001,0.256-0.054,0.348-0.146l4.63-4.63  c0.388-0.38,0.879-0.583,1.416-0.583s1.028,0.203,1.42,0.587c0.373,0.373,0.58,0.875,0.58,1.413c0,0.531-0.207,1.03-0.584,1.406  l-4.64,4.641c-0.094,0.095-0.146,0.222-0.146,0.354c0,0.782-0.311,1.522-0.873,2.087C15.693,21.189,14.938,21.5,14.13,21.5z">
                                            </path>
                                            <path xmlns="http://www.w3.org/2000/svg" class="st0"
                                                  d="M15.5,4c0,0-2.875,3-11.5,3c0,0,0,18,11.5,21C27,25,27,7,27,7C18.375,7,15.5,4,15.5,4z M15.5,26.984  C6.567,24.43,5.217,11.608,5.015,7.965C11.052,7.797,14.213,6.15,15.5,5.251c1.287,0.899,4.448,2.545,10.484,2.713  C25.782,11.608,24.434,24.43,15.5,26.984z M22.27,10.37c-0.479-0.47-1.1-0.73-1.77-0.73s-1.29,0.261-1.77,0.73L14.1,15  c-0.92,0.01-1.79,0.37-2.44,1.03c-1.37,1.358-1.37,3.579,0,4.95c0.66,0.66,1.54,1.02,2.47,1.02c0.94,0,1.82-0.359,2.479-1.02  c0.66-0.66,1.021-1.53,1.021-2.44l4.64-4.64C22.74,13.43,23,12.81,23,12.14C23,11.47,22.74,10.84,22.27,10.37z M21.561,13.2  l-4.949,4.95c0.1,0.75-0.13,1.539-0.71,2.119C15.41,20.76,14.77,21,14.13,21c-0.64,0-1.28-0.24-1.76-0.73  c-0.98-0.979-0.98-2.56,0-3.539c0.49-0.489,1.12-0.729,1.76-0.729c0.12,0,0.24,0.01,0.36,0.03l4.949-4.95  c0.291-0.3,0.681-0.44,1.061-0.44s0.77,0.141,1.061,0.44C22.15,11.66,22.15,12.61,21.561,13.2z M19.79,12.14l0.71,0.7l-5.02,5.021  c0.27,0.56,0.18,1.238-0.29,1.699c-0.58,0.59-1.53,0.59-2.12,0c-0.58-0.58-0.58-1.529,0-2.119c0.47-0.461,1.16-0.562,1.71-0.291  L19.79,12.14z M16,11H9v-1h7V11z M14,13H9v-1h5V13z">
                                            </path>
                                        </svg>Backup Service
                                    </a>
                                @endcan

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="list-group-item list-group-item-action border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px"
                                         height="24px" viewBox="0 0 24 24" class="me-3">
                                        <rect xmlns="http://www.w3.org/2000/svg" class="st0" width="24"
                                              height="24" style="fill:none;;" fill="none"></rect>
                                        <path xmlns="http://www.w3.org/2000/svg"
                                              d="M20,4c0-1.104-0.896-2-2-2H6C4.896,2,4,2.896,4,4v16c0,1.104,0.896,2,2,2h12  c1.104,0,2-0.896,2-2V4z"
                                              style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);">
                                        </path>
                                        <path xmlns="http://www.w3.org/2000/svg" class="st0"
                                              d="M15,6.81v2.56c0.62,0.7,1,1.62,1,2.63c0,2.21-1.79,4-4,4s-4-1.79-4-4c0-1.01,0.38-1.93,1-2.63V6.81  C7.21,7.84,6,9.78,6,12c0,3.31,2.69,6,6,6c3.31,0,6-2.69,6-6C18,9.78,16.79,7.84,15,6.81z M13,6.09C12.68,6.03,12.34,6,12,6  s-0.68,0.03-1,0.09V12h2V6.09z">
                                        </path>
                                    </svg>Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- menu toggler -->
            <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainHeader">
                <span class="fa fa-bars"></span>
            </button>

            <!-- main menu Search-->
            <div class="order-0 col-lg-4 col-md-6 col-sm-12 col-12 mb-3 mb-md-0 d-flex align-items-center">
                @canany(['manage_system', 'general_admin'])
                    <a class="menu-toggle-option me-3 text-primary d-flex align-items-center" href="#"
                       title="Menu Option">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                             fill="var(--secondary-color)" class="bi bi-ui-checks-grid" viewBox="0 0 16 16">
                            <path style="fill:var(--secondary-color)"
                                  d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zm9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-3zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-3zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2z" />
                        </svg>
                    </a>
                @endcanany

                <div class="main-search px-3 flex-fill @canany(['manage_system', 'general_admin']) border-start  @endcanany">
                    Hi {{ auth()->user()->first_name }}, Welcome.
                </div>
            </div>

        </div>
    </nav>

    <!-- topmain menu -->
    <div class="container-xxl position-relative">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow menu slidedown position-absolute zindex-modal">
                    <div class="card-body p-3">
                        <div class="row g-3">
                            <div class="d-none d-lg-block d-flex col-lg-2 text-start">
                                <h6 class="px-2 mb-2 mt-5 text-center fw-bolder">{{ config('app.name') }}</h6>
                                <img src="{{ asset('images/logo.png') }}" alt="Asset Manager"
                                     class="img-fluid mt-2">
                            </div>
                            <div class="col-lg-10">
                                <ul
                                    class="menu-grid list-unstyled row row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-4 mb-0 mt-lg-3">

                                    @can('Manage cases')
                                        <li class="col">
                                            <a href="{{ route('cases') }}" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fas fa-folder-open"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Cases</p>
                                                    <small class="text-muted">Search/manage cases</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan


                                    @can('Manage court type')
                                        <li class="col">
                                            <a href="{{ route('courttypes.index') }}" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fas fa-landmark"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Court types</p>
                                                    <small class="text-muted">Manage court types
                                                    </small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('Manage categories')
                                        <li class="col">
                                            <a href="{{ route('categories') }}" class="d-flex color-700">
                                                <div class="avatar"><i class="fas fa-tasks"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Case categories</p>
                                                    <small class="text-muted">Manage case categories</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan


                                    @can('Manage locations')
                                        <li class="col">
                                            <a href="{{ route('locations') }}" class="d-flex color-700">
                                                <div class="avatar"><i class="fas fa-map-pin"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Locations</p>
                                                    <small class="text-muted">Manage court locations</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('Manage registries')
                                        <li class="col">
                                            <a href="{{ route('registries') }}" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fas fa-folder"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Registries</p>
                                                    <small class="text-muted">Manage Registries
                                                    </small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('Manage judges')
                                        <li class="col">
                                            <a href="{{ route('judges') }}" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fas fa-balance-scale"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Judges</p>
                                                    <small class="text-muted">Manage all judges</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('Manage courts')
                                        <li class="col">
                                            <a href="{{ route('courts') }}" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fas fa-balance-scale"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Courts</p>
                                                    <small class="text-muted">Manage all courts</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('Manage users')
                                        <li class="col">
                                            <a href="{{ route('admin.users') }}" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Users</p>
                                                    <small class="text-muted">Manage system users</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('Manage roles')
                                        <li class="col">
                                            <a href="{{ route('admin.roles') }}" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fa-solid fa-binoculars"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Roles & Permissions</p>
                                                    <small class="text-muted">Create or Assign Permissions</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('Read logs')
                                        <li class="col">
                                            <a href="{{ route('logs') }}" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fas fa-history"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Logs</p>
                                                    <small class="text-muted">View logs</small></small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('Manage support')
                                        <li class="col">
                                            <a href="" class="d-flex color-700">
                                                <div class="avatar">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </div>
                                                <div class="flex-fill text-truncate">
                                                    <p class="h6 mb-0">Support</p>
                                                    <small class="text-muted">Manage tickets & support</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
