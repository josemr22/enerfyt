<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ asset('page-img/icons/favicon.png') }}" />
  <title>Dashboard-Enerfyt</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('fonts/googlefonts.css') }}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <!-- Custom-->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css"
    integrity="sha256-CNwnGWPO03a1kOlAsGaH5g8P3dFaqFqqGFV/1nkX5OU=" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
  @stack('css')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Enerfyt<sup></sup></div>
      </a>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        E-Commerce
      </div>

      <!-- Nav Item - Dashboard Collapse Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Dashboard</span>
        </a>
      </li> --}}

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
          aria-controls="collapseOne">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Productos</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Acciones:</h6>
            <a class="collapse-item" href="{{ route('products.index') }}">Listado</a>
            <a class="collapse-item" href="{{ route('products.trashed') }}">Papelera</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Categorías Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Categorías</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('squares.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Control de Stock</span>
        </a> 
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Pedidos</span>
        </a> 
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('appointments.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Citas</span>
        </a> 
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Heading -->
      <div class="sidebar-heading">
        Extras
      </div>
      
      <li class="nav-item">
        <a class="nav-link" href="{{ route('sliders.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Sliders</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('novelties') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Novedades</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('galery') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Galería</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('about.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Nosotros</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('services.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Servicios</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Blog</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('messages.index') }}">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Mensajes</span>
        </a>
      </li>




    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <a href="{{route('index')}}" class="ml-sm-4"></a>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-tie"></i>&nbsp;&nbsp;&nbsp;
                <span class="mr-2 d-none d-lg-inline text-gray-600">{{ Auth::user()->name }}</span>
                {{--                  <span class="mr-2 d-none d-lg-inline text-gray-600">Administrador</span>--}}
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Tato Developers 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Sweet Alert-->
  <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

  <!-- Toastr-->
  <script src="{{ asset('js/toastr.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('js/custom/admin.js') }}"></script>
  @stack('scripts')
</body>

</html>