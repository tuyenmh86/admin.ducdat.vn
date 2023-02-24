<?php
$title="Đơn hàng cá nhân";
include "header.php";
if ($admin["cap"]>2) {
    redirect_to();
    exit();
}
?>
    <body>
        <?php
         include "menu.php";
        ?>
        
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Xem đơn hàng</h4>
                                </div>

                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                 <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title">Xem tất cả đơn hàng</h4>
                            <p class="text-muted font-14 m-b-30">
                                Chỉ hiển thị những thông tin đơn giản, nhấn vào đơn hàng để xem chi tiết. <br>Nhập từ khóa vào ô tìm kiếm để tìm kiếm ( Phân biệt viết có dấu và không dấu).
                            </p>
                            <?php 
                            $tmp_dt=get_file(array("user.iduser"=>$admin["iduser"]));
                             include "inc/tb_baocao.php";
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <?php
            include "footer.php";
        ?>
        <!-- Required datatable js -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>
    </body>
</html>