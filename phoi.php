<?php
$title="Tải phôi";
include "header.php";
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
                            <div class="btn-group pull-right">
                                
                            </div>
                            <h4 class="page-title">Thư viện file</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        
                        <div class="card-box">
                            <button type="button" class="btn btn-custom btn-rounded w-md waves-effect waves-light pull-right" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-upload"></i> Upload File</button>
                            <h4 class="header-title m-b-30">My Files</h4>

                            <ul class="nav nav-tabs tabs-bordered">
                                <?php foreach ($phoitype as $key => $value): ?>
                                    <li class="nav-item">
                                        <a style="font-size: 20px;font-weight: bold;" href="#tab<?=$key?>" data-toggle="tab" aria-expanded="false" class="nav-link <?=$key=="P"?"active":""?>">
                                             <?=$value?>
                                        </a>
                                    </li>
                                <?php endforeach ?>                               
                            </ul>
                            <div class="tab-content">
                                <?php foreach ($phoitype as $key => $value): ?>
                                   <div class="tab-pane show <?=$key=="P"?"active":""?>" id="tab<?=$key?>">
                                        <div class="row">
                                        <?php
                                            $qc1="select * from phoi where type='".$key."' order by idphoi desc";
                                            $rc1=confirm_query($qc1);
                                            $sl=mysqli_num_rows($rc1);
                                            if($sl > 0){
                                            while ($kq1 = mysqli_fetch_array($rc1,MYSQLI_ASSOC)) {
                                            ?>
                                            <div class="col-lg-3 col-xl-2">
                                                <div class="file-man-box">
                                                    <div class="file-img-box">
                                                        <img src="uploads/file/<?=$kq1["file"]?>" alt="icon">
                                                    </div>
                                                    <i type="<?=$kq1["type"]?>" id="<?=$kq1["idphoi"]?>" style="cursor: pointer;" class="file-download edit mdi mdi-information-variant"></i>
                                                    <div class="file-man-title">
                                                        <h5 class="mb-0 text-overflow"><a download href="uploads/file/<?=$kq1["file"]?>"><?=$kq1["file"]?></a></h5>
                                                        <p class="mb-0"><small><?=$kq1["size"]?> b</small></p>
                                                        <p class="note"><?=$kq1["note"]?> </p>
                                                        <?php if ($kq1["type"]=="IMG"): ?>
                                                            <span style="text-transform:none;">uploads/file/<?=$kq1["file"]?></span>
                                                        <?php endif ?>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <?php                                           
                                            }}                            
                                            ?>
                                        </div>
                                    </div> 
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!--  Modal content for the above example -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel">Upload file</h4>
                    </div>
                    <div class="modal-body">
                      <p>Chỉ chấp nhận file .svg, .jpg, .png. Export file từ corel rồi upload !.</p>                      
                      <p><b>Phôi, Hoa Văn, Logo sử dụng file .svg</b></p>                      
                         <form enctype="multipart/form-data" class="form-horizontal" role="form" action="action.php" method="post">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Text</label>
                                <div class="col-10">
                                    <input name="file" type="file" accept=".svg, .jpg, .png" class="form-control" value="Some text value...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Loại file</label>
                                <div class="col-10">
                                 <select required name="type" class="form-control">
                                      <?php foreach ($phoitype as $key => $value): ?>
                                          <option value="<?=$key?>"><?=$value?></option>
                                      <?php endforeach ?>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Ghi chú</label>
                                <div class="col-10">
                                    <textarea class="form-control" name="note"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="action" value="uploadfile">Upload</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

          <div id="modaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel">Chỉnh sửa file</h4>
                    </div>
                    <div class="modal-body">
                      <p>Chỉnh sửa file <b class="name-file"></b> !.</p>                      
                         <form enctype="multipart/form-data" class="form-horizontal" role="form" action="action.php" method="post">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Text</label>
                                <div class="col-10">
                                    <input name="file" type="file" accept=".svg, .jpg, .png" class="form-control" value="Some text value...">
                                </div>
                            </div>                         
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Loại file</label>
                                <div class="col-10">
                                 <select required name="type" class="form-control">
                                      <?php foreach ($phoitype as $key => $value): ?>
                                          <option value="<?=$key?>"><?=$value?></option>
                                      <?php endforeach ?>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Ghi chú</label>
                                <div class="col-10">
                                    <textarea class="form-control" name="note"></textarea>
                                </div>
                            </div>
                            <input hidden type="" name="idphoi">
                            <button type="submit" class="btn btn-primary" name="action" value="editfile">Chỉnh sửa file</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script type="text/javascript">
            $(".file-download").click(function(){
                var name=$(this).parents(".file-man-box").find("h5").text();
                var id=$(this).attr("id");
                var type=$(this).attr("type");
                var note=$(this).parents(".file-man-box").find(".note").text();
                $("#modaledit .name").text(name);
                $("#modaledit input[name=idphoi]").val(id);
                $("#modaledit option[value="+type+"]").removeAttr("selected");
                $("#modaledit option[value="+type+"]").attr('selected','selected');
                $('#modaledit').modal('show');
                $('#modaledit textarea').text(note);                
            }) 
        </script>            
<?php include "footer.php"; ?>