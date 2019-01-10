<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 23.11.2018
 * Time: 09:29
 */


require 'PDOClass.php';


$connection= new DataBase();
if(isset($_POST['loginForm'])){


    $loginAraay=array("UserMail"=>$_POST['inputEmail'],"UserPassword"=>$_POST['inputPassword']);
   $data= $connection->selectAnd('users',$loginAraay);

   if (!empty($data)) {
       session_start();
       $_SESSION['UserId']=$data[0]['UserId'];
       $_SESSION['UserMail']=$data[0]['UserMail'];
       $_SESSION['UserPassword']=$data[0]['UserPassword'];
       $_SESSION['UserName']=$data[0]['UserName'];
       $_SESSION['UserAdmin']=$data[0]['UserAdmin'];

       if($data[0]['UserAdmin']==1){
           Header("Location:http://localhost:63342/TaxiBooking/AdminRezervation.php");
       }else{
           //Header("Location:http://localhost:63342/TaxiBooking/Home.php");
           Header("Location:http://localhost:63342/TaxiBooking/Home.php");
       }

       exit();

   }else{
       //Header('Location:https://http://localhost:63342/TaxiBooking/Login.php?register=2');
       Header('Location:http://localhost:63342/TaxiBooking/Login.php?register=2');
   }



}

if(isset($_POST['registerForm'])){

    $insertArray=array("UserName"=>$_POST['UserName'],"UserPassword"=>$_POST['UserPassword'],"UserMail"=>$_POST['UserMail'],"UserAdmin"=>0);
    $checkArray=array("UserMail"=>$_POST['UserMail']);
    $checkUser= $connection->selectAnd('users',$checkArray);


    if(count($checkUser)==0){

       $insertResponse= $connection->insert("users",$insertArray);

       Header('Location:http://localhost:63342/TaxiBooking/Login.php?register=0');
       exit();


    }else{
        Header('Location:http://localhost:63342/TaxiBooking/Login.php?register=1');
        exit();
    }

}