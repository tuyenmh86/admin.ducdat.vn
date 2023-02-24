<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<style type="text/css">
    ul li {
        list-style: none;
    }
    
    body ul {
        padding: 0px;
        margin: 0px;
    }
</style>
<body>
    <?php include "function.php"; if ($admin[ "cap"]>=3) { redirect_to(); } ?>
    <div class="wrapper">
        <div class="container-fluid">
            <?php if(isset($_GET[ "view"])&& filter_var($_GET[ 'view'], FILTER_VALIDATE_INT, array( 'min_range'=> 1))){
                $idkh=$_GET["view"];  
                $title="Tất cả đơn hàng";
                $q1="select * from file inner join user on file.iduser= user.iduser left join khachhang on file.idkh=khachhang.idkh where  file.idkh=$idkh ORDER BY `date1` desc LIMIT 0, 1000 ";

                if (isset($_GET["st"])) {
                    $title="Đơn hàng từ ngày <b>".date_format(date_create($_GET["st"]),"d/m/Y")."</b> đến ngày <b>".date("d/m/Y")."</b>";
                    $q1="select * from file inner join user on file.iduser= user.iduser left join khachhang on file.idkh=khachhang.idkh where file.date1>='".$_GET["st"]."' and file.idkh=$idkh ORDER BY `date1` desc LIMIT 0, 1000 "; 
                }
                if (isset($_GET["st"]) and isset($_GET["end"])) {
                    $title="Đơn hàng từ ngày <b>".date_format(date_create($_GET["st"]),"d/m/Y")."</b> đến ngày <b>".date_format(date_create($_GET["end"]),"d/m/Y")."</b>";
                    $q1="select * from file inner join user on file.iduser= user.iduser left join khachhang on file.idkh=khachhang.idkh where file.date1>='".$_GET["st"]."' and file.date1<='".$_GET["end"]."' and file.idkh=$idkh ORDER BY `date1` desc LIMIT 0, 1000 "; 
                }                
                
                $r1=confirm_query($q1); 
                $r=confirm_query($q1); 
                $sl=mysqli_num_rows($r1); 
                $tmp = mysqli_fetch_array($r1,MYSQLI_ASSOC); 
                if($sl > 0){ ?>
            <div id="tong" class="card-box row">
                <div class="col-12">
                    <h4>Các đơn hàng<?=" ".$title_thang?> của khách hàng : <?=$tmp["tenkh"]?> <?=$vipmember?></h4>
                </div>
                <ul>
                    <li>Tên công ty: <b><?=$tmp["tencty"]?></b>
                    </li>
                    <li>Đại diện: <b><?=$tmp["tenkh"]?></b>
                    </li>
                    <li>Số ĐT: <b><?=$tmp["sodtkh"]?></b>
                    </li>
                    <li>Địa chỉ: <b><?=$tmp["diachikh"]?></b>
                    <li><?=$title?></li>
                    </li>
                    <li>Tổng: <b><?=$sl;?> </b> Đơn hàng </li>
                </ul>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th style="width: 30%">Thông tin</th>
                            <th style="width: 60%">Chi tiết đơn hàng</th>
                            <th style="width: 10%">Ghi Chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; $tongtien=0; while ($v=mysqli_fetch_array($r,MYSQLI_ASSOC)) { $tmp="" ; if(isset($v[ "idkh"])&& filter_var($v[ "idkh"], FILTER_VALIDATE_INT, array( 'min_range'=> 1))){ $v["nguoinhan"]=$v["tenkh"]; $v["sodt"]=$v["sodtkh"]; $v["diachi"]=$v["diachikh"]; $v["vat"]=$v["vatkh"]; $tmp='
                        <img src="img/Crown.png">'; } ?>
                        <tr>
                            <?php if ( isset($stt)) { echo "<td style='max-width:10px'>".$stt. "</td>"; $stt++; } ?>
                            <td>
                                <ul class="info">
                                    <li> Lập đơn: <b><?=thedate($v["date2"],1)?></b> </li>
                                    <li> Ngày giao: <b><?=thedate($v["date1"],1)?></b> </li>
                                    <li>Tên File: <b><a style="color: black" href="edit.php?id=<?=$v["id"]?>"><?=$v["ten"];?></a> <?=$v["type"]?> </b>
                                    </li>
                                    <li>Phụ trách: <b><?=$v["name"]?></b>
                                    </li>
                                    <li><span>Y/c:</span>
                                        <?php $temp=explode( ",", $v[ "yeucau"]); foreach ($temp as $key=> $value) { if ($value=="VAT") { $vat=$value; } echo '<b class="badge badge-info">'.$value.'</b>&nbsp;&nbsp;'; } ?>
                                    </li>
                                    <li><span> Tình trạng:</span>
                                        <?php switch ($v[ "ttthanhtoan"]) { case 'Đã Thanh Toán': $cl="badge-success" ; break; case 'Đã Đặt Cọc': $cl="badge-warning" ; break; default: $cl="badge-danger" ; break; } echo '<b class="badge badge-info">'.$v[ "ptthanhtoan"]. '</b>&nbsp;&nbsp;'; echo '<b class="badge '.$cl. '">'.$v[ "ttthanhtoan"]. '</b>&nbsp;&nbsp;'; ?>
                                </ul>
                            </td>
                            <td>
                                <?php $qc1="select * from images where idsp={$v['id']}" ; $rc1=confirm_query($qc1); $sl=mysqli_num_rows($rc1); if($sl> 0){ while ($kq1 = mysqli_fetch_array($rc1,MYSQLI_ASSOC)) {
                                     $dis=array("Ảnh mẫu","Miêu tả màu");
                                    if (!in_array($kq1["category"], $dis)) {
                                 $tong=$kq1["soluong"]*$kq1["dongia"]; $tongtien=$tongtien+$tong; ?>
                                <div class="clearfix">
                                    <div style="float: left;">
                                        <img style="min-height: 80px;max-width: 100px;" id="myImg" src="images/<?=$kq1["image"]?>">
                                    </div>
                                    <div>
                                        <ul>
                                            <li>Chất liệu: <b><?=$kq1["chatlieu"]?></b> KT: <b><?=$kq1["kichthuoc"]?></b></li>
                                            <li>Số lượng: <b><?=$kq1["soluong"]?></b></li>
                                            <li>Đơn giá: <b><?=number_format($kq1["dongia"]);?></b></li>
                                            <li>Thành tiền:<b><?=number_format($tong);?></b> </li>                                           
                                        </ul>
                                    </div>
                                </div>
                                <?php }}}else echo "Chưa có hình ảnh cho sản phẩm này!"; ?>

                            </td>
                            <td>
                                <?=$v[ "ghichu"];?>
                            </td>
                        </tr>

                        <?php }?>

                        <tr>
                            <td colspan="2">Tổng tiền (Tạm tính)</td>
                            <td colspan="2">
                                <?=number_format($tongtien)?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <?php } } ?>
        </div>
    </div>

</body>

</html>