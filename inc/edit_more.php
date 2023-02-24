<?php
  if (isset($data["parent"]) and $data["parent"]>1 ) {
        $qa="select * FROM file inner join user on file.iduser=user.iduser left Join khachhang ON file.idkh = khachhang.idkh where id=".$data['parent'];
        $ra=confirm_query($qa);
        $sl=mysqli_num_rows($ra);
        if($sl > 0){
        $kqa = mysqli_fetch_array($ra,MYSQLI_ASSOC); 
          echo '- Đơn hàng này được làm thêm từ đơn hàng <a href="edit.php?id='.$kqa["id"].'">'.$kqa["ten"].'</a>' ;
          echo "<hr>";
        }
  }
  

  if (isset($data["parent"]) and $data["parent"]>0) {
    $parent=" and file.parent !=".$data["parent"];
  }else $parent="";
  $qa="select * FROM file inner join user on file.iduser=user.iduser left Join khachhang ON file.idkh = khachhang.idkh where file.ten like '".$data['ten']."' and file.id !=".$data["id"].$parent;
        $ra=confirm_query($qa);
        $sl=mysqli_num_rows($ra);
        if($sl > 0){
          echo "Các đơn hàng có thể liên quan: <br>";
          $i=1;
          while($kqa = mysqli_fetch_array($ra,MYSQLI_ASSOC)){
            
              echo '-'.$i.' <b><a href="edit.php?id='.$kqa["id"].'">'.$kqa["ten"].'</a></b> Tạo lúc: '.$kqa["date2"].'<br>' ;
              $i++;                             
          } 
          echo "<hr>";
        }
        ?>