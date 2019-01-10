<?php
session_start();

if (!isset($_SESSION['UserId']) || !isset($_SESSION['UserMail']) || !isset($_SESSION['UserPassword']) ||  !isset($_SESSION['UserName'] )||  !isset($_SESSION['UserAdmin'])){
    Header('Location:http://localhost:63342/TaxiBooking/Login.php');
}


?>
<?php require_once 'PDOClass.php';
ob_start();
$con=new DataBase();
?>

<?php
if(isset($_GET['DeleteId'])){

    $deleteId=$_GET['DeleteId'];
    $con->deleteCustomerRezervation($deleteId);
    Header('Location: http://localhost:63342/TaxiBooking/AdminRezervation.php');
    exit();
}
?>
<?php
if(isset($_GET['ApprovedId'])){
    $aproved=$_GET['ApprovedId'];
    $checkArray=array("CustomerStatus"=>true);
    $con->updateCostumerStatus('customer',$aproved,$checkArray);
    header('Location:http://localhost:63342/TaxiBooking/AdminRezervation.php');
    exit();
}?>
<?php
if(isset($_GET['Id'])){
    $Id=$_GET['Id'];
    $checkArray=array("CustomerId"=>$Id);
    $veri=$con->selectAnd('customer',$checkArray);

}?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Taksi Rezervasyon</title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Jitney Booking Form Responsive Widget, Audio and Video players, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"
    />
    <script>
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>

    <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
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


<h1 class="header-w3ls">
    Müşteri Rezarvasyonu
</h1>


<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="mapid"></div>
        </div>
    </div>
</div>

<div class="main-bothside">
    <form name="reservationForm" action="HomeController.php" method="post">
        <div class="form-group">
            <div class="form-mid-w3ls">
                <p>Adı</p>
                <input name="CustomerName" type="text" disabled="disabled" value="<?php echo $veri[0]['CustomerName']?>" placeholder="Adınızı Giriniz.." required="">
            </div>
            <div class="form-mid-w3ls">
                <p>Soyadı</p>
                <input name="CustomerLastName" disabled="disabled" type="text" value="<?php echo $veri[0]['CustomerLastName']?>" placeholder="Soyadınızı Giriniz.." required="">
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <p>E-mail</p>
                <input name="CustomerMail" type="email" disabled="disabled"  value="<?php echo $veri[0]['CustomerMail']?>"   placeholder="E-Mail Giriniz.." required="">
            </div>
            <div class="form-mid-w3ls">
                <p>Telefon</p>
                <input type="text" name="CustomerPhone" disabled="disabled" value="<?php echo $veri[0]['CustomerPhone']?>" placeholder="Telefon Giriniz.." required="">
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <p>Biniş Tarihi & Zamanı</p>
                <input id="datepicker" disabled="disabled"  name="CustomerPickepDate" value="<?php echo $veri[0]['CustomerPickepDate']?>"  type="text" placeholder="Tıklayınız.." required="">
                <input type="text" id="timepicker"  disabled="disabled" value="<?php echo $veri[0]['CustomerPickepTime']?>"  name="CustomerPickepTime" class="timepicker form-control hasWickedpicker" placeholder="Tıklayınız.." required=""
                       onkeypress="return false;">
                <div class="clear"></div>
            </div>
            <div class="form-mid-w3ls">
                <p>İniş Tarihi & Zamanı </p>
                <input id="datepicker1" disabled="disabled"   value="<?php echo $veri[0]['CustomerDropDate']?>" name="CustomerDropDate" type="text" placeholder="Tıklayınız.." required="">
                <input type="text" id="timepicker1"  disabled="disabled" value="<?php echo $veri[0]['CustomerDropTime']?>"  name="CustomerDropTime" class="timepicker1 form-control hasWickedpicker" placeholder="Tıklayınız.." required=""
                       onkeypress="return false;">
                <div class="clear"></div>
            </div>
        </div>
        <div class="form-group">

            <input class="btn btn-primary" type="button" onclick="Destination()" value="Müşterinin Konumunu Görmek İçin Tıklayınız."
                   style="width: 100%;height: auto;position: center; ">

            <input type="hidden" id="locationlat" name="locationlat" value=""/>
            <input type="hidden" id="locationlog" name="locationlog" value=""/>
            <input type="hidden" id="destinationlat" name="destinationlat" value=""/>
            <input type="hidden" id="destinationlog" name="destinationlog" value=""/>

        </div>

        <div class="form-group">
            <div class="form-mid-w3ls">
                <p>Yolculuk Türü</p>
                <input type="hidden"   value="<?php echo $veri[0]['JourneyType']?>"  name="JourneyType" id="JourneyType"/>
                <select     class="form-control JourneyTypeSelect">
                    <option name="JourneyType" selected="selected" value=""><?php echo $veri[0]['JourneyType']?></option>

                </select>
            </div>
            <div class="form-mid-w3ls">
                <p>Taksi Tipi</p>
                <input type="hidden" disabled="disabled" value="<?php echo $veri[0]['TaxiType']?>"  name="TaxiType" id="TaxiType"/>
                <select   class="form-control TaxiTypeSelect">
                    <option name="TaxiType" selected="selected" ><?php echo $veri[0]['TaxiType']?></option>

                </select>
            </div>
        </div>
        <div >
            <p>
                <a href="http://localhost:63342/TaxiBooking/AdminDetailRezervation.php?ApprovedId=<?php echo $veri[0]['CustomerId']?>">
                <button  <?php if($veri[0]['CustomerStatus']==1){echo 'disabled="disabled"';}  ?> style="width: 560px;height: 75px;" type="button" class="<?php
                $danger="btn-danger"; $succes="btn-success";
                if($veri[0]['CustomerStatus']==0){
                    echo $danger;
                }else
                    echo $succes;


                ?>" ><?php
                    $danger="Rezervasyon Onaylanmadı! Tıklayarak Onaylayınız."; $succes="Rezervasyon Onaylandı!";
                    if($veri[0]['CustomerStatus']==0){
                        echo $danger;
                    }else
                        echo $succes;


                    ?></button>
            </p>

        </div>
        <div >
            <p>
                <a href="http://localhost:63342/TaxiBooking/AdminDetailRezervation.php?DeleteId=<?php echo $veri[0]['CustomerId']?>">
                <button class="btn-primary"  style="width: 560px;height: 75px;margin-top: 10px;" type="button">Rezarvasyonu Sil</button>
            </p>

        </div>
    </form>
