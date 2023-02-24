 <?php include "function.php"; if ($admin[ "cap"]>=3) { redirect_to(); }
 if(isset($_GET[ "view"])&& filter_var($_GET[ 'view'], FILTER_VALIDATE_INT, array( 'min_range'=> 1))){ 
 $data=array();
 if (isset($_POST["st"]) and isset($_POST["end"]) and $_POST["st"]>0 and $_POST["end"]>0 and ($_POST["end"]>$_POST["st"])) {
    $st=date_format(date_create($_POST["st"]),"Y-m-d");
    $end=date_format(date_create($_POST["end"]),"Y-m-d");
    $q1="where file.date1>='".$st."' and file.date1<='".$end."' and file.idkh=".$_GET[ "view"]." and file.type not like 'Sửa lỗi' and file.ttthanhtoan not like 'Đã Thanh Toán' ";
    $title=date_format(date_create($_POST["st"]),"d-m-Y")."_".date_format(date_create($_POST["end"]),"d-m-Y");
    $time="Đơn hàng từ ngày <b>".date_format(date_create($_POST["st"]),"d-m-Y")."</b> đến ngày <b>".date_format(date_create($_POST["end"]),"d-m-Y")."</b>";
  
  }else{  $q1=" where file.idkh=".$_GET[ "view"];
      $title="(all)"; 
      $time="Tất cả đơn hàng";
    }
 
 $data=get_file($q1);
 $data_kh=get_vip($_GET["view"]);$data_kh=$data_kh[0];
 $totals=0;
 $vats=0;
}else exit();
?>

<!DOCTYPE html>
<html>
<title><?=$title?></title>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<style type="text/css">
    .noselect {
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
    }

    ul li {
        list-style: none;
    }
    
    body ul {
        padding: 0px;
        margin: 0px;
    }
    red{
        color: red;
    }
    green{
        color: green;
    }
    .bgred{
        background: red;
    }
    .menu{
        background: #ccc;
    }
    td img{
        width: 40px;
    }

    @media print {
    .tp{
        display: none;
    }
    .menu{
        display: none;
    }
    a[href]::after {
        content: none !important;
    }    
    }
    td{
        vertical-align: middle !important;
    }
    .font-12{
        font-size: 12px;
    }
