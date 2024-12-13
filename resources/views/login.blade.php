<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ISMA DASHBOARD - LOGIN</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('template/purple/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/purple/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/purple/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('template/purple/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('template/purple/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('template/purple/css/vertical-light/style.css') }}">
      <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo">
                  <img src="{{ asset('images/logo.png') }}" alt="logo">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" id="form_login" action="javascript:void(0)">
                    @csrf
                    @method('post')
                  <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" name="email" class="form-control form-control-sm border-left-0" id="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" name="password"  class="form-control form-control-sm border-left-0" id="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                    <a href="#" class="auth-link text-primary">Forgot password?</a>
                  </div>
                  <div class="my-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="btn-login"><i class="mdi mdi-login btn-icon-prepend"></i> LOGIN</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 login-half-bg d-flex flex-row">
              <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2024 All rights reserved.</p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- plugins:js -->
    <script src="{{ asset('template/purple/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('template/purple/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('template/purple/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('template/purple/vendors/sweetalert/sweetalert.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('template/purple/js/off-canvas.js') }}"></script>
    <script src="{{ asset('template/purple/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('template/purple/js/settings.js') }}"></script>
    <script src="{{ asset('template/purple/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script> 
    <script>
        $(document).ready(function(){
            // info('Success','Data tenaga kerja berhasil tersimpan','success','top-left');
        });

        $("#form_login").submit(function(e){
            e.preventDefault();
            proses_login();
        });

        proses_login = function(){
            var iData = $("#form_login").serialize();
            $.ajax({
                type    : "POST",
                url     : "{{ route('login') }}",
                data    : iData,
                chace   : false,
                beforeSend  : function (){
                    $("#btn-login").html("<i class='fa fa-spinner fa-spin btn-icon-prepend'></i>  LOGIN..")
                    $("#btn-login").prop("disabled",true);
                },
                success: function(result){
                    if(result.status == "success"){
                        position = "top-left";
                        icons = result.status;
                        pesan = result.messages;
                        title = "Login berhasil!";
                        info(title,pesan,icons,position);
                        $("#btn-login").html("<i class='mdi mdi-check btn-icon-prepend'></i>  LOGIN SUKSES")
                        $("#btn-login").prop("disabled",true);
                        setTimeout(function(){
                            window.location.assign("{{ route('home') }}")
                        }, 3000);
                    }
                },
                error: function(e){
                    console.log(e)
                    $("#btn-login").html("<i class='mdi mdi-login btn-icon-prepend'></i> LOGIN")
                    $("#btn-login").prop("disabled",false);
                    pesan_error(e);
                }
            })
        }


    </script>
    <!-- endinject -->
  </body>
</html>