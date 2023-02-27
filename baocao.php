<?php
$title="Báo Cáo";
include "header.php";
if ($admin["cap"]>=3 or isset($admin["block"]["bc"])) {
    echo "Not Thing";
    exit();
}
if (isset($_GET["year"])) {
    $year=$_GET["year"];
}else $year=date("Y");

$link_year="baocao.php?year=".$year;
$tb1="Trang báo cáo tài chính";

$tongtien=get_file(array("year(date1)"=>$year),"month");


if (isset($_GET["t"]) and is_numeric($_GET["t"])) {
    $t=$_GET["t"];
    $datas=get_file(array("year(date1)" =>$year, "month(file.date1)"=>$t),"baocao");
}
?>
    <body>
        <?php
         include "menu.php";
        ?>        
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                                <div class="page-title-box">
                                    <h4 class="page-title">Dữ liệu thống kê năm <?=$year?></h4>
                                </div>
                                <div>                                
                                <?php 
                                    for ($i=2018; $i <= date("Y"); $i++) { 
                                        echo '<a style="padding-right:20px; font-size:14px; font-weight:bold"  href="baocao.php?year='.$i.'">'.$i.'</a>';
                                    }
                                ?>
                            </div>                            
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                 <div class="row">
                    <div class="col-md-8">
                    <div class="card-box">
                        <h4 class="header-title">Tổng thu tính theo tháng (năm <?=$year?>)</h4>

                        <div class="chart mt-4" id="area-chart"></div>
                    </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-box">
                            <h4>Lựa chọn sao kê</h4>
                            <ul>
                                <?php foreach ($tongtien as $key => $value): ?>
                                     <li><a href="<?=$link_year."&t=".$key?>#table">Sao kê tháng <?=$key?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    
                    <?php if (isset($datas)): ?>

                    <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30"><?=isset($t)?"Sao kê chi tiết tháng ".$t." năm ".$year:""?>  </h4>                                
                            <ul class="nav nav-pills navtab-bg nav-justified pull-in ">
                                <li class="nav-item">
                                    <a href="#all" data-toggle="tab" aria-expanded="false" class="nav-link active show">
                                        Tất cả
                                    </a>
                                </li>

                                <?php if (isset($datas["Đã Thanh Toán"])){ foreach ($datas["Đã Thanh Toán"] as $key => $value){ ?>
                                 <li class="nav-item">
                                    <a href="#A<?=md5($key)?>" data-toggle="tab" aria-expanded="true" class="nav-link">
                                        ĐÃ THANH TOÁN <BR><?=$key?>
                                    </a>
                                </li>
                                <?php }} ?>

                                <li class="nav-item">
                                    <a href="#chuathanhtoan" data-toggle="tab" aria-expanded="true" class="nav-link">
                                        Chưa Thanh Toán 
                                    </a>
                                </li>
                               
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="all">
                                   
                                        <h4 class="header-title m-t-0 m-b-30">Sao kê chi tiết tháng <?=$t?> năm <?=$year?></h4>
                                       
                                        <?php $tmp_dt=$datas["all"]; include "inc/tb_baocao.php"?>       
                                    
                                </div>

                                <?php if (isset($datas["Đã Thanh Toán"])) { foreach ($datas["Đã Thanh Toán"] as $k => $v){ ?>                                
                                <div class="tab-pane" id="A<?=md5($k)?>">
                                    <h4 class="header-title m-t-0 m-b-30">Đơn hàng đã thanh toán, <?=$k?></h4>
                                    <?php $tmp_dt=$v; include "inc/tb_baocao.php"?>       
                                </div>
                                <?php }} ?>


                                <div class="tab-pane" id="chuathanhtoan">
                                    <h4 class="header-title m-t-0 m-b-30">CHƯA THANH TOÁN</h4>

                                    <ul class="nav nav-tabs">
                                        <?php foreach ($datas["Chưa Thanh Toán"] as $key => $value): ?>
                                            <li class="nav-item">
                                                <a href="#<?=md5($key)?>" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                   <i class="fi-monitor mr-2"></i> <?=$key?>
                                                </a>
                                            </li>
                                        <?php endforeach?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php foreach ($datas["Chưa Thanh Toán"] as $k => $v): ?>
                                            <div class="tab-pane" id="<?=md5($k)?>">
                                                <?php $tmp_dt=$v; include "inc/tb_baocao.php"?>   
                                            </div>
                                        <?php endforeach ?>
                                        </div>                                       
                                    </div>
                                    
                            </div>
                        </div>
                        <?php endif ?>
                           
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
        <?php
            include "footer.php";
        ?>
        <!-- Required datatable js -->
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

        

        <!-- Required datatable js -->
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



        <!-- Google Charts js -->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <!-- Init -->
        <script type="text/javascript">
                /**
 * Theme: Highdmin - Responsive Bootstrap 4 Admin Dashboard
 * Author: Coderthemes
 * Module/App: Google Chart
 */

