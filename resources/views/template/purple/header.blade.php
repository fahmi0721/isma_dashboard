  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <title>@yield('page-title')</title>
      <!-- plugins:css -->
      
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/mdi/css/materialdesignicons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/ti-icons/css/themify-icons.css') }}">
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/css/vendor.bundle.base.css') }}">
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/font-awesome/css/font-awesome.min.css') }}">
      <!-- endinject -->
      <!-- Plugin css for this page -->
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/select2/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('template/purple/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
      
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <!-- endinject -->
      <!-- Layout styles -->
      <link rel="stylesheet" href="{{ asset('template/purple/css/vertical-light/style.css') }}">
      <!-- End layout styles -->
      <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}" />
      @yield('custom_css')
  </head>
