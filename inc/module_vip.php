<div class="col-12 text-center">
   <h4>Danh sách khách hàng thân thiết</h4>
</div>
<table  class="table table-bordered">
<thead>
    <tr>
        <th>Ảnh đại diện</th>
        <th>Tên người đại diện</th>
        <th>Tên cty</th>
        <th>Số điện thoại</th>
        <th>Mail</th>
        <th>Địa chỉ</th>
        <th>Thông tin VAT</th>
        <th>Ghi Chú</th>
        <th width="40px">Action</th>
    </tr>
</thead>
<tbody>
    <?php $data=get_vip("all"); if (is_array($data)) {
        foreach ($data as $key => $value) {?>
            <tr>
                <td><img width="40px" class="rounded-circle" src="<?=$value["avatar"]?>"></td>
                <td><a href="vip.php?view=<?=$value["idkh"]?>#tong"><?=$value["tenkh"]?></a></td>
                <td><?=$value["tencty"]?></td>
                <td><?=$value["sodtkh"]?></td>
                <td><?=$value["mailkh"]?></td>
                <td><?=$value["diachikh"]?></td>
                <td><?=$value["vatkh"]?></td>
                <td><?=$value["ghichukh"]?></td>
                <td>
                    <ul>
                        <li><a href="editkh.php?id=<?=$value["idkh"]?>"><i class="far fa-edit"></i></a></li>
                        <br>
                        <li><a href="vippdf.php?view=<?=$value["idkh"]?>#tong">Xuất PDF</a></li>
                    </ul>
                </td>
            </tr>
    <?php }} ?>
</tbody>
</table>