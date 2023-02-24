<?php
     include "function.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Member</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <div class="wapper">
        <div> 
            <h1><b>Xin chào <?=$admin["name"]?></b></h1>
        </div>
        <div class="head">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="Member.php">Xem Mẫu <span class="sr-only">(current)</span></a>                  </li>
                 
                </ul>
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Từ khóa" >
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                </form>
              </div>
            </nav>
        </div>
        <div class="container-fluid">
            <h2>Báo giá sản phẩm</h2>
            <p>Dưới đây là báo giá, giá này dựa trên chất liệu và số lượng, hãy xem kỹ nhé. <br>
            Số lượng ít hơn có thể giá sẽ cao hơn và ngược lại. <br>
            Sản phẩm đang là thủy tinh muốn làm K7 hoặc pha lê giá sẽ cao lên và ngược lại. <br>
            Những sản phẩm chưa có kích thước hoặc thông số hãy liên hệ zalo 0797.789.888  (Ms. Thủy)</p>
            <div class="row">
                 <?php
                $q1="select 
                    image,
                    category,
                    kichthuoc,
                    soluong,
                    dongia,
                    chatlieu
                    from images
                    where mau='Mẫu'";                
                    $r1=confirm_query($q1);
                    $sl=mysqli_num_rows($r1);
                    if($sl > 0){
                    while ($kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC)) { $image=json_decode($kq1["image"],true);?>
                    <div class="col-md-4">
                        <img style="max-width: 100%" src="<?php echo BASE_URL;?> <?=$image["full"]?>">
                        <p>
                            <ul>
                                <li><i>Loại:</i> <b><?=$kq1["category"]?></b></li>
                                <li><i>Kích thước:</i><b><?=$kq1["kichthuoc"]?></b></li>
                                <li><i>Giá đề xuất</i> <b><?=$kq1["dongia"]?></b>/sp cho chất liệu <b><?=$kq1["chatlieu"]?></b>, SL <b><?=$kq1["soluong"]?></b> cái</li>
                            </ul>
                        </p>
                    </div>
                <?php                                          
                       
                    }}

                ?>
            </div>
        </div>
    </div>
</body>
</html>