<?php
session_start();
if (!isset($_SESSION['UserId']) || !isset($_SESSION['UserMail']) || !isset($_SESSION['UserPassword']) ||  !isset($_SESSION['UserName'] )||  !isset($_SESSION['UserAdmin'])){
    Header('Location:http://localhost:63342/TaxiBooking/Login.php');
}
?>
<?php require_once 'PDOClass.php';
$con=new DataBase();
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="theme/css/style.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>
<body>
</br>
<h2 style="margin-left: 500px"><?php echo $_SESSION['UserName'] ?>    Rezervasyonlarınız</h2>
<div class="continer">

    <div class="row">
            <?php

            $checkArray=array("UserId"=>$_SESSION['UserId']);
            $veri=$con->selectAnd('customer',$checkArray);

            foreach ($veri as $customer){

            ?>


                <div class="col-md-3 mt-3">
                    <div class="card" style="width: 18rem;">
                        <a href="http://localhost:63342/TaxiBooking/DetailRezervation.php?Id=<?php echo $customer['CustomerId']  ?>">
                            <img class="card-img-top" src="Images/b1.jpg"  alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text ml-5">Tel :<?php echo $customer['CustomerPhone']; ?></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text ml-5">Tarih :<?php echo $customer['CustomerPickepDate']; ?></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text ml-5">Zaman : <?php echo $customer['CustomerPickepTime']; ?></p>
                            </div>
                    </div>
                </div>



            <?php } ?>





    </div>


</div>






</body>
</html>