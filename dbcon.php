<?php

    define('BASE_URL', 'http://admin.ducdat.local/');



    $dbc = mysqli_connect('localhost','root','root','test123123');



    



     // neu ket noi khong thanh cong, thi bao loi ra



    if(!$dbc) {



        trigger_error("Could not connect to DB: " . mysqli_connect_error());



    } else {



        // dat phuong thuc ket noi la utf-8



        mysqli_set_charset($dbc,"utf8");



    }



    



?>