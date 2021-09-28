<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white"
     id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0"
           href="{{ route('home') }}">
            <img src="{{ asset('logo') }}.png"
                 class="navbar-brand-img"
                 style='width: 100px;
                 object-fit: contain'
                 alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link"
                   href="#"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
              <img alt="Image placeholder"
                   src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
            </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                       class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#"
                       class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#"
                       class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#"
                       class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}"
                       class="dropdown-item"
                       onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse"
             id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button"
                                class="navbar-toggler"
                                data-toggle="collapse"
                                data-target="#sidenav-collapse-main"
                                aria-controls="sidenav-main"
                                aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search"
                           class="form-control form-control-rounded form-control-prepended"
                           placeholder="{{ __('Search') }}"
                           aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item" >
                    <a class="nav-link"
                       href="{{ route('products.index') }}">
                        <i class="ni ni-palette "></i> {{ __('Sell') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('orders.index') }}">
                        <i class="ni ni-shop"></i> {{ __('Sellers (orders)') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('products.index') }}">
                        <i class="ni ni-shop"></i> {{ __('Buy (products)') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('products.expire') }}">
                        <i class="ni ni-badge "></i> {{ __('Expire') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('products.debt') }}">
                        <i class="ni ni-bullet-list-67 "></i> {{ __('Debt List') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('products.not_left') }}">
                        <i class="ni ni-cart "></i> {{ __('Out Of Stock') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{route('suppliers.index')}}">
                        <i class="ni ni-delivery-fast "></i> {{ __('Supplier') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('cashiers.index')  }}">
                        <i class="ni ni-spaceship "></i> {{ __('Cashier') }}
                    </a>
                </li>

            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Login/Register</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link"
                       href="#">
                        <i class="ni ni-key-25 text-info"></i> {{ __('Login') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