</div>
<div class="copy">
    <p>&copy;2018 Barış Can AKDAĞ | <a href="AdminRezervation.php">Geri Dönmek İçin Tıklayınız..</a> </p>
</div>

<script>
    $( document ).ready(function() {

        $("select.TaxiTypeSelect").change(function(){
            var selectedTaxiType = $(this).children("option:selected").val();
            $('#TaxiType').val(selectedTaxiType);
        });

        $("select.JourneyTypeSelect").change(function(){
            var JourneyTypeSelect = $(this).children("option:selected").val();
            $('#JourneyType').val(JourneyTypeSelect);
        });

        $("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();


        var rezervationrResponse=<?php

            if (isset($_GET['rezervation'])){

                printf($_GET['rezervation']);
            }else
                echo "'login' "

            ?>;
        if(rezervationrResponse==1)
            alertify.success("Rezervasyonunuz oluşturulmuştur.Onaylandığında mail ile bilgilendirme yapılacaktır.");

        if (rezervationrResponse==0)
            alertify.error("Rezervasyon oluşturulamadı...")


    });

    function Destination(){

        $('#myModal').modal('show');

        navigator.geolocation.getCurrentPosition(showPosition);

        function showPosition(position) {
            var latitude= position.coords.latitude ;
            var longitude =position.coords.longitude;

            var map = L.map('mapid').setView([latitude, longitude], 13);

            var marker = new L.marker([<?php echo $veri[0]['locationlat']?>,<?php echo $veri[0]['locationlog']?>],{
                draggable: false
            }).addTo(map);
            $('#locationlat').val(latitude);
            $('#locationlog').val(longitude);
            marker.bindPopup("<b>Taksinin Alacağı </b><br>Konum.").openPopup();
            marker.on("drag", function(e) {

                var marker = e.target;
                var position = marker.getLatLng();

                map.panTo(new L.LatLng(position.lat, position.lng));
                $('#locationlat').val(position.lat);
                $('#locationlog').val(position.lng);
            });

            var marker2 = new L.marker([<?php echo $veri[0]['destinationlat']?>,<?php echo $veri[0]['destinationlog']?>],{
                draggable: false
            }).addTo(map);

            $('#destinationlat').val(latitude);
            $('#destinationlog').val(longitude);


            var marker=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibG9yZGJ5cyIsImEiOiJjam91ZmhxNWQwcWFlM3BzM2duemRjMzRxIn0.eIVJioetm01lCgNb0W2_3Q', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoibG9yZGJ5cyIsImEiOiJjam91ZmhxNWQwcWFlM3BzM2duemRjMzRxIn0.eIVJioetm01lCgNb0W2_3Q'
            }).addTo(map);


            marker2.on("drag", function(e) {

                var marker = e.target;
                var position = marker.getLatLng();
                map.panTo(new L.LatLng(position.lat, position.lng));
                $('#destinationlat').val(position.lat);
                $('#destinationlog').val(position.lng);
            });
            marker2.bindPopup("<b>Müşterinin Gideceği</b><br>Konum Burası.").openPopup();
        }

    }

    $('.timepicker,.timepicker1').wickedpicker({ twentyFour: false });
</script>

<!-- //Time -->
</body>

</html>

<?php ob_end_flush();  ?>