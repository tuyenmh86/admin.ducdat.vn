<?php
    if (!isset($datachatlieu)) {
        include "../function.php";
    }
?>
<div class="row">
    <div class="delete">X</div>
    <div class="col-6">
        <input type="file" name="image[]">
    </div>

    <div class="col-3">
        <input required="" class="form-control" placeholder="Số Lượng" type="number" name="soluong[]">
    </div>
    <div class="col-3">
        <input required="" class="form-control" placeholder="Đơn Giá" type="number" name="dongia[]">
    </div>
    <div class="col-3">
        <select required class="form-control" name="category[]">
        <option value="">Loại SP</option>
        <?php
            foreach ($datacategory as $key => $value) {
                ?>
                <option value="<?=$value?>"><?=$value?></option>
        <?php
            }
        ?>
        </select>
    </div>
    <div class="col-3">
        <select required class="form-control" name="chatlieu[]">
        <option value="">Chất liệu</option>
        <?php
            foreach ($datachatlieu as $key => $value) {
                ?>
                <option value="<?=$value?>"><?=$value?></option>
        <?php
            }
        ?>
        </select>
    </div>
    <div class="col-6">
        <input required="" class="form-control" placeholder="Kích thước ví dụ (180x130)" type="text" name="kichthuoc[]">
    </div>
    <div class="col-12">
        <input class="form-control" placeholder="Ghi chú" type="text" name="ghichu[]">
    </div>
</div>