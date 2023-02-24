<?php
$title="Thêm mới";
include "header.php";
if ($admin["cap"]>=3) {
        redirect_to();
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
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="#">Thêm mới</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Thêm mới đơn hàng</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                <form method="post" enctype="multipart/form-data">  

                <div class=" card-box row">
                        <div class="col-12">
                             <h4 class="m-t-0 header-title">Thông tin đơn hàng</h4>
                            <p class="text-muted font-14 m-b-30">
                                Nhập càng đầy đủ càng tốt, các yêu cầu thêm về chất liệu, quy cách ..... ghi phần ghi chú.
                                <?php if (isset($_GET["tb"])) {
                                    # code...
                                    echo "<br><b class='red'>".$_GET["tb"]."</b>";
                                } ?>
                            </p>
                        </div>
                        <div class="col-6">
                               <div class="row">
                                    <div class="col-5">
                                        <label >Tên file</label>
                                        <input class="form-control" type="text" name="ten" required  placeholder="Nhập tên file corel">
                                    </div>
                                     <div class="col-3">
                                        <label >Loại đơn hàng</label>
                                                <select required="" class="form-control" name="type">
                                                    <?php foreach ($datatype as $key => $value): ?>
                                                        <option value="<?=$value?>"><?=$value?></option>
                                                    <?php endforeach ?>
                                                </select>
                                    </div>
                                    <div class="col-4">
                                        <label >Ngày giao</label>
                                        <input  class="form-control" id="date" type="date" name="date1" required="" >
                                    </div>
                                     
                                     <?php
                                         if(isset($_GET["idkh"])&& filter_var($_GET['idkh'], FILTER_VALIDATE_INT, array('min_range' => 1))){
                                            $idkh=$_GET["idkh"];
                                            $q="SELECT * FROM khachhang where idkh=$idkh";
                                            $r=confirm_query($q);
                                            $kq1 = mysqli_fetch_array($r,MYSQLI_ASSOC); 
                                            $tenkh=$kq1["tenkh"];
                                            $tenctykh=$kq1["tencty"];
                                            $sodtkh=$kq1["sodtkh"];
                                            $diachikh=$kq1["diachikh"];
                                            if(mysqli_num_rows($r)> 0){

                                        ?>

                                         <div class="col-6">
                                            <label >Người nhận <?=$vipmember?></label>
                                            <input class="form-control" type="text" name="nguoinhan"  value="<?=$tenkh?>" >
                                        </div>
                                        <div class="col-6">
                                            <label >Số điện thoại</label>
                                            <input class="form-control" type="text" name="sodt" value="<?=$sodtkh?>"  >
                                        </div>
                                        <div class="col-12">
                                            <label >Địa chỉ</label>
                                            <input class="form-control" type="text" name="diachi"  value="<?=$diachikh?>">
                                        </div>
                                    <?php             
                                        } }else{
                                     ?>
                                    
                                    <div class="col-6">
                                        <label >Người nhận</label>
                                        <input class="form-control" type="text" name="nguoinhan"  placeholder="Nhập người nhận">
                                    </div>
                                    <div class="col-6">
                                        <label >Số điện thoại</label>
                                        <input class="form-control" type="text" name="sodt" >
                                    </div>
                                    <div class="col-12">
                                        <label >Địa chỉ</label>
                                        <input class="form-control" type="text" name="diachi"  placeholder="Nhập địa chỉ">
                                    </div>

                                    <?php  } ?>

                                    <div class="col-12">
                                        <label >Ghi chú</label>
                                        <textarea  class="form-control" name="note" > </textarea>
                                    </div>
                                 <div class="yc col-12">
                                    <div>
                                        <label >Yêu cầu</label>
                                        <?php
                                            foreach ($yeucau as $key => $value) {
                                                ?>
                                                <input name="yeucau[]"  type="checkbox" value="<?=$value?>" name=""><?=$value?>
                                                <?php } ?>
                                    </div>
                                </div>


                                <div class="col-12 text-center">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" name="submit" type="submit">Thêm mới đơn hàng</button>
                                </div>
                               
                                </div> <!-- End Row -->   
                           
                        </div> <!-- End col-6 -->

                        <div class="col-6">
                            <img style="width: 100%" src="img/bn1.jpg">
                                    <div class="images">
                                         <?php 
                                            include ("inc/image.php");
                                        ?>                                        
                                    </div>
                                     <div id="addmore" class="btn btn-block btn-custom waves-effect waves-light" style="margin-top:15px">+ Add More</div>

                        </div> <!-- End Col-6 -->
                </div> <!-- end cart box -->
                </form>
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
<?php
if(isset($_POST["submit"])){
            $date1=post("date1");
            $ten = post("ten");
            $nguoinhan = post("nguoinhan");
            $sodt = post("sodt");
            $diachi = post("diachi");
            $note = post("note");
            $tmp= post("yeucau");
            $yeucau="";
            $type=post("type");
            
            $capcha=md5(rand(1,1000000));
            if (is_array($tmp)) {
               foreach ($tmp as $key => $value) {
                $yeucau=$yeucau.",".$value;
                }
            }
            if (isset($idkh)) {
                # code...
                $q = "INSERT INTO file (date1, ten, nguoinhan, sodt, diachi, ghichu,yeucau,iduser,ttthanhtoan,ptthanhtoan,capcha,date2,idkh,type) 
VALUES ('$date1', '$ten', '$nguoinhan', '$sodt', '$diachi', '$note','$yeucau','$iduser','Chưa Thanh Toán','Chưa rõ','$capcha', '$now', '$idkh','$type')";
            }else {
                $q = "INSERT INTO file (date1, ten, nguoinhan, sodt, diachi, ghichu,yeucau,iduser,ttthanhtoan,ptthanhtoan,capcha,date2,type) 
VALUES ('$date1', '$ten', '$nguoinhan', '$sodt', '$diachi', '$note','$yeucau','$iduser','Chưa Thanh Toán','Chưa rõ','$capcha', '$now','$type')";
            }
            $temp=confirm_query($q);
            if ($temp) {
                $tb="Thêm : ".'<b>'.$ten.'</b>';
                thongbao($tb,"green");
                $q1="select id from file where ten='$ten' and nguoinhan='$nguoinhan' and sodt='$sodt' and capcha='$capcha' ";
                $r1=confirm_query($q1);
                $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC);
                $idsp=$kq1["id"];
                $dataimg=array();
                foreach ($_FILES['image']['name'] as $key => $value) {
                  $name=$value;
                  $size=$_FILES['image']['size'][$key];
                  $tmp_name=$_FILES['image']['tmp_name'][$key];
                  if ($size>0) {
                      $dataimg[]=array(
                       "name" => $value,
                       "tmp_name" => $tmp_name,
                       "ghichu"=> $_POST["ghichu"][$key],
                       "chatlieu" => $_POST["chatlieu"][$key],
                       "soluong"=>$_POST["soluong"][$key],
                       "dongia"=>$_POST["dongia"][$key],
                       "kichthuoc"=>$_POST["kichthuoc"][$key],
                       "category"=>$_POST["category"][$key]
                      );
                  }
                }
                foreach ($dataimg as $key => $value) {
                    $ext = ".".pathinfo($value["name"], PATHINFO_EXTENSION);
                    $image=get_name_image($ten,$date1,$ext);
                    // image file directory
                    $folder="images/".date("Y/m");
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }
                    $target = $folder."/".$image;
                    $thumb2=$folder."/thumb200_".$image;
                    $thumb1=$folder."/thumb100_".$image;                    
                    $image_text = mysqli_real_escape_string($dbc, $value["name"]);
                    $ghichu=$value["ghichu"];
                    $chatlieu=$value["chatlieu"];
                    $soluong=$value["soluong"];
                    $dongia=$value["dongia"];
                    $kichthuoc=$value["kichthuoc"];
                    $category=$value["category"];
                    if (move_uploaded_file($value["tmp_name"], $target)) {
                        resize_image('max',$target,$thumb2,100,100);
                        resize_image('max',$target,$thumb1,50,50);
                        $image=array(
                            "full"=>$target,
                            "100"=>$thumb1,
                            "200"=>$thumb2,
                        );
                        $image=json_encode($image);
                        $sql = "INSERT INTO images (image,ghichu,chatlieu,soluong,idsp,dongia, image_text,kichthuoc,category) VALUES ('$image','$ghichu','$chatlieu','$soluong','$idsp','$dongia','$image_text','$kichthuoc','$category')";
                        $temp=confirm_query($sql);
                    }                  
                    
                }
                $q1="select id from file where ten='{$ten}' and date1='{$date1}' limit 1";
                $r1=confirm_query($q1);
                $sl=mysqli_num_rows($r1);
                $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC);
                $id=$kq1["id"];
                $url="edit.php?id=".$id."&tb=add";
                redirect_to($url); 
            }
           
}
?>

<?php
include "footer.php";
?>        

    </body>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#addmore").click(function(){
                $.get("inc/image.php", function(data){
                    $(".images").append(data);
                });
               
            });
            $( document ).on( "click", "body .delete", function(){
                $(this).parent().remove();
            })
        })
    </script>
</html>