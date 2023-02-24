<?php
$title = "Tình trạng";
include "header.php";
if ($admin["cap"]>=3) {
    echo "Not Thing";
    exit();
}


?>
<style type="text/css">
    ul.ls li{
        display: inline-block;
        margin-left: 20px;
    }
</style>
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
                                    
                                    <h4 class="page-title">Trang chủ</h4>
                                </div>

                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">                     
                        <div class="card-box">
                            <div>Thống kê các đơn hàng chưa thanh toán. Các đơn hàng thỏa các tiêu chí sau:<br>
                                <ul>
                                    <li>1. Chưa thanh toán</li>
                                    <li>2. Là đơn hàng có lịch giao từ ngày hôm qua trở về trước</li>
                                    <li>3. Không phải đơn hàng "Sửa lỗi"</li>
                                    <li>4. Không phải đơn hàng của VIP MEMBER (Vip thanh toán riêng)</li>
                                </ul>
                            </div>
                            <?php 
                            $tmp_dt=get_file('where date1 < "'.date("Y-m-d").'" and file.idkh=0  and file.type not like "Sửa lỗi" and file.ttthanhtoan !="đã thanh toán"');
                             include "inc/tb_baocao.php";
                            ?>
                        </div>
                        </div>
                </div> <!-- end row -->
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