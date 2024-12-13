<!DOCTYPE html>
<html lang="en">
    @include('template.purple.header')
    <body>
        <div class="container-scroller">
            @include('template.purple.navbar')
            <div class="container-fluid page-body-wrapper">
                @include('template.purple.menu')
                <!-- partial -->
                <div class="main-panel">
                <div class="content-wrapper">
                     @yield('page-header')
                     @yield('konten')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a href="https://intansejahterautama.co.id/" target="_blank">PT Intan Sejahtera Utama</a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Departamen IT </span>
                    </div>
                </footer>
                <!-- partial -->
                </div>
            </div>
        </div>
        @include('template.purple.js')
        @yield("script")
    </body>
</html>