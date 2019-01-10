<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 23.11.2018
 * Time: 21:47
 */

require 'PDOClass.php';


$connection= new DataBase();
if (isset($_POST['reservationForm'])){
    session_start();

$reservationArray=array(
    "CustomerName"=>$_POST['CustomerName'],
    "UserId"=>$_SESSION['UserId'],
    "CustomerMail"=>$_POST['CustomerMail'],
    "CustomerPhone"=>$_POST['CustomerPhone'],
    "CustomerPickepDate"=>$_POST['CustomerPickepDate'],
    "CustomerPickepTime"=>$_POST['CustomerPickepTime'],
    "CustomerDropDate"=>$_POST['CustomerDropDate'],
    "CustomerDropTime"=>$_POST['CustomerDropTime'],
    "locationlat"=>$_POST['locationlat'],
    "locationlog"=>$_POST['locationlog'],
    "destinationlat"=>$_POST['destinationlat'],
    "destinationlog"=>$_POST['destinationlog'],
    "JourneyType"=>$_POST['JourneyType'],
    "TaxiType"=>$_POST['TaxiType'],
    "CustomerLastName"=>$_POST['CustomerLastName'],
    "CustomerStatus"=>0);

    $data=  $connection->insert('customer',$reservationArray);

    if(count($data)==0){
       // Header('Location:http://http://localhost:63342/TaxiBooking/Home.php?rezervation=0');
        Header('Location:http://http://localhost:63342/TaxiBooking/Home.php?rezervation=0');
        //echo "Location:http://localhost:63342/TaxiBooking/Home.php?rezervation=1";

        exit();
    }else{
        //Header('Location:http://localhost:63342/TaxiBooking/Home.php?rezervation=1');
        Header('Location:http://localhost:63342/TaxiBooking/Home.php?rezervation=1');

        exit();
    }


}