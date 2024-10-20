<!-- *************
    ************ JavaScript Files *************
************* -->
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- *************
    ************ Vendor Js Files *************
************* -->

<!-- Overlay Scroll JS -->
<script src="../assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
<script src="../assets/vendor/overlay-scroll/custom-scrollbar.js"></script>

<!-- Apex Charts -->
<!-- <script src="../assets/vendor/apex/apexcharts.min.js"></script> -->
<!-- <script src="../assets/vendor/apex/custom/dash2/sparkline.js"></script> -->
<!-- <script src="../assets/vendor/apex/custom/dash2/traffic.js"></script> -->
<!-- <script src="../assets/vendor/apex/custom/dash2/active-users.js"></script> -->
<!-- <script src="../assets/vendor/apex/custom/dash2/sessions.js"></script> -->
<!-- <script src="../assets/vendor/apex/custom/dash1/activity-report.js"></script> -->
<!-- <script src="../assets/vendor/apex/custom/dash1/deals.js"></script> -->
<!-- <script src="../assets/vendor/apex/custom/dash1/sparkline.js"></script>
<script src="../assets/vendor/apex/custom/dash1/sparkline2.js"></script> -->
<!-- <script src="../assets/vendor/apex/custom/profile/sales.js"></script> -->

<!-- Rating -->
<script src="../assets/vendor/rating/raty.js"></script>
<script src="../assets/vendor/rating/raty-custom.js"></script>

<!-- Custom JS files -->
<script src="../assets/js/custom.js"></script>

<!-- Start: the below for datatable -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    className: 'btn btn-excel'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-print'
                }
            ],
            scrollX: true,
            pageLength: 100,
            lengthMenu: [ [100, 200, 300, 400, 500], [100, 200, 300, 400, 500] ]
        });
    });
</script>
<!-- End: the below for datatable -->
