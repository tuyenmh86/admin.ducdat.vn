<?php
    $title="Trang chủ";
    if (isset($_GET["viewme"]) and $_GET["viewme"]=="true") {$title="Đơn hàng cá nhân";} 
    include "header.php";

    if ($admin["cap"]==4) {
    // Name: Min => dán đóng hàng
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        include "view.php";
        exit ();
    }
     if ($admin["cap"]==5) {
        // Ms Lan => Member 
        redirect_to("member.php");
        exit ();
    }
?>

<body>
    <?php include "menu.php";?>
    <div class="wrapper bd"> <span style="text-align: center;display: block; margin-top: 30px; font-size: 30px">Đang tải....</span> </div>
    <!-- end wrapper -->
<?php  if ($admin["cap"]==0) {?>
<div style="position: fixed;bottom: 0px;right: 0px;"  id="realtime" class="realtime"> </div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".realtime").load("realtime.php");
        setInterval(function(){
            $(".realtime").load("realtime.php");
        }, 6000);
    })
</script>
<?php  }?>

<script type="text/javascript">
    $(document).ready(function(){        
        var url="<?=isset($_GET["viewme"])?"realtime_body.php?viewme=true":"realtime_body.php"?>";
        $(".bd").load(url);
        setInterval(function(){
            $(".bd").load(url);
        }, 6000);
    })
</script>
<?php include "footer.php";?>       
    </body>
</html>