! function($) {
    "use strict";

    var GoogleChart = function() {
        this.$body = $("body")
    };

    //creates line graph
    GoogleChart.prototype.createLineChart = function(selector, data, axislabel, colors) {
        var options = {
            fontName: 'Roboto',
            height: 340,
            curveType: 'function',
            fontSize: 12,
            chartArea: {
                left: '8%',
                width: '90%',
                height: 300
            },
            pointSize: 4,
            tooltip: {
                textStyle: {
                    fontName: 'Roboto',
                    fontSize: 14
                }
            },
            vAxis: {
                title: axislabel,
                titleTextStyle: {
                    fontSize: 12,
                    italic: false
                },
                gridlines:{
                    color: '#f5f5f5',
                    count: 10
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    fontSize: 14
                }
            },
            lineWidth: 3,
            colors: colors
        };

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var line_chart = new google.visualization.LineChart(selector);
        line_chart.draw(google_chart_data, options);
        return line_chart;
    },
    //creates area graph
    GoogleChart.prototype.createAreaChart = function(selector, data, axislabel, colors) {
        var options = {
            fontName: 'Roboto',
            height: 340,
            curveType: 'function',
            fontSize: 12,
            chartArea: {
                left: '8%',
                width: '90%',
                height: 300
            },
            pointSize: 4,
            tooltip: {
                textStyle: {
                    fontName: 'Roboto',
                    fontSize: 12
                }
            },
            vAxis: {
                title: axislabel,
                titleTextStyle: {
                    fontSize: 14,
                    italic: false
                },
                gridarea: {
                    color: '#f5f5f5',
                    count: 10
                },
                gridlines: {
                    color: '#f5f5f5'
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'end',
                textStyle: {
                    fontSize: 14
                }
            },
            lineWidth: 2,
            colors: colors
        };

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var area_chart = new google.visualization.AreaChart(selector);
        area_chart.draw(google_chart_data, options);
        return area_chart;
    },
    //creates Column graph
    GoogleChart.prototype.createColumnChart = function(selector, data, axislabel, colors) {
        var options = {
            fontName: 'Roboto',
            height: 400,
            fontSize: 12,
            chartArea: {
                left: '8%',
                width: '90%',
                height: 350
            },
            tooltip: {
                textStyle: {
                    fontName: 'Roboto',
                    fontSize: 12
                }
            },
            vAxis: {
                title: axislabel,
                titleTextStyle: {
                    fontSize: 12,
                    italic: false
                },
                gridlines:{
                    color: '#f5f5f5',
                    count: 10
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    fontSize: 13
                }
            },
            colors: colors
        };

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var column_chart = new google.visualization.ColumnChart(selector);
        column_chart.draw(google_chart_data, options);
        return column_chart;
    },
    //creates bar graph
    GoogleChart.prototype.createBarChart = function(selector, data, colors) {
        var options = {
            fontName: 'Roboto',
            height: 400,
            fontSize: 12,
            chartArea: {
                left: '8%',
                width: '90%',
                height: 350
            },
            tooltip: {
                textStyle: {
                    fontName: 'Roboto',
                    fontSize: 12
                }
            },
            vAxis: {
                gridlines:{
                    color: '#f5f5f5',
                    count: 10
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    fontSize: 13
                }
            },
            colors: colors
        };

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var bar_chart = new google.visualization.BarChart(selector);
        bar_chart.draw(google_chart_data, options);
        return bar_chart;
    },
    //creates Column Stacked
    GoogleChart.prototype.createColumnStackChart = function(selector, data, axislabel, colors) {
        var options = {
            fontName: 'Roboto',
            height: 400,
            fontSize: 12,
            chartArea: {
                left: '8%',
                width: '90%',
                height: 350
            },
            isStacked: true,
            tooltip: {
                textStyle: {
                    fontName: 'Roboto',
                    fontSize: 12
                }
            },
            vAxis: {
                title: axislabel,
                titleTextStyle: {
                    fontSize: 12,
                    italic: false
                },
                gridlines:{
                    color: '#f5f5f5',
                    count: 10
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    fontSize: 13
                }
            },
            colors: colors
        };

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var stackedcolumn_chart = new google.visualization.ColumnChart(selector);
        stackedcolumn_chart.draw(google_chart_data, options);
        return stackedcolumn_chart;
    },
    //creates Bar Stacked
    GoogleChart.prototype.createBarStackChart = function(selector, data, colors) {
        var options = {
            fontName: 'Roboto',
            height: 400,
            fontSize: 12,
            chartArea: {
                left: '8%',
                width: '90%',
                height: 350
            },
            isStacked: true,
            tooltip: {
                textStyle: {
                    fontName: 'Roboto',
                    fontSize: 12
                }
            },
            hAxis: {
                gridlines: {
                    color: '#f5f5f5',
                    count: 10
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    fontSize: 13
                }
            },
            colors: colors
        };


        var google_chart_data = google.visualization.arrayToDataTable(data);
        var stackedbar_chart = new google.visualization.BarChart(selector);
        stackedbar_chart.draw(google_chart_data, options);
        return stackedbar_chart;
    },
    //creates pie chart
    GoogleChart.prototype.createPieChart = function(selector, data, colors, is3D, issliced) {
        var options = {
            fontName: 'Roboto',
            fontSize: 13,
            height: 300,
            chartArea: {
                left: 50,
                width: '90%',
                height: '90%'
            },
            colors: colors
        };

        if(is3D) {
            options['is3D'] = true;
        }

        if(issliced) {
            options['is3D'] = true;
            options['pieSliceText'] = 'label';
            options['slices'] = {
                2: {offset: 0.15},
                5: {offset: 0.1}
            };
        }

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var pie_chart = new google.visualization.PieChart(selector);
        pie_chart.draw(google_chart_data, options);
        return pie_chart;
    },

    //creates donut chart
    GoogleChart.prototype.createDonutChart = function(selector, data, colors) {
        var options = {
            fontName: 'Roboto',
            fontSize: 13,
            height: 300,
            pieHole: 0.55,
            chartArea: {
                left: 50,
                width: '90%',
                height: '90%'
            },
            colors: colors
        };

        var google_chart_data = google.visualization.arrayToDataTable(data);
        var pie_chart = new google.visualization.PieChart(selector);
        pie_chart.draw(google_chart_data, options);
        return pie_chart;
    },
    //init
    GoogleChart.prototype.init = function () {
        var $this = this;

        //creating line chart
        var common_data = [
            ["Tháng", "Tổng thu"],
            <?php  foreach ($tongtien as $key => $value): ?>
                 ['<?=$key?>',  <?=$value?> ],
            <?php endforeach ?>
           
        ];
       // $this.createLineChart($('#line-chart')[0], common_data, 'Sales and Expenses', ['#4eb7eb', '#f1556c']);


        //creating area chart using same data
        $this.createAreaChart($('#area-chart')[0], common_data, 'Đơn vị ngàn đồng', ['#ccc', '#02c0ce']);


        //creating column chart
        var column_data = [
            ['Year', "Bitcoin", "Ethereum", "Litecoin"],
            ['2010',  850,      120, 200],
            ['2011',  745,      200, 562],
            ['2012',  852,      180, 521],
            ['2013',  1000,      400, 652],
            ['2014',  1170,      460, 200],
            ['2015',  660,       1120, 562],
            ['2016',  1030,      540, 852]
        ];
       // $this.createColumnChart($('#column-chart')[0], column_data, 'Sales and Expenses', ['#02c0ce','#0acf97', '#ebeff2']);


        //creating bar chart
        var bar_data = [
            ['Year', "Bitcoin", "Ethereum"],
            ['2004',  1000,      400],
            ['2005',  1170,      460],
            ['2006',  660,       1120],
            ['2007',  1030,      540]
        ];
       // $this.createBarChart($('#bar-chart')[0], bar_data, ['#4eb7eb', '#ebeff2']);


        //creating columns tacked chart
        var column_stacked_data = [
            ['Genre', "Bitcoin", "Ethereum", "Litecoin", "Ripple", { role: 'annotation' } ],
            ['2000', 20, 30, 35, 40, ''],
            ['2005', 14, 20, 25, 30, ''],
            ['2010', 10, 24, 20, 32, ''],
            ['2015', 15, 25, 30, 35, ''],
            ['2020', 16, 22, 23, 30, ''],
            ['2025', 12, 26, 20, 40, ''],
            ['2030', 28, 19, 29, 30, '']
        ];
       // $this.createColumnStackChart($('#column-stacked-chart')[0], column_stacked_data, 'Sales and Expenses', [ '#2d7bf4','#4eb7eb','#02c0ce', '#e3eaef']);


        //creating bar tacked chart
        var bar_stacked_data = [
            ['Genre', "Bitcoin", "Ethereum", "Litecoin", "Ripple", { role: 'annotation' } ],
            ['2000', 20, 30, 35, 40, ''],
            ['2005', 14, 20, 25, 30, ''],
            ['2010', 10, 24, 20, 32, ''],
            ['2015', 15, 25, 30, 35, ''],
            ['2020', 16, 22, 23, 30, ''],
            ['2025', 12, 26, 20, 40, ''],
            ['2030', 28, 19, 29, 30, '']
        ];
      //  $this.createBarStackChart($('#bar-stacked-chart')[0], bar_stacked_data, ['#2d7bf4','#4eb7eb','#02c0ce', '#e3eaef']);

    },
    //init GoogleChart
    $.GoogleChart = new GoogleChart, $.GoogleChart.Constructor = GoogleChart
}(window.jQuery),

//initializing GoogleChart
function($) {
    "use strict";
    //loading visualization lib - don't forget to include this
    google.load("visualization", "1", {packages:["corechart"]});
    //after finished load, calling init method
    google.setOnLoadCallback(function() {$.GoogleChart.init();});
}(window.jQuery);


        </script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>



    </body>
</html>
