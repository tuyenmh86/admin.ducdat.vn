<?php
$title="Hình ảnh";
include "header.php";
?>
<style type="text/css">
 .box{
    border: solid 1px #ccc; 
    text-align: center;
 }   

</style>
<body>
        <?php
         include "menu.php";
        ?>
        
        <div class="wrapper">
        
<div class="card-box table-responsive">
    <p>
        Ở đây hiển thị toàn bộ hình ảnh sản phẩm của các đơn hàng.
        Nhấn vào để xem chi tiết.
    </p>
<div id="container" class="clearfix">

    <div class="row">
        <?php
            $q1="select 
                images.image,
                images.soluong,
                images.image_text,
                images.idsp,
                file.ten
                from images inner join file on images.idsp =file.id
                ORDER BY `date1` desc";
                    $r1=confirm_query($q1);
                    $sl=mysqli_num_rows($r1);
                    if($sl > 0){
                    while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) {
                    $image=json_decode($kq1["image"],true);
                       ?>
                        <div class="box col-md-1">
                           <a href="edit.php?id=<?=$kq1["idsp"]?>"> <img  src="<?=$image[100]?>"></a>
                        </div>

                       <?php
                    }}
        ?>
        
  
    </div> <!-- End row -->

</div> <!-- #container -->   

</body>

<script src="assets/js/jquery.masonry.min.js"></script>


</html>
