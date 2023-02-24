<?php
$title="Edit";
include "header.php";
$ac="";
if ($admin["cap"]>=3) { $ac="block"; }
if (isset($admin["block"]["adr"])) { $ac="block"; }
if (isset($_GET["id"])) {
    $id=$_GET["id"]; 
    $q1="select * FROM file inner join user on file.iduser=user.iduser left Join khachhang ON file.idkh = khachhang.idkh where id=$id";
    $data=get_file(array("file.id"=>$id));
    if(count($data)==1){$data=$data[0];}
}
if ($data["iduser"]==$admin["iduser"]) { $ac="ac"; }
if ($ac=="block") { echo "Not Thing"; exit();}
?>
<style type="text/css">
    .bill_sm {
        font-size: 20px;
    }
    .bill_sm b {
        font-size: 30px;
    }
</style>
    <body>
        <?php
         include "menu.php";
         if (isset($data)):
            $readonly="";
            if ($admin["chucvu"]=="Admin") {
                $readonly="";
                }elseif (strtotime(($data['cr_date1']) . "+1 days") < time()){ 
                $readonly="readonly";
                echo '<div class="wrapper"><div class="container-fluid"> <h4 class="red"> 
                Đơn này rơi vào tình trạng khóa ! <br> 
                Bạn sẽ bị hạn chế chỉnh sửa ở một số trường !. <br 
                </h4>Liên hệ Admin để chỉnh sửa, nếu bạn nghĩ nó là cần thiết.!</div></div>';
                }
            include "inc/module_edit.php";
            endif ?>       
        <?php
        include "footer.php";
        ?>
       <script type="text/javascript">
        $(document).ready(function(){
            $("body #addmore").click(function(){
                $.get("inc/image.php", function(data){
                    $(".images").append(data);
                });
               
            });
            $( document ).on( "click", "body .delete", function(){
                $(this).parent().remove();
            })
             $( document ).on( "click", "body .deleteimage", function(){
                $v=$(this).attr("id");
                $v='<input name="deleteimage[]" style="display:none" value="'+$v+'">';
                $(this).parent().remove();
                $(".images").append($v);
            })

        })
    </script>
    </body>
</html>