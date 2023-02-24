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
                        }else{
                            echo ' Bạn có thể <a href="'.BASE_URL.'delete.php?id='.$kq1["id"].'">Xóa Vĩnh Viễn</a> thông tin về đơn hàng "'.$kq1["ten"].'", khi xóa rồi không khôi phục lại được.<br>Muốn chỉnh sửa hãy nhập lại dữ liệu ở ô dưới và nhấn nút "Chỉnh sửa" để hoàn tất.';
                        } ?>
                            
                      
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
                                    <div class="col-5">
                                        <label >Tên file</label>
                                        <input class="form-control" type="text" name="ten" required="" value="<?=$kq1["ten"]?>">
                                    </div>
                                    <div class="col-3">
                                        <label >Loại đơn hàng</label>
                                        <select required="" class="form-control" name="type" >
                                            <?php foreach ($datatype as $key => $value): if ($kq1["type"]==$value) {$temp="selected ";
                                                    }else $temp="";?>
                                                <option <?=$temp?> value="<?=$value?>"><?=$value?></option>
                                            <?php endforeach ?>
                                            
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label >Ngày giao</label>
                                        <input  class="form-control" id="date" type="date" name="date1" value="<?=$kq1["date1"]?>" >
                                    </div>
                                     <div class="col-3">
                                        <label >Tình trạng</label>
                                        <select class="form-control" name="tinhtrang1" >
                                            <?php
                                                foreach ($tinhtrang1 as $key => $value) {
                                                    if ($kq1["tinhtrang1"]==$value) {
                                                        $temp="selected ";
                                                    }else $temp="";
                                                    ?>
                                                    <option <?=$temp?> value="<?=$value?>"><?=$value?></option>
                                            <?php
                                                }
                                            ?>
                                            
                                        </select>
                                </div>

                                    <?php
                                        if(isset($kq1["idkh"])&& filter_var($kq1["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                            ?>
                                        <div class="col-5">
                                        <label >Người nhận <?=$vipmember?></label>
                                        <input class="form-control" type="text" name="nguoinhan"  value="<?=$kq1["tenkh"]?>" disabled >
                                        </div>
                                        <div class="col-4">
                                            <label >Số điện thoại</label>
                                             <input class="form-control" type="text" name="sodt" value="<?=$kq1["sodtkh"]?>" disabled>
                                        </div>
                                        <div class="col-12">
                                            <label >Địa chỉ</label>
                                            <input class="form-control" type="text" name="diachi"  value="<?=$kq1["diachikh"]?>" disabled>
                                        </div>

                                    <?php        
                                        }else{
                                    ?>                                    
                                    <div class="col-5">
                                        <label >Người nhận</label>
                                        <input class="form-control" type="text" name="nguoinhan"  value="<?=$kq1["nguoinhan"]?>">
                                    </div>
                                    <div class="col-4">
                                        <label >Số điện thoại</label>
                                         <input class="form-control" type="text" name="sodt" value="<?=$kq1["sodt"]?>">
                                    </div>
                                    <div class="col-12">
                                        <label >Địa chỉ</label>
                                        <input class="form-control" type="text" name="diachi"  value="<?=$kq1["diachi"]?>">
                                    </div>
                                    <?php }?>
                                    <div class="col-12">
                                        <label >Ghi chú</label>
                                         <textarea  class="form-control" name="note" > <?=$kq1["ghichu"]?></textarea>
                                    </div>
                                 <div class="yc col-12">
                                    <div>
                                        <label >Yêu cầu</label>
                                       <?php
                                            $dttemp=explode(",", $kq1["yeucau"]); 
                                            foreach ($yeucau as $key => $value) {
                                                if (in_array($value, $dttemp)) {
                                                    $s="checked";
                                                }else $s="";
                                                ?>
                                                <input name="yeucau[]" <?=$s?>  type="checkbox" value="<?=$value?>" name=""><?=$value?>
                                                <?php } ?>
                                    </div>
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
                                        <?php
                                             if(isset($kq1["idkh"])&& filter_var($kq1["idkh"], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                                ?>
                                                <label >Thông tin xuất hóa đơn <?=$vipmember?></label>
                                                <textarea  class="form-control" name="vat" disabled> <?=$kq1["vatkh"]?></textarea>

                                        <?php
                                             }else{
                                        ?>
                                        <label >Thông tin xuất hóa đơn</label>
                                        <textarea  class="form-control" name="vat" > <?=$kq1["vat"]?></textarea>
                                        <?php }?>
                                        
                                </div>
                           
                             <div class="col-12 text-center">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" name="submit" type="submit">Chỉnh Sửa</button>
                                </div>

                             <?php
                                if(isset($_POST["submit"])){
                                            $ten = post("ten");
                                            $tb="Sửa: ".'<b>'.$ten.'</b>';
                                            thongbao($tb,"orange");
                                            $date1=post("date1");
                                            $tinhtrang1 =post("tinhtrang1");
                                            $nguoinhan = post("nguoinhan");
                                            $sodt = post("sodt");
                                            $diachi = post("diachi");
                                            $ghichu = post("note");
                                            $ptthanhtoan = post("ptthanhtoan");
                                            $ttthanhtoan = post("ttthanhtoan");
                                            $vat = post("vat");
                                            $tmp= post("yeucau");
                                            $postidkh=post("idkh");
                                            $type=post("type");
                                            $yeucau="";
                                            if (is_array($tmp)) {
                                               foreach ($tmp as $key => $value) {
                                                $yeucau=$yeucau.",".$value;
                                                }
                                            }
                                            $id=$kq1["id"];
                                            if ($idkh == "") {
                                                 $q = "UPDATE file SET date1='{$date1}', ten='{$ten}', tinhtrang1='{$tinhtrang1}', nguoinhan='{$nguoinhan}', sodt='{$sodt}', diachi='{$diachi}', ghichu='{$ghichu}',yeucau='{$yeucau}',ptthanhtoan='{$ptthanhtoan}',ttthanhtoan='{$ttthanhtoan}',vat='{$vat}',idkh='{$postidkh}',type='{$type}' where id='{$id}'";
                                            }else{
                                                 $q = "UPDATE file SET date1='{$date1}', ten='{$ten}', tinhtrang1='{$tinhtrang1}', ghichu='{$ghichu}',yeucau='{$yeucau}',ptthanhtoan='{$ptthanhtoan}',ttthanhtoan='{$ttthanhtoan}',vat='{$vat}',idkh='{$postidkh}',type='{$type}' where id='{$id}'";                                                 
                                            }
                                           
                                            $kq=confirm_query($q);
                                        $deleteimage=post("deleteimage");
                                        if (is_array($deleteimage)) {
                                            foreach ($deleteimage as $key => $value) {
                                                $iddelete=$value;
                                                $q="SELECT * FROM `images` where id=$iddelete";
                                                $r=confirm_query($q);
                                                $kq1 = mysqli_fetch_array($r,MYSQLI_ASSOC); 
                                                if(mysqli_num_rows($r)> 0){
                                                    $file="images/".$kq1["image"];
                                                    unlink($file);
                                                    $q = "DELETE FROM images WHERE id = {$iddelete} LIMIT 1";
                                                    $r=confirm_query($q);
                                                }
                                            }
                                            
                                        }
                                        $editimage=post("editimage");
                                        if (is_array($editimage)) {
                                            $editsoluong=post("editsoluong");
                                            $editdongia=post("editdongia");
                                            $editchatlieu=post("editchatlieu");
                                            $editghichu=post("editghichu");
                                            $editkichthuoc=post("editkichthuoc");
                                            foreach ($editimage as $key => $value) {
                                                $q="UPDATE images SET soluong='{$editsoluong[$key]}',dongia='{$editdongia[$key]}',chatlieu='{$editchatlieu[$key]}', ghichu='{$editghichu[$key]}',kichthuoc='{$editkichthuoc[$key]}' where id='{$value}'";
                                                $r=confirm_query($q);
                                            }
                                        }

                                           
                                        if (isset($_FILES['image'])) {
                                                $idsp=$id;
                                                //print_r( $_FILES['image']);
                                                 $dataimg=array();
                                                foreach ($_FILES['image']['name'] as $key => $value) {
                                                  $name=$value;
                                                  $tmp_name=$_FILES['image']['tmp_name'][$key];
                                                  $dataimg[]=array(
                                                   "name" => $value,
                                                   "tmp_name" => $tmp_name,
                                                   "ghichu"=> $_POST["ghichu"][$key],
                                                   "chatlieu" => $_POST["chatlieu"][$key],
                                                   "soluong"=>$_POST["soluong"][$key],
                                                   "dongia"=>$_POST["dongia"][$key]
                                                  );
                                                }
                                                foreach ($dataimg as $key => $value) {
                                                   if ($value["name"]!=="") {
                                                        $ext = ".".pathinfo($value["name"], PATHINFO_EXTENSION);
                                                        $image=rand(1,10000000).$value["name"];
                                                        $image=md5($image).$ext;
                                                        // image file directory
                                                        $target = "images/".$image;
                                                        $thumb2="images/thumb/200/".$image;
                                                        $thumb1="images/thumb/100/".$image;
                                                        $image_text = mysqli_real_escape_string($dbc, $value["name"]);
                                                        $ghichu=$value["ghichu"];
                                                        $chatlieu=$value["chatlieu"];
                                                        $soluong=$value["soluong"];
                                                        $dongia=$value["dongia"];

                                                        

                                                        if (move_uploaded_file($value["tmp_name"], $target)) {
                                                            resize_image('max',$target,$thumb2,200,200);
                                                            resize_image('max',$target,$thumb1,100,100);
                                                            $sql = "INSERT INTO images (image,ghichu,chatlieu,soluong,idsp,dongia, image_text) VALUES ('$image','$ghichu','$chatlieu','$soluong','$idsp','$dongia','$image_text')";
                                                            // execute query
                                                            $temp=confirm_query($sql);
                                                        }
                                                   }
                                                }
                                            # code...
                                        } /*énd if image*/
                                        $url="edit.php?tb=editok&id=".$id;
                                       redirect_to($url);                                        
                                }
                            ?>


                               
                               
                                </div> <!-- End Row -->   
                    </div> <!-- End md6 -->

                    <div class="col-md-6">                                                 
                        <div class="images">
                                             <p>Ấn dấu X là xóa hình ảnh vĩnh viễn. cân nhắc trước khi ấn.</p>

                             <?php
                                $q1="select * from images where idsp={$id}";
                                $r1=confirm_query($q1);
                                $sl=mysqli_num_rows($r1);
                                if($sl > 0){
                                while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {                                           
                                   
                                   ?>

                                   <div class="row">
                                            <div id="<?=$kq1["id"]?>" class="delete deleteimage">X</div>
                                            <div class="col-5">
                                               <?php echo '<div class="thumbnail-lage"><img src="images/'.$kq1["image"].'"></div>';?>
                                            </div>
                                           
                                            <div class="col-7">
                                               <div>
                                                   <SPAN>SL</SPAN> <input class="input inline w-9" placeholder="Số Lượng" type="number" value="<?=$kq1["soluong"]?>" name="editsoluong[]">
                                               </div>
                                               <div>
                                                    <span>ĐG</span><input class="input inline w-9" placeholder="Đơn Giá" type="number" value="<?=$kq1["dongia"]?>" name="editdongia[]">
                                               </div>
                                                 <div>
                                                 <span>Chất liệu</span>  
                                                        <select class="form-control" name="editchatlieu[]">
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
                                                 </div>
                                              <input type="number" class="hidden" name="editimage[]" value="<?=$kq1["id"]?>">
                                              <div> 
                                                    <span>KT</span>
                                                    <input required  class="form-control" value="<?=$kq1["kichthuoc"]?>"  type="text" name="editkichthuoc[]">
                                              </div>
                                              <div> 
                                                    <span>Note</span>
                                                    <input class="form-control" placeholder="Ghi chú" type="text" value="<?=$kq1["ghichu"]?>" name="editghichu[]">
                                              </div>
                                            </div>
                                        </div>    
                            <?php
                                }}
                              ?>
                                    </div>
                                     <div id="addmore" class="btn btn-block btn-custom waves-effect waves-light" style="margin-top:15px">+ Add More</div>

                                     <div class="col-12" style="margin-top: 20px;">
                                         Quyền sở hữu
                                         <select name="idkh" class="form-control">
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
                                         ( Dùng để chuyển quyền sở hữu sang <?=$vipmember?> )
                                     </div>
                            </div> <!-- End col-md-6 right -->
                            </div> <!-- End row -->
                         </form>         
                    </div> <!-- row card-box -->
                </div> <!-- end row -->
            

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->