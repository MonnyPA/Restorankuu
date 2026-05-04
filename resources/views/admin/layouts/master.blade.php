@include('admin.layouts.__header')

<body>
    <script src="{{ asset('assets/admin/static/js/initTheme.js') }}"></script>

    <div id="app">

        @include('admin.layouts.__sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>


            @yield('content')



            @include('admin.layouts.__footer')

        </div>
    </div>

    <script src="{{ asset('mazer/dist/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('mazer/dist/assets/static/js/pages/simple-datatables.js') }}"></script>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/admin/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/core/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/admin/static/js/components/dark.js') }}"></script>
    {{-- <script src="{{ asset('assets/admin/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script> --}}
    <script src="{{ asset('mazer/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    {{-- <script src="{{ asset('assets/admin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script> --}}

    <script src="{{ asset('assets/admin/compiled/js/app.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/admin/kaiadmin.min.js') }}"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('assets/admin/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/static/js/pages/dashboard.js') }}assets/"></script>

    <!-- Datatables -->
    {{-- <script src="{{ asset('assets/admin/datatables/datatables.min.js') }}"></script> --}}

    <!-- Handle Sort Table -->
    <script>
    $(document).ready(function () {
        // $("#basic-datatables").DataTable({});

        $("#basic-datatables").DataTable({
        pageLength: 7,
        initComplete: function () {
            this.api()
            .columns()
            .every(function () {
                var column = this;
                var select = $(
                '<select class="form-select"><option value=""></option></select>'
                )
                .appendTo($(column.footer()).empty())
                .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

                column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                    select.append(
                    '<option value="' + d + '">' + d + "</option>"
                    );
                });
            });
        },
        });
    });
    </script>

</body>
{{-- @yield('script') --}}
</html>
