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
    <script>
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>


    <!--//style sheet end here-->
    <!-- Calendar -->
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- //Calendar -->
    <link href="css/wickedpicker.css" rel="stylesheet" type='text/css' media="all" />
    <script src="js/leaflet.js" type="application/javascript"></script>
    <link href="css/leaflet.css" rel="stylesheet" type="text/css">
    <script src="Script/alertify.js"></script>

    <link href="Style/alertify.rtl.css" rel="stylesheet" type="text/css" />
    <link href="Style/default.rtl.css" rel="stylesheet" type="text/css"/>



    <!-- js -->
    <script src='js/jquery-2.2.3.min.js'></script>
    <!-- //js -->
    <!-- Calendar -->
    <script src="js/jquery-ui.js"></script>

    <!-- //Calendar -->
    <!-- Time -->
    <script src="js/wickedpicker.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Time-script-CSS -->
    <link href="//fonts.googleapis.com/css?family=Barlow:300,400,500" rel="stylesheet">
    <style>
        #mapid { height:900px; width: 900px; };
    </style>

</head>

<body>

<h2 style="margin-left: 500px">Müşteri Rezervasyonları</h2>
<hr>


<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Adı</th>
        <th scope="col">Telefon</th>
        <th scope="col">Gideceği Tarih</th>
        <th scope="col">Gideceği Zaman</th>
        <th scope="col">Detay</th>
        <th scope="col">Onay Durumu</th>
    </tr>
    </thead>
    <tbody>
    <?php $veri=$con->selectAnd('customer');
    $index=1;
    foreach ($veri as $data){


    ?>
    <tr>

        <th scope="row"><?php echo $index ?></th>
        <td><?php echo $data['CustomerName'] ?></td>
        <td><?php echo $data['CustomerPhone'] ?></td>
        <td><?php echo $data['CustomerPickepDate'] ?></td>
        <td><?php echo $data['CustomerPickepTime'] ?></td>
        <td>
            <p>
                <a href="http://localhost:63342/TaxiBooking/AdminDetailRezervation.php?Id=<?php echo $data['CustomerId']?>">
                    <button class="btn-primary">Göster</button></td>
            </p>

        <?php
        if($data['CustomerStatus']==1){
            $onaylıText="Onaylandı";
            $onaylıButton="btn-success";

        }else{
            $onaylıText="Onay Bekliyor.";
            $onaylıButton="btn-danger";
        }

        ?>
        <td><button class="<?php echo $onaylıButton?>"><?php echo $onaylıText?></button></td>
    </tr>
<?php $index++; }?>

    </tbody>
</table>




</body>
</html>