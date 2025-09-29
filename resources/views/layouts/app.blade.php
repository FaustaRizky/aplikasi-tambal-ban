<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Stok Barang')</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- OverlayScrollbars -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

  <!-- ApexCharts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">

  <!-- JSVectorMap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div class="app-wrapper">

    <!-- Header -->
    <nav class="app-header navbar navbar-expand bg-body">
      <div class="container-fluid">
        <!-- Start Navbar Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
          <li class="nav-item d-none d-md-block">
            <a href="#" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-md-block">
            <a href="#" class="nav-link">Contact</a>
          </li>
        </ul>

        <!-- End Navbar Links -->
        <ul class="navbar-nav ms-auto">

          <!-- User Menu -->
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="user-image rounded-circle shadow" alt="User Image">
              <span class="d-none d-md-inline">Tambal Ban Pak Uut</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <li class="user-header text-bg-primary">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="rounded-circle shadow" alt="User Image">
                <p>
                  Tambal Ban Pak Uut
                  <small>Member since Nov. 2023</small>
                </p>
              </li>
              <li class="user-footer">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
                <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Sidebar -->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
          <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
          <span class="brand-text fw-light">Pak Uut</span>
        </a>
      </div>

      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation">
            <li class="nav-item menu-open">
              <a href="{{ route('dashboard.index') }}" class="nav-link active">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('barangs.index') }}" class="nav-link">
                <i class="nav-icon bi bi-box-seam-fill"></i>
                <p>Stok Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('lakus.index') }}" class="nav-link">
                <i class="nav-icon bi bi-cart-check-fill"></i>
                <p>Laku</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('kulaans.index') }}" class="nav-link">
                <i class="nav-icon bi bi-cart-check-fill"></i>
                <p>Kulaan</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="app-main">
     <!-- Content Header -->
<div class="app-content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-0">@yield('title', 'Dashboard')</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">@yield('title', 'Dashboard')</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="app-content">
  <div class="container-fluid">
    
    <!-- /Widget Row -->

    <!-- Content dari view -->
    @yield('content')
  </div>
</div>
    </main>
  </div>

  <!-- JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

  <!-- OverlayScrollbars Configuration -->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };

    document.addEventListener('DOMContentLoaded', function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>

  <!-- ApexCharts dan JSVectorMap Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  @yield('scripts')
</body>

</html>