<body>
     <?php
        //include "function.php";        
        $data1=array();
        $date= new DateTime($now);
        date_modify($date, "-10  day");
        $date=date_format($date, "Y-m-d  h:i:s");
        
        $q=" where  date1 > '$date'";
        $data=get_file($q);
        foreach ($data as $key => $value) {
          $data[$value["cr_date1"]][]=$value;
          unset($data[$key]);
        }
        ?>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                 <?php
                    foreach ($data as $key => $value) {
                        $cl=md5($key);
                        $d=date_format(date_create($key),"d/m");
                        $d2=date("d/m");
                        if ($d==$d2) {
                          $active="active";
                        }else $active="";
                        echo '<li class="nav-item">
                            <a class="nav-link '.$active.'" id="pills-home-tab" data-toggle="pill" href="#'.$cl.'" role="tab" aria-controls="pills-home" aria-selected="true">('.count($value).')'.thedate($key,1).'</a>
                          </li>';
                    }
                ?>
            </ul>        
           
            <div class="tab-content" id="pills-tabContent">
                    <?php
                    foreach ($data as $key => $value) {
                          $tmp="";
                        $d=date_format(date_create($key),"d/m");
                        $d2=date("d/m");
                        if ($d==$d2) {
                          $active="active show";
                          $nows="Đơn hàng của ngày hôm nay ".thedate($key,1);
                        }else { $active="";
                        $nows="Đơn hàng ".thedate($key,1);
                      }
                      ?>                     

                     <div class="tab-pane fade <?=$active?>" id="<?=md5($key)?>" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div><h3 ><?=$nows?></h3></div>
                        <div class="view holiday"> 
                          <table  class="table table-bordered viewdh">
                              <thead>
                                  <tr class="tr-its">
                                      <th style="width: 10px">#</th>
                                      <th >Thông File</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php foreach ($value as $k => $v): ?>
                              <?php  include "inc/td_view.php"; ?>
                              <?php endforeach ?>
                              </tbody>
                          </table>                         
                        </div>                        
                     </div>                       
                    <?php }?>
            </div><!-- end md-6 -->
       <div class="media-modal-backdrop"></div>
       <?php include "footer.php";?>   
</body>

</html>
