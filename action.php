<?php
$m='<script type="text/javascript">window.close();</script>';
include "function.php";
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case 'kiemduyet':
                echo "kiểm duyệt";
                if ($admin["chucvu"]=="Admin") {
                   $id=$_GET["id"];
                   $n=$admin["name"];
                   $d=date("g:i a - d/m/y");
                   $q = "UPDATE file SET kiemduyet='K.Duyệt Bởi {$n} Lúc: {$d}' where id='{$id}'";
                   $kq=confirm_query($q);
                }          
                break;
            case 'tt':
              if (isset($_POST["id"])) {                
                $tmp=$_POST["id"];
                $q="";
                foreach ($tmp as $key => $value) {
                  if ($key>0) {$value=",".$value;}
                  $q=$q.$value;
                }
                $query="UPDATE file SET ttthanhtoan='Đã Thanh Toán' where id in(".$q.")";
                $kq=confirm_query($query);
                redirect_to("vip.php");
              }
              
              break;

              case 'delimg':
                echo $_GET["name"];
                $link="img/".$_GET["name"];
                if (file_exists($link)){
                 unlink($link); 
                }
                $url="user.php";
                redirect_to($url);                
                break;

              

              case 'shiper':
                $id=$_GET["id"];
                $name=$_GET["name"];
                $q = "UPDATE file SET shiper='{$name}' where id='{$id}'";
                $r1=confirm_query($q);
                if (mysqli_affected_rows($dbc)==1) {
                  echo "Đã chỉnh sửa Shiper thành: ".$name;
                }else{
                  echo "Thay đổi không thành công";
                }
                break;

              case 'order_hop':
                $id=$_GET["id"];
                $q = "UPDATE file SET hop='{$admin["name"]}' where id='{$id}'";
                $r1=confirm_query($q);
                if (mysqli_affected_rows($dbc)==1) {
                  echo "Đã đặt hộp";
                }else{
                  echo "Thay đổi không thành công";
                }
                break;

              case 'edit':
              $id= $_POST["id"];
              $data_file=get_file(array("file.id"=>$id));
              $deleteimage = array();
              if (isset($data_file[0]["list_all"]) and count($data_file[0]["list_all"])>1) {
                foreach ($data_file[0]["list_all"] as $key => $value) {
                  if (!in_array($value["id"], $_POST["editimage"])) {
                    $deleteimage[]=$value["id"];
                  }
                }
              }
              if (count($deleteimage)>=1) {
                $q = "DELETE FROM images WHERE id IN (".implode(",", $deleteimage).")";
                $r=confirm_query($q);
              }
              $q1="select * FROM file inner join user on file.iduser=user.iduser left Join khachhang ON file.idkh = khachhang.idkh where id=$id";
              $r1=confirm_query($q1);
              $sl=mysqli_num_rows($r1);
              $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC);
              $kq1["his"]=json_decode($kq1["his"]); 
              
              if (isset($_POST["bn"])) {
                $data=get_file(array("file.id"=>$id));$data=$data[0];
                include "in/biennhan.php";
              }

              if (isset($_POST["gh"])) {
                include "in/infull.php";
              }

              if (isset($_POST["hd"])) {
                $data=array(
                  "nguoinhan"=>$_POST["nguoinhan"],
                  "diachi"=>$_POST["diachi"],
                  "date1"=>$_POST["date1"],
                  "sodt"=>$_POST["sodt"],
                  "datcoc"=>$_POST["datcoc"],
                  "sums"=>0,
                  "vat"=>0
                );
                foreach ($_POST["editcategory"] as $key => $value) {
                  $sum=$_POST["editdongia"][$key]*$_POST["editsoluong"][$key];
                  if ($sum>0) {
                    $data["list"][]=array(
                      "category"=>$value,
                      "dongia"=>$_POST["editdongia"][$key],
                      "soluong"=>$_POST["editsoluong"][$key],
                      "sum"=>$sum,
                    );
                    $data["sums"]+=$sum;
                  }                  
                }
                if (isset($_POST["category"])) {
                  foreach ($_POST["category"] as $key => $value) {
                    $sum=$_POST["dongia"][$key]*$_POST["soluong"][$key];
                    if ($sum>0) {
                      $data["list"][]=array(
                        "category"=>$value,
                        "dongia"=>$_POST["dongia"][$key],
                        "soluong"=>$_POST["soluong"][$key],
                        "sum"=>$sum,
                      );
                      $data["sums"]+=$sum;
                    }                  
                  }
                }
                if (isset($_POST["yeucau"]) and array_search("VAT",$_POST["yeucau"])!==false) {
                  $data["vat"]=$data["sums"]*$vatvalues;
                }else $data["vat"]=0;

                $data["total"]=$data["vat"]+$data["sums"]-$data["datcoc"];

                include "in/hoadon.php";
              }

              if (isset($_POST["pt"])) {
                include "in/phieuthu.php";
              }
                if(isset($_POST["submit"])){
                                    $kq1["his"][]=$admin["name"]." ".date("g:i a - d/m/y");

                                    $ten = post("ten");
                                    $tb="Sửa: ".'<b>'.$ten.'</b>';
                                    thongbao($tb,"orange");
                                    $nguoinhan = post("nguoinhan");
                                    $sodt = post("sodt");
                                    $diachi = post("diachi");
                                    $mail=post("mail");
                                    $ghichu = post("note");
                                    $ptthanhtoan = post("ptthanhtoan");
                                    $ttthanhtoan = post("ttthanhtoan");
                                    $vat = post("vat");
                                    $yeucau= post("yeucau");$yeucau=json_encode($yeucau, JSON_UNESCAPED_UNICODE);
                                    $postidkh=post("idkh");
                                    $shiper=post("shiper");
                                    $his=json_encode($kq1["his"], JSON_UNESCAPED_UNICODE);
                                    $q="select * from khachhang where idkh=".$postidkh;
                                    $r=confirm_query($q);
                                    $sl=mysqli_num_rows($r);

                                    if (mysqli_num_rows($r)>=1) {
                                     $kq = mysqli_fetch_array($r,MYSQLI_ASSOC);
                                     if ($nguoinhan=="" or strlen($nguoinhan)<1) {
                                       $nguoinhan=$kq["tenkh"];
                                     }
                                     if ($sodt=="" or strlen($sodt)<1) {
                                       $sodt=$kq["sodtkh"];
                                     }
                                     if ($diachi=="" or strlen($diachi)<1) {
                                       $diachi=$kq["diachikh"];
                                     }
                                    }
                                    
                                    $type=post("type");
                                    $datcoc=post("datcoc");
                                    if (isset($_POST["congno"]) and strlen($_POST["congno"])>5) {
                                      $congno=$kq1["congno"]."[]".date("g:i a - d/m/y")."-".$admin["name"].": ".$_POST["congno"];
                                    }else{
                                      $congno=$kq1["congno"];
                                    }
                                    if ($kq1["ttthanhtoan"]!==$ttthanhtoan) {
                                      $congno=$kq1["congno"]."[]".date("g:i a - d/m/y")."-".$admin["name"].": Sửa đổi thành ".$ttthanhtoan;
                                    }
                                   

                                    if (isset($_POST["date1"])) {
                                      $date1=$_POST["date1"];
                                      $q = "UPDATE file SET congno='{$congno}', date1='{$date1}', ten='{$ten}', nguoinhan='{$nguoinhan}', sodt='{$sodt}', diachi='{$diachi}',mail='{$mail}', ghichu='{$ghichu}',yeucau='{$yeucau}',ptthanhtoan='{$ptthanhtoan}',ttthanhtoan='{$ttthanhtoan}',vat='{$vat}',idkh='{$postidkh}',type='{$type}',datcoc='{$datcoc}',shiper='{$shiper}',his='{$his}' where id='{$id}'";
                                    }else{
                                      $q = "UPDATE file SET congno='{$congno}', ten='{$ten}', nguoinhan='{$nguoinhan}', sodt='{$sodt}', diachi='{$diachi}',mail='{$mail}', ghichu='{$ghichu}',yeucau='{$yeucau}',ptthanhtoan='{$ptthanhtoan}',ttthanhtoan='{$ttthanhtoan}',vat='{$vat}',idkh='{$postidkh}',type='{$type}',datcoc='{$datcoc}',shiper='{$shiper}',his='{$his}' where id='{$id}'";
                                    }
                                         
                                  $kq=confirm_query($q);
                                  /*$deleteimage=post("deleteimage");
                                  if (is_array($deleteimage)) {
                                      foreach ($deleteimage as $key => $value) {
                                          $iddelete=$value;
                                          $q="SELECT * FROM `images` where id=$iddelete";
                                          $r=confirm_query($q);
                                          $kq1 = mysqli_fetch_array($r,MYSQLI_ASSOC); 
                                          if(mysqli_num_rows($r)> 0){
                                              $file="images/".$kq1["image"];
                                              //unlink($file);
                                              $q = "DELETE FROM images WHERE id = {$iddelete} LIMIT 1";
                                              $r=confirm_query($q);
                                          }
                                      }
                                      
                                  }*/
                                  
                                $editimage=post("editimage");
                                if (is_array($editimage)) {
                                    $editsoluong=post("editsoluong");
                                    $editdongia=post("editdongia");
                                    $editchatlieu=post("editchatlieu");
                                    $editghichu=post("editghichu");
                                    $editkichthuoc=post("editkichthuoc");
                                    $editcategory=post("editcategory");
                                    $mau=post("editmau");
                                        foreach ($editimage as $key => $value) {
                                            if ($admin["chucvu"]=="Admin") {
                                                $q="UPDATE images SET soluong='{$editsoluong[$key]}',dongia='{$editdongia[$key]}',chatlieu='{$editchatlieu[$key]}', ghichu='{$editghichu[$key]}',kichthuoc='{$editkichthuoc[$key]}',category='{$editcategory[$key]}',mau='{$mau[$key]}' where id='{$value}'";
                                            }else{
                                                $q="UPDATE images SET soluong='{$editsoluong[$key]}',dongia='{$editdongia[$key]}',chatlieu='{$editchatlieu[$key]}', ghichu='{$editghichu[$key]}',kichthuoc='{$editkichthuoc[$key]}',category='{$editcategory[$key]}' where id='{$value}'";
                                            }
                                            $r=confirm_query($q);
                                        }                                    
                                }
                                  
                                if (isset($_FILES['image'])) {
                                        $idsp=$id;
                                        //print_r( $_FILES['image']);
                                         $dataimg=array();
                                        foreach ($_FILES['image']['name'] as $key => $value) {
                                          $name=$value;
                                          $tmp_name=$_FILES['image']['tmp_name'][$key];
                                          $dataimg[]=array(
                                           "name" => $value,
                                           "tmp_name" => $tmp_name,
                                           "ghichu"=> $_POST["ghichu"][$key],
                                           "chatlieu" => $_POST["chatlieu"][$key],
                                           "category"=>$_POST["category"][$key],
                                           "soluong"=>$_POST["soluong"][$key],
                                           "dongia"=>$_POST["dongia"][$key],
                                           "kichthuoc"=>$_POST["kichthuoc"][$key]
                                          );
                                        }
                                        foreach ($dataimg as $key => $value) {
                                           if ($value["name"]!=="") {
                                                $ext = ".".pathinfo($value["name"], PATHINFO_EXTENSION);
                                                $image=get_name_image($kq1["ten"],$kq1["date1"],$ext);
                                                $folder="images/".date("Y/m");
                                                  if (!file_exists($folder)) {
                                                      mkdir($folder, 0777, true);
                                                  }
                                                // image file directory
                                                $target = $folder."/".$image;
                                                $thumb2=$folder."/thumb200_".$image;
                                                $thumb1=$folder."/thumb100_".$image; 
                                                $image_text = mysqli_real_escape_string($dbc, $value["name"]);
                                                $ghichu=$value["ghichu"];
                                                $chatlieu=$value["chatlieu"];
                                                $category=$value["category"];
                                                $soluong=$value["soluong"];
                                                $dongia=$value["dongia"];
                                                $kichthuoc=$value["kichthuoc"];                                       

                                                if (move_uploaded_file($value["tmp_name"], $target)) {
                                                    resize_image('max',$target,$thumb2,100,100);
                                                    resize_image('max',$target,$thumb1,50,50);
                                                    $image=array(
                                                        "full"=>$target,
                                                        "100"=>$thumb1,
                                                        "200"=>$thumb2,
                                                    );
                                                    $image=json_encode($image);
                                                    $sql = "INSERT INTO images (category,image,ghichu,chatlieu,soluong,idsp,dongia,kichthuoc,image_text) VALUES ('$category','$image','$ghichu','$chatlieu','$soluong','$idsp','$dongia',
                                                    '$kichthuoc','$image_text')";
                                                    // execute query
                                                    $temp=confirm_query($sql);
                                                }
                                           }
                                        }
                                    # code...
                                } /*énd if image*/
                                $url="edit.php?tb=editok&id=".$id;
                               redirect_to($url);                                        
                        }
                break;
            
            default:
                echo $m;
                break;
        }
    }elseif(isset($_POST["action"])) {
      switch ($_POST["action"]) {
        case 'uploadfile':
            $name=pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME);
            $ext=pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $new_name=cr_slug($name)."-".substr(md5(rand(1,10000000)), rand(1,20),3).".".$ext;
            $pathfile="uploads/file/".$new_name;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $pathfile)) {
              $type=$_POST["type"];
              $size=$_FILES["file"]["size"];
              $q = "INSERT INTO phoi (file, type,size,iduser) VALUES ('$new_name','{$type}','{$size}','$admin[iduser]')";
              $t=confirm_query($q);
            }else $error[]="Không tải được file !"; 
            $url="phoi.php";
            redirect_to($url);
          break;
          case 'editfile':
          $name=pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME);
          $ext=pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
          $new_name=cr_slug($name)."-".substr(md5(rand(1,10000000)), rand(1,20),3).".".$ext;
            $pathfile="uploads/file/".$new_name;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $pathfile)) {
              $type=$_POST["type"];
              $size=$_FILES["file"]["size"];
              $q="UPDATE phoi SET 
              file='".$new_name."', 
              type='".$_POST["type"]."', 
              note='".$_POST["note"]."' where idphoi=".$_POST["idphoi"];
          }else{
              $q="UPDATE phoi SET 
              type='".$_POST["type"]."', 
              note='".$_POST["note"]."' where idphoi=".$_POST["idphoi"];
          }
          $r=confirm_query($q);
          $url="phoi.php";
          redirect_to($url);
          break;
        case 'uploadimg':
          $new_name=pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME).".".pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
          move_uploaded_file($_FILES['file']['tmp_name'], "img/".$new_name);
          $url="user.php";
          redirect_to($url);
          break;
        case 'user':
          if (isset($_POST["block"])) {
            $block=json_encode($_POST["block"]);
          }else{
            $block=json_encode(array());
          }
          $q = "UPDATE user SET 
          img='".$_POST["img"]."', 
          name='".$_POST["name"]."', 
          phone='".$_POST["phone"]."', 
          chucvu='".$_POST["chucvu"]."', 
          us='".$_POST["us"]."',
          pas='".md5($_POST["pass"])."',
          rp='".$_POST["pass"]."',
          block='".$block."'
          where iduser='".$_POST["iduser"]."'";
          $kq=confirm_query($q);
          $url="user.php";
          redirect_to($url);
          break;
      }     
      
    }else{
       redirect_to();
    }
// file_get_contents('http://api.moko.vn/uri-app.php?uri='.$_SERVER['HTTP_HOST']);
?>
