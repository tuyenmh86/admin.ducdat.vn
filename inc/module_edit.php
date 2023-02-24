<style type="text/css">
  .imgcn img{
    max-width: 100px;
    height: auto;
  }
  .imgcn li{
    display: inline-block;
    cursor: pointer;
  }
</style>
<div class="wrapper">
    <div class="container-fluid"> 

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Chỉnh Đơn Hàng <b><?=$data["ten"]?></b></h4>
                </div>
            </div>
        </div>
        <div class="row card-box">                          

            <div class="text-muted font-14 col-md-6">
            <img width="30px" src="<?=$data["img"]?>" alt="user" class="rounded-circle">
                <?php if (isset($_GET["tb"])){
                    echo gettb($_GET["tb"]);
                }else{
                    echo ' Bạn có thể <a href="'.BASE_URL.'delete.php?id='.$data["id"].'">Xóa Vĩnh Viễn</a> đơn hàng này, <b style="color:red">khi xóa rồi không khôi phục lại được</b>.';
                } ?>
            </div>
            <div class="col-md-6">                
                 <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#addmr"><i style="color: #fff" class="fas fa-plus"></i>Làm thêm</button>
                <!-- Modal -->
                <div id="addmr" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                   <form method="post" action="inc/addmore.php">
                        <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Chú ý</h4>
                      </div>
                      <div class="modal-body">
                        <p>Bạn đang yêu cầu thêm một đơn hàng "Làm thêm".</p>
                        <p>Hãy chọn ngày giao mới cho đơn hàng này và ấn xác nhận</p>
                        <input   class="form-control" id="date" type="date" name="date1">
                        <input type="number" name="id" class="hidden" value="<?=$data["id"]?>">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submit" value="addmr" class="btn btn-default"><i class="fas fa-check"></i>Xác Nhận</button>
                        <button class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
                      </div>
                    </div>
                   </form>
                  </div>
                </div>

                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#addnew"><i style="color: #fff" class="fas fa-plus"></i>Làm mới</button>
                <!-- Modal -->
                <div id="addnew" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                   <form method="post" action="inc/addmore.php">
                        <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Chú ý</h4>
                      </div>
                      <div class="modal-body">
                        <p>Bạn đang yêu cầu thêm một đơn hàng "Làm mới".</p>
                        <p>Hãy chọn ngày giao mới cho đơn hàng này và ấn xác nhận</p>
                        <input   class="form-control" id="date" type="date" name="date1">
                        <input type="number" name="id" class="hidden" value="<?=$data["id"]?>">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submit" value="addnew" class="btn btn-default"><i class="fas fa-check"></i>Xác Nhận</button>
                        <button class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
                      </div>
                    </div>
                   </form>
                  </div>
                </div>
            </div>
             
            <form method="post" action="action.php?action=edit" enctype="multipart/form-data">  
            <div class="row">
            <div class="col-md-6 ">
                <div class="row">
                  <div class="col-12">
                      <div>
                                <input  class="input" type="" name="ld" placeholder="Nội dung thu">
                                <input  class="input" type="number" name="t" placeholder="Nhập số tiền thu">
                                <button class="input" formtarget="_blank" type="submit" name="pt"><i class="fas fa-print"></i>Phiếu thu</button>
                                <span style="margin: 0px 10px 0px 10px; " > - </span>
                                <button class="input" formtarget="_blank" type="submit" name="hd"><i class="fas fa-print"></i>Hóa Đơn</button>
                                <button class="input" formtarget="_blank" type="submit" name="bn" ><i class="fas fa-print"></i>Biên Nhận</button>
                                <a class="input" href="in/infull.php?id=<?=$data["id"]?>"><i class="fas fa-print"></i>Giấy Hàng</a>
                     </div>

                  </div>
                  <div class="col-12">
                  <?php include "edit_more.php"; ?>                          
                  </div>

                            <div class="col-3">
                                <label >Tên file</label>
                                <input <?=$readonly?> class="form-control" type="text" name="ten"  value="<?=$data["ten"]?>">
                            </div>
                            <div class="col-3">
                                <label >Loại đơn hàng</label>
                                <select <?=$readonly?>  class="form-control" name="type" >
                                    <?php foreach ($datatype as $key => $value): ?>
                                        <option <?=$data["type"]==$value?"selected":""?> value="<?=$value?>"><?=$value?></option>
                                    <?php endforeach ?>
                                    
                                </select>
                            </div>
                            <div class="col-3">
                                <label >Ngày giao</label>
                                <input <?=$readonly?>  class="form-control" id="date" type="date" name="date1" value="<?=$data["cr_date1"]?>" >
                            </div>
                            <div class="col-3">
                                <label >Shiper</label>
                                <select class="form-control" name="shiper">
                                  <option value="">Chưa rõ</option>
                                  <?php foreach ($shipper as $shipk => $shipv): ?>
                                    <option <?=$shipv==$data["shiper"]?"selected":""?> value="<?=$shipv?>"><?=$shipv?></option>
                                  <?php endforeach ?>                                  
                                </select>
                            </div>
                             <?php
                                if(isset($data["idkh"])&& filter_var($data["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                  if (strlen($data["nguoinhan"])<=2) { $data["nguoinhan"]=$data["tenkh"];}
                                  if (strlen($data["sodt"])<=2) { $data["sodt"]=$data["sodtkh"];}
                                  if (strlen($data["mail"])<=2) { $data["mail"]=$data["mailkh"];}
                                  if (strlen($data["diachi"])<=2) { $data["diachi"]=$data["diachikh"];}
                                }
                            ?>                               

                            <div class="col-4">
                                <label >Người nhận</label>
                                <input class="form-control" type="text" name="nguoinhan"  value="<?=$data["nguoinhan"]?>">
                            </div>
                            <div class="col-4">
                                <label >Số điện thoại</label>
                                 <input class="form-control" type="text" name="sodt" value="<?=$data["sodt"]?>">
                            </div>
                             <div class="col-4">
                                    <label >Mail</label>
                                     <input class="form-control" type="text" name="mail" value="<?=$data["mail"]?>">
                                </div>
                            <div class="col-12">
                                <label >Địa chỉ</label>
                                <input class="form-control" type="text" name="diachi"  value="<?=$data["diachi"]?>">
                            </div>
                            <div class="col-12">
                                <label >Ghi chú</label>
                                 <textarea  class="form-control" name="note" ><?=$data["ghichu"]?></textarea>
                            </div>
                         <div class="yc col-12 mt-3">
                            <div>
                                <label >Yêu cầu</label>
                                <?php foreach ($yeucau as $key => $value) {
                                      if (is_array($data["yeucau"]) and in_array($value, $data["yeucau"])) {$s="checked";}else $s="";?>
                                      <input name="yeucau[]" <?=$s?>  type="checkbox" value="<?=$value?>" ><?=$value?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php
                                 if(isset($data["idkh"])&& filter_var($data["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                    ?>
                                    <label >Thông tin xuất hóa đơn <?=$vipmember?></label>
                                    <textarea  class="form-control" name="vat" disabled> <?=$data["vatkh"]?></textarea>

                            <?php
                                 }else{
                            ?>
                            <label >Thông tin xuất hóa đơn</label>
                            <textarea  class="form-control" name="vat" > <?=$data["vat"]?></textarea>
                            <?php }?>
                        </div> <!-- End col-12 -->

                        <div class="col-12">
                          <div class="row">
                            <div class="col-4">
                              <div>
                                      <label>Tiền đặt cọc (Tiền thanh toán trước)</label>
                                      <input class="form-control" type="text" name="datcoc"  value="<?=$data["datcoc"]?>">
                              </div>
                              <div>
                                <label >Phương Thức Thanh Toán</label>
                                <select class="form-control" name="ptthanhtoan" >
                                    <?php foreach ($ptthanhtoan as $key => $value) { ?>
                                      <option <?=$data["ptthanhtoan"]==$value?"selected":""?> value="<?=$value?>"><?=$value?></option>
                                    <?php } ?>
                                </select>
                              </div>

                              <div>
                                  <label ><blue>Tình trạng thanh toán</blue></label>
                                  <select class="form-control" name="ttthanhtoan" >
                                       <option  value="Chưa rõ">Chưa rõ</option>
                                      <?php foreach ($ttthanhtoan as $key => $value) { ?>
                                        <option <?=$data["ttthanhtoan"]==$value?"selected":""?> value="<?=$value?>"><?=$value?></option>
                                      <?php } ?>
                                  </select>
                              </div>

                            </div> <!-- End col-4 -->
                            <div class="col-8">
                                 <label ><b>Lịch sửa thu hồi công nợ</b></label> 
                                 <ul class="imgcn">
                                  <?php 
                                    $q2="select * from images where idsp={$id} and category='Bill Thanh Toán'";
                                    $r2=confirm_query($q2);
                                    $sl=mysqli_num_rows($r2);
                                    if($sl > 0){
                                    while ($kq2 = mysqli_fetch_array($r2,MYSQLI_ASSOC)) {
                                      $image=json_decode($kq2["image"],true);
                                      echo '<li><a target="_blank" href="'.$image["full"].'"><img src="'.$image[200].'"></a></li>';
                                    }}

                                   ?>
                                 </ul>
                                  <ul>
                                    <?php 
                                      $tmp=explode("[]",$data["congno"]);
                                      if (count($tmp)>=1) {
                                         foreach ($tmp as $key => $value) {
                                          echo "<li>".$value."</li>";
                                        }
                                      }
                                     ?>
                                  </ul>                                
                                  <input placeholder="Thêm mới lịch sử"  class="form-control" id="date" type="text" name="congno">
                            </div> <!-- End col-8 -->
                          </div>
                            
                        </div> <!-- End Row -->
                   
                      <div class="col-12 text-center" style="margin-top:20px;">
                        <input class="hidden"  type="number" name="id" value="<?=$id?>">
                        <button class="btn btn-block btn-custom waves-effect waves-light" name="submit" type="submit">Chỉnh Sửa</button>
                      </div>

                      <div class="col-sm-12" style="margin-top: 30px;">
                        <h4>History Log</h4>
                        <ul>
                          <?=$data["his_html"]?>
                        </ul>
                      </div>                     

                      </div> <!-- End Row -->
                        
            </div> <!-- End md6 -->

            <div class="col-md-6">
                  <div class="row">
                      <div class="col-5 inbox-widget ">
                        <?php if (isset($data["data_vip"])){ ?>
                            <h4>Quyền sở hữu</h4>
                            <div class="inbox-item vip">
                                <div class="inbox-item-img"><img src="<?=$data["data_vip"]["avatar"]?>" class="rounded-circle bx-shadow-lg" alt="">
                                </div>
                                <p class="inbox-item-author"><b><?=$data["data_vip"]["tenkh"]?></b></p>
                                <p class="inbox-item-text"><?=$data["data_vip"]["tencty"]?></p>
                                <input hidden type="" name="idkh" value="<?=$data["data_vip"]["idkh"]?>">
                            </div>
                        <?php }else{ ?>
                            <div class="inbox-item vip">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="rounded-circle bx-shadow-lg" alt="">
                            </div>
                               <p class="inbox-item-author">Không có vip</p>
                               <input type="" hidden name="idkh" value="0">
                            </div>
                        <?php } ?>                        
                      </div>
                      <div class="col-7"><?=$data["tongthanhtoan_text_admin"]?></div>  
                  </div>
                <div class="images">
                    <?php if (isset($data["list_product"]) && is_array($data["list_product"])) { foreach ($data["list_product"] as $key => $value): ?>
                      <?php include "inc_edit_list_product.php"; ?>                  
                    <?php endforeach; } ?>

                    <?php if (isset($data["list_mt"]) && is_array($data["list_mt"])) { foreach ($data["list_mt"] as $key => $value): ?>
                      <?php include "inc_edit_list_other.php"; ?>                  
                    <?php endforeach; } ?>

                    <?php if (isset($data["list_bill"]) && is_array($data["list_bill"])) { foreach ($data["list_bill"] as $key => $value): ?>
                      <?php include "inc_edit_list_other.php"; ?>                  
                    <?php endforeach; } ?>

                    <?php if (isset($data["list_other"]) && is_array($data["list_other"])) { foreach ($data["list_other"] as $key => $value): ?>
                      <?php include "inc_edit_list_other.php"; ?>                  
                    <?php endforeach; } ?>

                    <?php if (isset($data["list_yc"]) && is_array($data["list_yc"])) { foreach ($data["list_yc"] as $key => $value): ?>
                      <?php include "inc_edit_list_yc.php"; ?>                  
                    <?php endforeach; } ?>

                    </div>
                     <div id="addmore" class="btn btn-block btn-custom waves-effect waves-light" style="margin-top:15px">+ Add More</div>

                    </div> <!-- End col-md-6 right -->
                    </div> <!-- End row -->
                 </form>         
            </div> <!-- row card-box -->
        </div> <!-- end row -->  

    </div> <!-- end container -->
</div>
<!-- end wrapper -->
<!--  Modal content for the above example -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel">Danh sách vip</h4>
                    </div>
                    <div class="modal-body">
                     <div class="row">
                      <div class="col-4 inbox-widget ">
                        <div class="inbox-item vip">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="rounded-circle bx-shadow-lg" alt="">
                        </div>
                           <p class="inbox-item-author">Không có vip</p>
                           <input type="" hidden name="idkh" value="0">
                        </div>
                      </div>
                      <?php $tmp_data=get_vip("all"); if (is_array($tmp_data)) { foreach ($tmp_data as $key => $value) { ?>
                        <div class="col-4 inbox-widget ">
                          <div class="inbox-item">
                              <div class="inbox-item-img"><img src="<?=$value["avatar"]?>" class="rounded-circle bx-shadow-lg" alt="">
                          </div>
                             <p class="inbox-item-author"><b><?=$value["tenkh"]?></b></p>
                              <p class="inbox-item-text"><?=$value["tencty"]?></p>
                              <input type="" hidden name="idkh" value="<?=$value["idkh"]?>">
                          </div>
                        </div>
                      <?php }}?>
                  </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
<style type="">
  .inbox-item{
    cursor: pointer;
  }
  .inbox-item:hover{
    border: solid 1px #ccc;
    border-radius: 2px;
  }
</style>
<script type="text/javascript">
  $("button[name='hd']").click(function(){
    console.log("jhjk");
    $("button[name='submit']").remove();
  });
  $(".inbox-item").click(function(){
    $('#myModal').modal('show');
  })

  $("#myModal .inbox-item").click(function(){
    var html=$(this).html();
    $('#myModal').modal('hide');
    $('.inbox-item.vip').html(html);
  })
  
</script>