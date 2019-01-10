<?php
session_start();

if (!isset($_SESSION['UserId']) || !isset($_SESSION['UserMail']) || !isset($_SESSION['UserPassword']) ||  !isset($_SESSION['UserName'] )||  !isset($_SESSION['UserAdmin'])){
    Header('Location:http://localhost:63342/TaxiBooking/Login.php');
}


?>

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
    Taksi Rezervasyon Formu
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
                <p>Adınız</p>
                <input name="CustomerName" type="text" placeholder="Adınızı Giriniz.." required="">
            </div>
            <div class="form-mid-w3ls">
                <p>Soyadınız</p>
                <input name="CustomerLastName" type="text" placeholder="Soyadınızı Giriniz.." required="">
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <p>E-mail</p>
                <input name="CustomerMail" type="email"  placeholder="E-Mail Giriniz.." required="">
            </div>
            <div class="form-mid-w3ls">
                <p>Telefon</p>
                <input type="text" name="CustomerPhone" placeholder="Telefon Giriniz.." required="">
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <p>Biniş Tarihi & Zamanı</p>
                <input id="datepicker"  name="CustomerPickepDate" type="text" placeholder="Tıklayınız.." required="">
                <input type="text" id="timepicker" name="CustomerPickepTime" class="timepicker form-control hasWickedpicker" placeholder="Tıklayınız.." required=""
                       onkeypress="return false;">
                <div class="clear"></div>
            </div>
            <div class="form-mid-w3ls">
                <p>İniş Tarihi & Zamanı </p>
                <input id="datepicker1" name="CustomerDropDate" type="text" placeholder="Tıklayınız.." required="">
                <input type="text" id="timepicker1" name="CustomerDropTime" class="timepicker1 form-control hasWickedpicker" placeholder="Tıklayınız.." required=""
                       onkeypress="return false;">
                <div class="clear"></div>
            </div>
        </div>
        <div class="form-group">

            <input class="btn btn-primary" type="button" onclick="Destination()" value="Konumunuzu Girmek İçin Tıklayınız."
                   style="width: 100%;height: auto;position: center; ">

            <input type="hidden" id="locationlat" name="locationlat" value=""/>
            <input type="hidden" id="locationlog" name="locationlog" value=""/>
            <input type="hidden" id="destinationlat" name="destinationlat" value=""/>
            <input type="hidden" id="destinationlog" name="destinationlog" value=""/>

        </div>

        <div class="form-group">
            <div class="form-mid-w3ls">
                <p>Yolculuk Türü</p>
                <input type="hidden" value="" name="JourneyType" id="JourneyType"/>
                <select  class="form-control JourneyTypeSelect">
                    <option name="JourneyType" value="">Seçiniz..</option>
                    <option name="JourneyType" value="Tek Gidiş">Tek Gidiş</option>
                    <option name="JourneyType" value="Gidiş  Geliş">Gidiş  Geliş</option>
                </select>
            </div>
            <div class="form-mid-w3ls">
                <p>Taksi Tipi</p>
                <input type="hidden" value="" name="TaxiType" id="TaxiType"/>
                <select  class="form-control TaxiTypeSelect">
                    <option name="TaxiType" value="">Seçiniz..</option>
                    <option name="TaxiType" value="3 Kişi">3 Kişi</option>
                    <option name="TaxiType" value="4 Kişi">4 Kişi</option>
                    <option name="TaxiType" value="6 Kişi">6 Kişi</option>
                    <option name="TaxiType" value="8 Kişi">8 Kişi</option>
                    <option name="TaxiType" value="Daha Fazla">Daha Fazla</option>
                </select>
            </div>
        </div>
        <div class="btnn">
            <input name="reservationForm" type="submit" value="Rezervasyon Oluştur">
        </div>
    </form>
</div>
<div class="copy">
    <p>&copy;2018 Barış Can AKDAĞ | <a href="UserRezervation.php">Rezervasyonlara Gitmek İçin Tıklayınız..</a> </p>
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

            var marker = new L.marker([latitude,longitude],{
                draggable: true
            }).addTo(map);
            $('#locationlat').val(latitude);
            $('#locationlog').val(longitude);
            marker.bindPopup("<b>Taksinin Alacağı </b><br>Konuma Sürekleyiniz..").openPopup();
            marker.on("drag", function(e) {

                var marker = e.target;
                var position = marker.getLatLng();

                map.panTo(new L.LatLng(position.lat, position.lng));
                $('#locationlat').val(position.lat);
                $('#locationlog').val(position.lng);
            });

            var marker2 = new L.marker([latitude,longitude],{
                draggable: true
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
            marker2.bindPopup("<b>Gideğiniz Konuma</b><br>Sürekleyiniz..").openPopup();
        }

    }

    $('.timepicker,.timepicker1').wickedpicker({ twentyFour: false });
</script>

<!-- //Time -->
</body>

</html>