</style>
<body>   
    <div class="wrapper noselect">
        <div class="container-fluid">           
            <div id="tong" class=" row">
                <div class="menu col-12">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-2">
                                <label >Ngày bắt đầu</label>
                                <input value="<?=isset($_POST["st"])?$_POST["st"]:""?>" type="date" class="form-control" name="st">
                              </div>
                              <div class="form-group col-2">
                                <label >Ngày Kết Thúc</label>
                                <input value="<?=isset($_POST["end"])?$_POST["end"]:""?>" type="date" class="form-control" name="end" >
                              </div>
                              <div class="form-group col-2">
                                <button type="submit" class="btn btn-primary">Cài đặt</button>
                              </div>
                        </div>                     
                    </form>
                </div>
                <div class="col-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Avatar</th>
                            <th>Người đại diện</th>
                            <th>Tên công ty</th>
                            <th>Số điện thoại</th>
                            <th>Mail</th>
                            <th>Địa chỉ</th>
                            <th>Thông tin MST</th>
                        </tr>
                        <tr>
                            <td><img style="width: 60px" src="<?=$data_kh["avatar"]?>"></td>
                            <td><b><?=$data_kh["tenkh"]?></b></td>
                            <td><b><?=$data_kh["tencty"]?></b></td>
                            <td><b><?=$data_kh["sodtkh"]?></b></td>
                            <td><b><?=$data_kh["mailkh"]?></b></td>
                            <td><b><?=$data_kh["diachikh"]?></b></td>
                            <td><?=$data_kh["vatkh"]?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="row">
            <div class="col-12">
                <h4><?=$time?></h4>
                 <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Phụ trách</th>
                                <th>Tên File</th>
                                <th>Ngày giao</th>
                                <th>Loại đơn hàng</th>
                                <th>Thanh toán</th>
                                <th>Hình ảnh</th>
                                <th>Danh mục</th>
                                <th>Chất liệu</th>
                                <th>Kích thước</th>
                                <th>Số lượng <small>(1)</small> </th>
                                <th>Đơn giá <small>(2)</small></th>
                                <th>Thành tiền <small>(3) = (1*2)</small> </th>
                                <th>Tổng đơn <small>(4)</small></th>
                                <th>VAT <small>(5)=(4*<?=$vatvalues*100?>%)</small></th>
                               
                            </tr>
                        </thead>
                         <tbody>
                            <?php foreach ($data as $key => $value){
                                $totals=$totals+$value["total"];
                                $vats=$vats+ $value["vat_value"];
                            ?>
                               
                                    <?php if (isset($value["list_product"]) and is_array($value["list_product"])) { foreach ($value["list_product"] as $k => $v){                                        
                                        $rowspan=count($value["list_product"]);
                                        if ($rowspan>0) { $rowspan='rowspan="'.$rowspan.'"';}else $rowspan=""; 
                                        if ($k==0) {
                                        if ($v["dongia"]<1000) { $w="bgred"; }else $w="";
                                    ?>
                                    <tr>
                                        <td <?=$rowspan?> ><?=$key+1;?></td>
                                        <td <?=$rowspan?> class="font-12" ><?=$value["name"]?></td>
                                        <td <?=$rowspan?> ><b><?=$value["ten"]?></b></td>
                                        <td <?=$rowspan?> ><?=$value["date1"]?></td>
                                        <td <?=$rowspan?> class="font-12"><?=$value["type"]?></td>
                                        <td <?=$rowspan?> class="font-12"><?=$value["ttthanhtoanview"]?></td>

                                        <td><img src="<?=$v["image"]["100"]?>"></td>
                                        <td class="font-12"><?=$v["category"]?></td>
                                        <td class="font-12"><?=$v["chatlieu"]?></td>
                                        <td class="font-12"><?=$v["kichthuoc"]?></td>
                                        <td><?=$v["soluong"]?></td>
                                        <td class="<?=$w?>"><?=number_format($v["dongia"])?></td>
                                        <td><?=number_format($v["sum"])?></td>


                                        <td <?=$rowspan?> ><b><?=number_format($value["total"]-$value["vat_value"]) ?></b></td>
                                        <td <?=$rowspan?> ><b><?=number_format($value["vat_value"]) ?></b></td>

                                        <td class="tp noselect" <?=$rowspan?> ><a href="edit.php?id=<?=$value["id"]?>">Edit</a></td>
                                    </tr>                                        
                                    <?php }else{ ?>
                                    <tr>
                                        <td><img src="<?=$v["image"]["100"]?>"></td>
                                        <td class="font-12"><?=$v["category"]?></td>
                                        <td class="font-12"><?=$v["chatlieu"]?></td>
                                        <td class="font-12"><?=$v["kichthuoc"]?></td>
                                        <td><?=$v["soluong"]?></td>
                                        <td class="<?=$w?>"><?=number_format($v["dongia"])?></td>
                                        <td><?=number_format($v["sum"])?></td>
                                    </tr>
                                   <?php }} ?>
                                                                
                            <?php }else{?>
                                     <tr>
                                        <td ><?=$key+1;?></td>
                                        <td  class="font-12" ><?=$value["name"]?></td>
                                        <td ><b><?=$value["ten"]?></b></td>
                                        <td ><?=$value["date1"]?></td>
                                        <td class="font-12"><?=$value["type"]?></td>
                                        <td class="font-12"><?=$value["ttthanhtoanview"]?></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="bgred"></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td class="tp noselect"><a href="edit.php?id=<?=$value["id"]?>">Edit</a></td>
                                    </tr>                                 
                            <?php }} ?>
                            <tr>
                                <td colspan="13" class="text-center"><b>Tổng </b></td>
                                <td colspan="1"><b><?php echo number_format($totals-$vats); ?></b></td>
                                <td colspan="1"><b><?php echo number_format($vats); ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="13" class="text-center"><b>Tổng cộng (Tổng + VAT)</b></td>
                                <td colspan="2" style="text-align: center;font-size: 30px"><b><?php echo number_format($totals); ?></b></td>
                            </tr>
                          </tbody>
                    </table>
            </div>
        </div>
    </div>

     

</body>

</html>