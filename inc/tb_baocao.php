<table class="table table-bordered table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>STT</th>
            <th style="width: 100px">Tên file</th>
            <th>Người nhận</th>
            <th style="width: 500px;" >Chi tiết</th>
            <th>Thành tiền</th>
            <th>VAT</th>
            <th>Tình trạng thanh toán</th>
            <th style="width: 200px">Ghi chú</th>
            <th style="width: 500px">Lịch Sử</th>
        </tr>
    </thead>
    <tbody>
   <?php $tong=0;$tongvat=0; $tongcoc=0; foreach ($tmp_dt as $key => $value): $tongcoc=$tongcoc+$value["datcoc"]; ?>                                            
    <tr>
        <td><?=$key;?></td>
        <td>
            <ul>
                <li>File: <?=$value["tenlink"]?></li>
                <li>Loại: <?=$value["type"]?></li>
                <li>Ngày Giao: <?=$value["date1"]?></li>
                <li>Phụ trách: <?=$value["name"]?></li>
            </ul>
        </td>
        <td>
            <ul>
                <li><?=$value["sodt"]?></li>
                <li><?=$value["mail"]?></li>
                <li><?=$value["tenkhview"]?></li>
            </ul>
        </td>
        <td>
            <ul>
                <?php if (isset($value["list_product"])) { foreach ($value["list_product"] as $k => $v){ ?>
                    <li><img src="<?=$v["image"][100]?>"> <?=$v["soluong"]." x ".number_format($v["dongia"])." = ".number_format($v["sum"])?> </li>
                <?php }} ?>
            </ul>
        </td>
        <td title="Tổng">
            <b><?=number_format($value["sum"]);$tong=$tong+$value["sum"];?></b>
        </td>
        <td title="VAT">
            <b><?=number_format($value["vat_value"]); $tongvat=$tongvat+$value["vat_value"];?></b>
        </td>        
        <td>
            <?=$value["ttthanhtoanviews"]?>
        </td>
        <td title="Ghi chú"><?=$value["ghichu"]?></td>
        <td title="Lịch sử công nợ" style="font-size: 12px;"><?=$value["congno"]?></td>
    </tr>
<?php endforeach ?>
        <tr>
           <td style="font-size: 20px; font-weight: bold;" colspan="4">Tổng</td> 
           <td style="font-size: 30px; font-weight: bold;" colspan="1"><?=number_format($tong);?></td> 
           <td style="font-size: 30px; font-weight: bold;" colspan="1"><?=number_format($tongvat);?></td>
           <td colspan="4"></td> 
        </tr>
        <tr>
           <td style="font-size: 20px; font-weight: bold;" colspan="4">Tổng Cả VAT <?=$vatvalues*100?>%</td> 
           <td style="font-size: 30px; font-weight: bold;" colspan="2"><?=number_format($tongvat+$tong);?></td>
           <td colspan="4"></td> 
        </tr>
        <tr>
           <td style="font-size: 20px; font-weight: bold;" colspan="4">Đã thu cọc</td> 
           <td style="font-size: 30px; font-weight: bold;" colspan="2"><?=number_format($tongcoc);?></td>
           <td colspan="4"></td> 
        </tr>
    </tbody>
</table>