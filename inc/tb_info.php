<table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>STT</th>
            <th style="width: 100px">Tên file</th>
            <th style="width: 200px">Người nhận</th>
            <th style="width: 200px" >Chi tiết</th>
            <th>Thành tiền</th>
            <th>VAT</th>
            <th>Tình trạng thanh toán</th>
            <th style="width: 100px">Ghi chú</th>
            <th style="width: 200px">Lịch Sử</th>
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
                <li><?=$value["diachi"]?></li>
            </ul>
        </td>
        <td>
            <ul>
                <?php if (isset($value["list_product"])) { foreach ($value["list_product"] as $k => $v){ ?>
                    <li><img src="<?=$v["image"][100]?>"> <?=$v["category"]?> </li>
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
        <td title="Ghi chú"><?php $value["ghichu"]?></td>
        <td title="Lịch sử công nợ" style="font-size: 12px;"><?=$value["congno"]?></td>
    </tr>
<?php endforeach ?>
      
    </tbody>
</table>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // Default Datatable
                $('#datatable').DataTable();
                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });
                // Key Tables
                $('#key-table').DataTable({
                    keys: true
                });
                // Responsive Datatable
                $('#responsive-datatable').DataTable();
                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });
                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );
        </script>

