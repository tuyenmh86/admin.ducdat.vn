<div class="row itlist">
    <div id="<?=$data["id"]?>" class="delete deleteimage">X</div>
    <div class="col-5">
       <?php echo '<div class="thumbnail-lage"><img src="'.$value["image"]["full"].'"></div>';?>
    </div>
   
    <div class="col-7">
        <div class="row">
            <div class="col-4">Đơn Giá</div>
            <div class="col-8"><input class="form-control" placeholder="Đơn Giá" type="number" value="<?=$value["dongia"]?>" name="editdongia[]"></div>

            <div class="col-4">Số lượng</div>
            <div class="col-8"><input class="form-control" placeholder="Số lượng" type="number" value="<?=$value["soluong"]?>" name="editsoluong[]"></div>
            <div class="col-4">Loại</div>
            <div class="col-8">
                <select class="form-control" name="editcategory[]">
                    <option value="">Loại SP</option>
                        <?php foreach ($datacategory as $k => $v) { ?>
                                <option <?=$value["category"]==$v?"selected":""?> value="<?=$v?>"><?=$v?></option>
                        <?php } ?>                                                    
                </select>     
            </div>
            <div class="col-4">Chất liệu</div>
            <div class="col-8">
                <select class="form-control" name="editchatlieu[]">
                    <option value="">Chất liệu</option>
                    <?php foreach ($datachatlieu as $k => $v) {?>
                        <option <?=$value["chatlieu"]==$v?"selected":""?> value="<?=$v?>"><?=$v?></option>
                    <?php } ?>                                                    
                </select>
            </div>
            <div class="col-4">Kích thước</div>
            <div class="col-8">
                <input required  class="form-control" value="<?=$value["kichthuoc"]?>"  type="text" name="editkichthuoc[]">
            </div>

            <div class="col-4">Ghi chú</div>
            <div class="col-8">
                <textarea class="form-control" name="editghichu[]"><?=$value["ghichu"]?></textarea>
            </div>
            
            <?php if ($admin["chucvu"]=="Admin"):  ?>
            <div class="col-4">Chọn mẫu</div>
            <div class="col-8">
                <select <?=$readonly?> class="form-control" name="editmau[]">
                    <option value="">none</option>
                    <option <?=$value["mau"]=="Mẫu"?"selected":"";?> value="Mẫu">Chọn mẫu</option>                     
                </select>     
            </div>
            <?php endif ?>                                            
        </div>
     
      <input type="number" class="hidden" name="editimage[]" value="<?=$value["id"]?>">
    </div> <!-- End col 7 -->
</div>  