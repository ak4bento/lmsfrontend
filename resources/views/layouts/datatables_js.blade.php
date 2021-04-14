<!-- Datatables -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function() {
        $('.select2').select2({
            theme: "bootstrap4",
            placeholder: "Pilih",
            // width: 'auto',
            dropdownAutoWidth: true,
            allowClear: true,
        });
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });

</script>
<script src="{{ asset('../node_modules/video.js/dist/video.js') }}"></script>
{{-- <script
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.38.0/js/tempusdominus-bootstrap-4.min.js"
    crossorigin="anonymous"></script> --}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- <script src="https://cdn.plyr.io/3.6.4/plyr.js"></script> --}}
<script>
    $("#delete").click(function(e) {
        e.preventDefault();
        // let id = $(this).data('id');
        let url = $(this).data('url');

        // url = url.replace(':id', id);
        console.log('url', url);
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete '
        }).then((result) => {
            if (result.value) {
                // $(".form").submit();
                // window.location.href = form.submit();
                window.location.href = url;
                // window.location.href = "{{ url('/candidate/delete/') }}" + "/" + postId;
            }
        })

    });

</script>
