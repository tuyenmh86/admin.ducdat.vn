<style>
.bill_sm td{
    text-align: center;
    vertical-align: middle;
}
.bill_sm b{
    font-size: 18px;
}
</style>
<div class="container-fluid">
    <?php
    include "function.php";
    $data1=array();
    $date= new DateTime($now);
    date_modify($date, "-10  day");
    $date=date_format($date, "Y-m-d  h:i:s");
    if (isset($_GET["viewme"]) and $_GET["viewme"]=="true") {
        $where=" file.iduser=".$admin["iduser"]." and";
        echo "<h2>Đơn hàng cá nhân !</h2>";
    }else{
        $where="";
    }
    if (isset($_GET["type"])=="kd" and $admin["chucvu"]=="Admin") {
       $q1=" where ".$where."  file.date1 > '$date' and kiemduyet is null";
    }else {
       $q1=" where ".$where."  file.date1 > '$date'"; 
    }
    
    $data=get_file($q1);
    foreach ($data as $key => $value) {
        $data1[$value["cr_date1"]][]=$value;
         $datafull[$value["cr_date1"]][]=$value;
          if ($value["cr_date1"]=="0000-00-00") {
                $spcho[]=$value;
            }
    }
    ?>            
<form action="in/indonhang.php" method="post">
   <nav class="nav-its">
        <?php
            foreach ($data1 as $key => $value) {
                $cl=md5($key);
                                          
                echo '<a href="#'.$cl.'">'.date_format(date_create($key),"d/m").'('.count($value).')'.'</a>';
            }
        ?>               
    </nav>             
         <?php
         if (isset($datafull)) {                        
            foreach ($datafull as $key => $value) {
                $tmp=$value;
                if ((strtotime("now")-strtotime($key))<=545){
                    $cl="ribbon-danger";
                }else $cl='ribbon-custom';

                ?>
            <section id="<?=md5($key)?>">
                <div class="card-box ribbon-box holiday">
                    <div class="ribbon <?=$cl?>">Đơn hàng ngày : <b><?=date_format(date_create($key), "d-m-Y");?></b> <-> <a style="color: #000;" target="_blank" href="in/ingh.php?date=<?=$key?>"><i style="color: #000" class="fas fa-print"></i> IN Giấy Hàng </a> </div>
                    <div class="clear">   </div>
                    <div class="dhdate">
                        <?php foreach ($tmp as $k => $v): ?>
                        <?php  include "inc/div_admin.php"; ?>
                        <?php endforeach ?>
                    </div>
                </div>
             </section>
        <?php }}else {echo "Bạn không có đơn hàng nào !";} ?>                  
    </form>
</div> <!-- end container -->
