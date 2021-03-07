<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style type="text/css">

        .box{
            padding: 30px 40px;
            border-radius: 5px;
        }

        .icon{
            width: 100px;
        }

        .indonesia{
            width: 150px;
        }

    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pantau Penyebaran Virus Covid-19</title>
  </head>
  <body>

        <div class="jumbotron jumbotron-fluid bg-primary text-white">
            <div class="container text-center">
                <h1 class="display-4">Corona Virus Diseases</h1>
                <p class="lead">
                    <h2> 
                        PANTAU PENYEBARAN VIRUS COVID-19 DI DUNIA
                        <br> SECARA REAL - TIME
                        <br> Mari bersama menjaga kesehatan diri kita
                    </h2>
                </p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="bg-danger box text-white">
                        <div class="row">
                            <div class="col-md-6">

                                <h5>Positif</h5>
                                <h2 id="data-kasus">1234</h2>
                                <h5>Orang</h5>

                            </div>
                            
                            <div class="col-md-4">
                                <img src="img/sad.svg" class="icon">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="bg-info box text-white">
                        <div class="row">
                            <div class="col-md-6">

                                <h5>Meninggal</h5>
                                <h2 id="data-mati">1234</h2>
                                <h5>Orang</h5>

                            </div>
                            
                            <div class="col-md-4">
                                <img src="img/cry.svg" class="icon">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="bg-success box text-white">
                        <div class="row">
                            <div class="col-md-6">

                                <h5>Sembuh</h5>
                                <h2 id="data-sembuh">1234</h2>
                                <h5>Orang</h5>

                            </div>
                            
                            <div class="col-md-4">
                                <img src="img/happy.svg" class="icon">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3 ">
                    <div class="bg-primary box text-white">
                        <div class="row">
                            <div class="col-md-3">

                                <h2>INDONESIA</h2>
                                <h5 id="data-id"> 
                                    Positif : 12 Orang
                                    <br> Meninggal : 20 Orang
                                    <br> Sembuh : 20 Orang
                                </h5>

                            </div>
                            
                            <div class="col-md-4">
                                <img src="img/indonesia.svg" class="indonesia">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- AKhir Row -->

            <div class="card mt-3">
                <div class="card-header bg-danger text-white">
                    <b>Data Kasus Virus Corona Di Indonesia Berdasarkan Provinsi</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Nama Provinsi</th>
                            <th>Positif</th>
                            <th>Sembuh</th>
                            <th>Meninggal</th>
                        </thead>

                        <tbody id="table-data">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Akhir container -->
        
        <footer class="bg-primary text-center text-white mt-3 bt-2 pb-2">
            Copyright © 2020 Aplikasi Ambyarqu | Developed by Sultan Bisri.
        </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  </body>
</html>

<script>
    $(document).ready(function() {

        //panggil fungsi untuk menampilkan semua data global
        semua_data();
        data_negara();
        data_provinsi();

        //untuk refresh otomatis
        setInterval(function(){
            semua_data();
            data_negara();
            data_provinsi();
        }, 3000);


        function semua_data() {
            $.ajax( {
                url : 'https://coronavirus-19-api.herokuapp.com/all',
                success : function(data){
                    try{

                        var json = data;
                        var kasus = data.cases;
                        var meninggal = data.deaths;
                        var sembuh = data.recovered;

                        $('#data-kasus').html(kasus);
                        $('#data-mati').html(meninggal);
                        $('#data-sembuh').html(sembuh);

                    } catch{
                        alert('Error');
                    }
                }
            });
        }

        function data_negara() {
            $.ajax( {
                url : 'https://coronavirus-19-api.herokuapp.com/countries',
                success : function(data){
                    try{

                        var json = data;
                        var html = [];

                        if ( json.length > 0 ) {

                            var i;
                            for(i = 0; i < json.length; i++ ) {
                                var data_negara = json[i];
                                var nama_negara = data_negara.country;

                                if ( nama_negara === 'Indonesia' ) {
                                    var kasus = data_negara.cases;
                                    var mati = data_negara.deaths;
                                    var sembuh = data_negara.recovered;

                                    $('#data-id').html(
                                        'Positif : '+kasus+' Orang <br> Meninggal : '+mati+' Orang <br> Sembuh : '+sembuh+' Orang')
                                    
                                }

                            }

                        }

                    } catch{
                        alert('Error');
                    }
                }
            });

        }

        function data_provinsi() {
            $.ajax( {
                url : 'curl.php',
                type : 'GET',
                success : function(data){
                    try{

                        $('#table-data').html(data);
                
                    } catch{
                        alert('Error');
                    }
                }
            });
        }

    });
</script>