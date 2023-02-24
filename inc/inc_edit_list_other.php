<div class="row itlist">
    <div id="<?=$data["id"]?>" class="delete deleteimage">X</div>
    <div class="col-5">
       <?php echo '<div class="thumbnail-lage"><img src="'.$value["image"]["full"].'"></div>';?>
    </div>
   
    <div class="col-7">
        <div class="row">
            <div hidden class="col-4">Đơn Giá</div>
            <div hidden class="col-8"><input <?=$readonly?> class="form-control" placeholder="Đơn Giá" type="number" value="<?=$value["dongia"]?>" name="editdongia[]"></div>

            <div hidden class="col-4">Số lượng</div>
            <div hidden class="col-8"><input <?=$readonly?> class="form-control" placeholder="Số lượng" type="number" value="<?=$value["soluong"]?>" name="editsoluong[]"></div>
            <div class="col-4">Loại</div>
            <div class="col-8">
                <select <?=$readonly?> class="form-control" name="editcategory[]">
                    <option value="">Loại SP</option>
                        <?php foreach ($datacategory as $k => $v) { ?>
                                <option <?=$value["category"]==$v?"selected":""?> value="<?=$v?>"><?=$v?></option>
                        <?php } ?>                                                    
                </select>     
            </div>
            <div hidden class="col-4">Chất liệu</div>
            <div hidden class="col-8">
                <select <?=$readonly?> class="form-control" name="editchatlieu[]">
                    <option value="">Chất liệu</option>
                    <?php foreach ($datachatlieu as $k => $v) {?>
                        <option <?=$value["chatlieu"]==$v?"selected":""?> value="<?=$v?>"><?=$v?></option>
                    <?php } ?>                                                    
                </select>
            </div>
            <div hidden class="col-4">Kích thước</div>
            <div hidden class="col-8">
                <input <?=$readonly?> required  class="form-control" value="<?=$value["kichthuoc"]?>"  type="text" name="editkichthuoc[]">
            </div>

            <div class="col-4">Ghi chú</div>
            <div class="col-8">
                <textarea <?=$readonly?> class="form-control" name="editghichu[]"><?=$value["ghichu"]?></textarea>
            </div>                            
        </div>     
      <input <?=$readonly?> type="number" class="hidden" name="editimage[]" value="<?=$value["id"]?>">
    </div> <!-- End col 7 -->
</div>  