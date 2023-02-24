<?php
$title="User";
include "header.php";
if (!$admin["iduser"]==0) {
    if (isset($admin["block"]["us"])) { echo "Not thing !"; exit();}
}

?>
<style type="text/css">
    .meta li{
        display: inline-block;
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
                            <h3 class="page-title">Quản lý user</h3>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                 <div class="row">
                    <div class="col-8">
                        <div class="card-box ">
                            <h4>Quản lý user</h4>
                            <p class="text-muted font-14 m-b-30">
                                Hiển thị thông tin tài khoản, nhấn vào Họ Tên để chỉnh sửa.
                            </p>
                          <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>LEVER</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Họ Tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Chức vụ</th>
                                    <th>Lever</th>
                                    <th>Hạn chế</th>
                                    <th>Tài khoản</th>
                                    <th>Mật khẩu</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q1="select * from user";
                                        $r1=confirm_query($q1);
                                        $sl=mysqli_num_rows($r1);
                                        if($sl > 0){
                                        while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
                                            $kq1["block"]=json_decode($kq1["block"],true);
                                            ?>                                         
                                       <tr>
                                            <td><?=$kq1["cap"]?></td>
                                            <td><img style="max-width: 100px" src="<?=$kq1["img"]?>"></td>
                                            <td><a href="user.php?id=<?=$kq1["iduser"]?>"><?=$kq1["name"]?></a></td>
                                            <td><?=$kq1["phone"]?></td>
                                            <td><?=$kq1["chucvu"]?></td>                                            
                                            <td><?=$kq1["cap"]?></td>
                                            <td>
                                                <ul>
                                                    <?php if (is_array($kq1["block"])){ foreach ($kq1["block"] as $key => $value) {?>
                                                        <li><?=$block[$key]?></li>
                                                    <?php }} ?>
                                                </ul>
                                            </td>
                                            <td><b style="font-size:20px; text-transform: none;"><?=$kq1["us"]?></b></td>
                                            <td><?=$kq1["rp"]?></td>
                                        </tr>        
                                    <?php }} ?>        
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card-box ">
                            <?php if (isset($_GET["id"]) and is_numeric($_GET["id"])): ?>                                
                            <?php
                            $q1="select * from user where iduser=".$_GET["id"];
                            $r1=confirm_query($q1);
                            $sl=mysqli_num_rows($r1);
                            if($sl > 0){
                            $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC);
                            $bl=json_decode($kq1["block"],true);
                            ?>
                            <div class="row">
                                <div class="col-8">
                                    <h4>Thông tin tài khoản <?=$kq1["name"]?></h4>
                                    <p class="text-muted font-14">
                                        Điền thông tin ấn chỉnh sửa để chỉnh sửa.
                                    </p>
                                </div>
                                <div class="col-4">
                                    <img style="max-width: 100px" src="<?=$kq1["img"]?>">
                                </div>
                            </div>
                            <form method="post" action="action.php">
                                <div class="row">
                                    <div class="col-12 m-b-10">
                                        <label >LEVER</label> <small>Cấp từ 1-5</small> <input  class="form-control"  type="text" name="img" value="<?=$kq1["cap"]?>">
                                        <label >Ảnh</label><input  class="form-control"  type="text" name="img" value="<?=$kq1["img"]?>">
                                        <label >Họ Tên</label><input  class="form-control"  type="text" name="name" value="<?=$kq1["name"]?>">
                                        <label >Số điện thoại</label><input  class="form-control"  type="text" name="phone" value="<?=$kq1["phone"]?>">
                                        <label >Chức vụ</label><input  class="form-control"  type="text" name="chucvu" value="<?=$kq1["chucvu"]?>">
                                        <label >Tài khoản</label><input  class="form-control"  type="text" name="us" value="<?=$kq1["us"]?>">
                                        <label >Mật khẩu</label><input required type="password"  class="form-control"  type="text" name="pass">
                                        <input hidden  class="form-control"  type="text" name="iduser" value="<?=$kq1["iduser"]?>">
                                    </div>
                                    <div class="mt-3">
                                        <label>Hạn chế</label>
                                        <?php foreach ($block as $key => $value): ?>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" <?=isset($bl[$key])?"checked":""?> class="custom-control-input" id="block<?=$key?>" name="block[<?=$key?>]">
                                            <label class="custom-control-label" for="block<?=$key?>"><?=$value?></label>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" name="action" value="user" type="submit">Chỉnh sửa</button>
                                    </div>
                                </div>
                            </form>

                            <?php } endif ?>
                            <ul>
                                <li>LEVER 0: Toàn quyền</li>
                                <li>LEVER 4: Chỉ Xem</li>
                                <li>LEVER 5: Chỉ Xem mẫu</li>
                            </ul>
                        </div>
                        <div class="card-box ">
                            <h4>Thư viện ảnh hệ thống</h4>
                            <button type="button" class="btn btn-custom btn-rounded w-md waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-upload"></i> Upload File</button>
                            <span> * <i>Cân nhắc khi xóa ảnh, vì có ảnh của hệ thống</i>.</span>                            
                            <?php $img = scandir("img");?>
                            <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Dường dẫn</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($img as $key => $value): if (file_exists("img/".$value) and strlen($value)>2) {
                                    ?>
                                        <tr>
                                            <td><img style="max-width: 40px" src="img/<?=$value?>"></td>
                                            <td style="text-transform: none;">img/<?=$value?></td>
                                            <td><a href="action.php?action=delimg&name=<?=$value?>">Xóa</a></td>
                                        </tr>
                                    <?php } endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- end row -->
            </div> <!-- end container -->
        </div>
        <a href="function.php?action=backupDatabase">Backup DB</a>
        <!-- end wrapper -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel">Upload file</h4>
                    </div>
                    <div class="modal-body">
                      <p>Chỉ chấp nhận file .svg, .jpg, .png !.</p>                      
                         <form enctype="multipart/form-data" class="form-horizontal" role="form" action="action.php" method="post">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Chọn tệp</label>
                                <div class="col-10">
                                    <input name="file" type="file" accept=".svg, .jpg, .png" class="form-control" value="Some text value...">
                                </div>
                            </div>                          
                            <button type="submit" class="btn btn-primary" name="action" value="uploadimg">Upload</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 
        <?php
            include "footer.php";
        ?>
        


        <!-- Required datatable js -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
        
    </body>
</html>

<!--  -->