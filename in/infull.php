<?php 
if (isset($_GET["id"])) {  $id=$_GET["id"]; include "../function.php";}
if (isset($_POST["id"])) {  $id=$_POST["id"]; }
if ($id) {    
    $data=get_file(array("file.id"=>$id));
    if (isset($data[0])) {
      $data=$data[0];
    }
}else{
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>GH-<?=$data["ten"]?></title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="css.css" rel="stylesheet">
  <script src="js.js"></script>
</head>
<body>
  <div class="menu">
    <ul>
      <li class="active" idd="tolon"><a href="infull.php?id=<?=$data["id"]?>">Tờ lớn</a></li>
      <li idd="tonho"><a href="infull.php?id=<?=$data["id"]?>&page=mini">Tờ nhỏ</a></li>
    </ul>
  </div>
  <?php if (isset($_GET["page"]) and $_GET["page"]=="mini") { ?> 

    <div class="page tonho">
        <div class="item row">
            <div class="col-md-6">
                <div class="row list" style="padding-left: 20px;">                  
                           <?php foreach ($data["list_product"] as $k => $v): ?>
                             <div class="sp" style="width: auto">                        
                                    <div class="sl"><b><?=$v["soluong"]?></b> </div>
                                    <div class="img"><img style="max-width: <?=650/count($data["list_product"]);?>px" src="../<?=$v["image"]["full"]?>"></div>
                            </div>
                           <?php endforeach ?>                             
                            <div class="if"><?=$data["name"]."  ".$data["date1"]?></div>                   
                </div>
            </div>
            <div class="col-md-6 info">
                <div class="del"> --> Xóa</div>
                <div class="clone">Nhân bản <-- </div>                  
                <ul>
                    <li><i>Người nhận:</i> <b style="font-size: 18px"><?=$data["nguoinhan"]?></b> <b style="color: red"><?=$data["sodt"]?></b></li>
                    <li><i>ĐC:</i> <b><?=$data["diachi"]?></b></li>
                    <?php
                        if (count($data["yeucau"])>=1) {
                            echo ' <li style="font-size:16px;" ><i>Yc:</i><red>'.str_replace("Ẩn giá", "Ag", implode(",", $data["yeucau"])).'</red></li>';
                        } 
                        if (strlen($data["ghichu"])>=2) {
                            echo ' <li style="font-size:16px;"><i>Ghi Chú:</i>'.strip_tags($data["ghichu"]).'</li>';
                        }                          
                     ?>
                </ul>
            </div>     
        </div>           
    </div>

  <?php }else{ ?>

    <div class="page tolon">
    <style type="text/css">@page {size: landscape}</style>
    <div class="right">
        <div class="tt" contenteditable="true">
            <div><i>Người nhận:</i> <b><?=$data["nguoinhan"]?></b> --- <b><?=$data["sodt"]?></b></div>
            <div><i>Địa chỉ:</i> <b><?=$data["diachi"]?></b></div>
        </div>
        <div class="cap" contenteditable="true">
          XIN NHẸ TAY <br> <span>HÀNG RẤT DỄ VỠ</span> <br> XIN CẢM ƠN !!!.
        </div>
        <div class="tt3" contenteditable="true">
          <i>Người gửi:</i> <b>CÔNG TY TNHH MTV SẢN XUẤT TMDV ĐỨC ĐẠT</b> <br>
          <i>LH Người gửi:</i>  <b>0902.744.686 - <?=$data["phone"]?></b>
        </div>
      </div>
      <div class="left">
          <?php foreach ($data["list_product"] as $key => $value): ?>
             <div class="item">
               <img src="../<?=$value['image']["full"]?>">
               <p><b style="font-size: 24px;"><?=$value["soluong"]?></b></p>
             </div>
          <?php endforeach ?>
          <?php if ($data["shiper"]=="Bưu Điện") {?>
            <div style="display: inline-block; padding-top: 5px;" class="text_left">
              <p style="font-size: 20px" class="text_left"><b>Thu Hộ</b> </p>
              <p style="font-size: 20px;" class="text_left"><b style="font-size: 30px;" ><?php echo  number_format($data["tongthanhtoan"]);?> </b> <?php if (!in_array("Free Ship", $data["yeucau"])) {echo "+ Ship";} ?></p>
            </div>
          <?php } ?>
      </div>
    </div>

  <?php } ?>  
  
  
  
</body>
</html>