<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS only -->
    <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Ebay Cars</a>
    <input class="form-control form-control-dark w-50 rounded-0 border-0" type="search" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="{{ route('adminLogout') }}">Sign out</a>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <div class="container ">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="https://as2.ftcdn.net/v2/jpg/01/12/09/17/1000_F_112091769_vWEmDiwVIpO4H1plGuhYgnmduTuiGUh2.jpg">
                            </span>
                            <div class=" ml-2 d-none d-lg-block">
                              <span class="mb-0 text-sm  font-weight-bold">
                                 {{ auth()->guard('admin')->user()->name }}
                              </span>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <h1>Dashboard</h1>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file" class="align-text-bottom"></span>
                            Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cars') }}">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            Cars
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers') }}">
                            <span data-feather="users" class="align-text-bottom"></span>
                            Customers
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
