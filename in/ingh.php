<?php
     include "../function.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>ĐH
            <?php
             if (isset($_GET["date"])) {
                 $d=$_GET["date"];
             }else{
                exit();
                echo "Trang không tìm thấy";
             }
             echo $d;
            ?>
    </title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="css.css" rel="stylesheet">
  <script src="js.js"></script>
</head>
<body>

    <div class="wapper tonho">
         <?php
         $data=get_file("where  date1='{$d}'");
         foreach ($data as $key => $value): ?>
          <div class="item row">
              <div class="col-md-6">
                  <div class="row list" style="padding-left: 20px;">                  
                             <?php foreach ($value["list_product"] as $k => $v): ?>
                               <div class="sp" style="width: auto">                        
                                      <div class="sl"><b><?=$v["soluong"]?></b> </div>
                                      <div class="img"><img style="max-width: <?=650/count($value["list_product"]);?>px" src="../<?=$v["image"]["full"]?>"></div>
                              </div>
                             <?php endforeach ?>                             
                              <div class="if"><?=$value["name"]."  ".$value["date1"]?></div>                   
                  </div>
              </div>
              <div class="col-md-6 info">
                  <div class="del"> --> Xóa</div>
                  <div class="clone">Nhân bản <-- </div>                  
                  <ul>
                      <li><i>Người nhận:</i> <b style="font-size: 18px"><?=$value["nguoinhan"]?></b> <b style="color: red"><?=$value["sodt"]?></b></li>
                      <li><i>ĐC:</i> <b><?=$value["diachi"]?></b></li>
                      <?php
                          if (count($value["yeucau"])>=1) {
                              echo ' <li style="font-size:16px;" ><i>Yc:</i><red>'.str_replace("Ẩn giá", "Ag", implode(",", $value["yeucau"])).'</red></li>';
                          } 
                          if (strlen($value["ghichu"])>=2) {
                              echo ' <li style="font-size:16px;"><i>Ghi Chú:</i>'.strip_tags($value["ghichu"]).'</li>';
                          }                          
                       ?>
                  </ul>
              </div>     
          </div>           
         <?php endforeach ?>
    </div>
</body>

</html>