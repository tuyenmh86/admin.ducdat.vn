     <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Chỉnh Sửa file <b><?=$kq1["ten"]?></h4>
                        </div>
                    </div>
                    
                </div>
                <!-- end page title end breadcrumb -->
                 <div class="row in"  style="background: #fff;padding: 20px; padding-bottom: 0px;">                     
                 <div  >
                     <form method="get" action="in/phieuthu.php">
                            <input required="" class="input" type="" name="ld" placeholder="Nội dung thu">
                            <input required="" class="input" type="number" name="t" placeholder="Nhập số tiền thu">
                            <input class="hidden"  type="number" name="id" value="<?=$id?>">
                            <button class="input" formtarget="_blank" type="submit" value="submit"><i class="fas fa-print"></i>Phiếu thu</button>
                        </form>
                 </div>

                 <div >
                     <form method="get" action="in/hoadon.php">
                            <input class="input" type="" name="ten" placeholder="Nhập tên hàng hóa">
                            <input class="hidden"  type="number" name="id" value="<?=$id?>">
                            <button class="input" formtarget="_blank" type="submit" value="submit"><i class="fas fa-print"></i>Hóa Đơn</button>
                        </form>
                 </div>
                 <div>
                     <form method="get" action="in/infull.php">
                            <input class="input" type="" name="ghichu" placeholder="Nhập ghi chú">
                            <input class="hidden"  type="number" name="id" value="<?=$id?>">
                            <button class="input" formtarget="_blank" type="submit" value="submit"><i class="fas fa-print"></i>Giấy Hàng</button>
                    </form>
                 </div>

                 <div >
                     <form method="get" action="in/biennhan.php">
                            <input class="hidden"  type="number" name="id" value="<?=$id?>">
                            <button class="input" formtarget="_blank" type="submit" value="submit"><i class="fas fa-print"></i>Biên Nhận</button>
                        </form>
                 </div>

                 
                 </div>

               

                <div class="row card-box">                          

                    <div class="text-muted font-14 col-md-6">
                        <?php if (isset($_GET["tb"])){
                            echo gettb($_GET["tb"]);
                        } ?>
                       <?=isset($tbeditus)?$tbeditus:""?>                        
                      
                    </div>
                    <div class="col-md-6">
                        
                         <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#addmore"><i style="color: #fff" class="fas fa-plus"></i>

 Làm thêm</button>

                        <!-- Modal -->
                        <div id="addmore" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                           <form method="post" action="inc/addmore.php">
                                <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Chú ý</h4>
                              </div>
                              <div class="modal-body">
                                <p>Bạn đang yêu cầu thêm một đơn hàng "làm thêm".</p>
                                <p>Hãy chọn ngày giao mới cho đơn hàng này và ấn xác nhận</p>
                                <input required=""  class="form-control" id="date" type="date" name="date1">
                                <input type="number" name="id" class="hidden" value="<?=$kq1["id"]?>">
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-default"><i class="fas fa-check"></i>

 Xác Nhận</button>
                                <button class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>

 Close</button>
                              </div>
                            </div>
                           </form>

                          </div>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <div class="row">   
                    <div class="col-md-6 ">
                        <div class="row">

                                    <div class="col-12">
                                                <label >Tình trạng thanh toán</label>
                                                <select class="form-control" name="ttthanhtoan" >
                                                     <option  value="">Chưa rõ</option>
                                                    <?php
                                                        foreach ($ttthanhtoan as $key => $value) {
                                                            if ($kq1["ttthanhtoan"]==$value) {
                                                                $temp="selected ";
                                                            }else $temp="";
                                                            ?>
                                                            <option <?=$temp?> value="<?=$value?>"><?=$value?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                        </div>
                                     <div class="col-12">
                                        <label >Phương Thức Thanh Toán</label> 
                                        <select class="form-control" name="ptthanhtoan" >
                                            <option  value="">Chưa rõ</option>
                                            <?php
                                                foreach ($ptthanhtoan as $key => $value) {
                                                    if ($kq1["ptthanhtoan"]==$value) {
                                                        $temp="selected ";
                                                    }else $temp="";
                                                    ?>
                                                    <option <?=$temp?> value="<?=$value?>"><?=$value?></option>
                                            <?php
                                                }
                                            ?>
                                            
                                        </select>
                                </div>
                                <div class="col-12">
                                        <label >Ghi chú</label>
                                         <textarea  class="form-control" name="note" > <?=$kq1["ghichu"]?></textarea>
                                </div>

                                    <div class="col-5">
                                        <label>Tên file:</label>
                                        <span><?=$kq1["ten"]?></span>
                                    </div>
                                     <div class="col-4">
                                        <label>Ngày giao:</label>
                                        <span><?=$kq1["date1"]?></span>
                                    </div>
                                     <div class="col-3">
                                        <label>Tình trạng:</label>
                                       <span><?=$kq1["tinhtrang1"]?></span>
                                </div>

                                 <div class="col-3">
                                    <?php  if (isset($kq1["soluong"]) and $kq1["soluong"]>0) {
                                        echo ' <label>Số lượng:</label>
                                       <span>'.$kq1["soluong"].'</span>';
                                    }?>
                                </div>
                                <div class="col-3">
                                    <?php  if (isset($kq1["dongia"]) and $kq1["dongia"]>0) {
                                        echo ' <label>Đơn Giá:</label>
                                       <span>'.$kq1["dongia"].'</span>';
                                    }?>
                                </div>
                                <div class="col-3">
                                    <?php  if (isset($kq1["tongtien"]) and $kq1["tongtien"]>0) {
                                        echo ' <label>Tổng Tiền:</label>
                                       <span>'.$kq1["tongtien"].'</span>';
                                    }?>
                                </div>

                                    <?php
                                        if(isset($kq1["idkh"])&& filter_var($kq1["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                            ?>
                                        <div class="col-6">
                                            <label>Người nhận:</label>
                                       <span><?=$kq1["tenkh"]?> <?=$vipmember?></span>
                                        </div>
                                        <div class="col-6">
                                            <label>Số điện thoại:</label>
                                             <span><?=$kq1["sodtkh"]?></span>
                                        </div>
                                        <div class="col-12">
                                            <label>Địa chỉ: </label>
                                            <span><?=$kq1["diachikh"]?></span>
                                        </div>

                                    <?php        
                                        }else{
                                    ?>                                    
                                    <div class="col-6">
                                        <label>Người nhận:</label>
                                        <span><?=$kq1["nguoinhan"]?></span>
                                    </div>
                                    <div class="col-6">
                                        <label>Số điện thoại:</label>
                                        <span><?=$kq1["sodt"]?></span>
                                    </div>
                                    <div class="col-12">
                                        <label>Địa chỉ:</label>
                                        <span><?=$kq1["diachi"]?></span>
                                    </div>
                                    <?php }?>
                                   
                                 <div class="yc col-12">
                                    <div>
                                        <label >Yêu cầu:</label>
                                       <?php
                                            $dttemp=explode(",", $kq1["yeucau"]); 
                                                foreach ($dttemp as $key => $value) {
                                                    echo '<span>'.$value.'</span>';
                                                }
                                            ?>
                                    </div>
                                </div>
                           
                        
                                <div class="col-12">
                                        <?php
                                             if(isset($kq1["idkh"])&& filter_var($kq1["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                                ?>
                                                <label >Thông tin xuất hóa đơn <?=$vipmember?></label>
                                               <p><?=$kq1["vatkh"]?></p>

                                        <?php
                                             }else{
                                        ?>
                                        <label >Thông tin xuất hóa đơn</label>
                                       <p><?=$kq1["vat"]?></p>
                                        <?php }?>
                                        
                                </div>
                           
                             <div class="col-12 text-center">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" name="submit" type="submit">Chỉnh Sửa</button>
                                </div>

                             <?php
                                if(isset($_POST["submit"])){
                                           
                                            $tb="Sửa: ".'<b>'.$kq1["ten"].'</b>';
                                            thongbao($tb,"orange");                                         
                                            $ttthanhtoan = post("ttthanhtoan");
                                            $ptthanhtoan = post("ptthanhtoan");
                                             $ghichu = post("note");                                               
                                            $id=$kq1["id"];                                           
                                            $q = "UPDATE file SET ghichu='{$ghichu}', ttthanhtoan='{$ttthanhtoan}',ptthanhtoan='{$ptthanhtoan}' where id='{$id}'";
                                            $kq=confirm_query($q);
                                            $url="edit.php?tb=Đã chỉnh sửa !&id=".$id;
                                             redirect_to($url);   
                                        } 
                                        
                            ?>
                               
                               
                                </div> <!-- End Row -->   
                    </div> <!-- End md6 -->

                    <div class="col-md-6">                                                 
                        <div class="images">
                             <?php
                                $q1="select * from images where idsp={$id}";
                                $r1=confirm_query($q1);
                                $sl=mysqli_num_rows($r1);
                                if($sl > 0){
                                while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {                                           
                                   
                                   ?>

                                   <div class="row">
                                            <div class="col-5">
                                               <?php echo '<div class="thumbnail-lage"><img src="images/'.$kq1["image"].'"></div>';?>
                                            </div>
                                           
                                            <div class="col-7">
                                               <div>
                                                   <SPAN>SL</SPAN> <input class="input inline w-9" placeholder="Số Lượng" type="number" value="<?=$kq1["soluong"]?>" disabled >
                                               </div>
                                               <div>
                                                    <span>ĐG</span><input class="input inline w-9" placeholder="Đơn Giá" type="number" value="<?=$kq1["dongia"]?>" disabled >
                                               </div>
                                                 <select class="form-control" disabled>
                                                <option value="">Chất liệu</option>
                                                 <?php
                                                        foreach ($datachatlieu as $key => $value) {
                                                            if ($kq1["chatlieu"]==$value) {
                                                                $temp="selected ";
                                                            }else $temp="";
                                                            ?>
                                                            <option <?=$temp?> value="<?=$value?>"><?=$value?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                
                                              </select>
                                              <input type="number" class="hidden" disabled value="<?=$kq1["id"]?>">
                                              <input class="form-control" placeholder="Ghi chú" type="text" value="<?=$kq1["ghichu"]?>" disabled> 
                                            </div>
                                        </div>    
                            <?php
                                }}
                              ?>
                                     

                                     <div class="col-12" style="margin-top: 20px;">
                                         Quyền sở hữu
                                         <select name="idkh" class="form-control" disabled>
                                             <option value="0">Không</option>
                                             <?php
                                                    $q1="select * from khachhang";
                                                        $r1=confirm_query($q1);
                                                        $sl=mysqli_num_rows($r1);
                                                        if($sl > 0){
                                                        while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
                                                            if ($idkh==$kq1["idkh"]) {
                                                                $tmp="selected";
                                                            }else $tmp="";
                                                            echo '<option value="'.$kq1["idkh"].'" '.$tmp.'>'.$kq1["tenkh"].'</option>';                                                           
                                                           }}
                                                ?>
                                         </select>
                                     </div>
                            </div> 
                </div> <!-- end col md 6-->
            </div> <!-- End row -->
            </form>

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->