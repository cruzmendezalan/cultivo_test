<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cultivo Demo</title>

    {!! Html::style('assets/css/bootstrap.css') !!}

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRCXFeb0Y9IfVWVXdWyyddbtq6MmWx9-4&callback=initMap"
  type="text/javascript"></script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Cultivo</a>
            </div>

            
        </div>
    </nav>
    <div class="container">
        <div class="row">
        
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="list-group">
                    @forelse ($locations as $location)
                        <button type="button" class="list-group-item">{!! $location->nombre !!}</button>
                    @empty
                        <button type="button" class="list-group-item">"No hay locaciones registradas"</button>
                    @endforelse
                </div>
                <button type="button" class="btn btn-primary" onclick="move_marker();">Agregar ubicación</button>
            </div>
            <div class="col-md-8"><div id="map" style="height: 300px;"></div></div>
        </div>
    </div>

    <!-- Scripts -->
    {!! Html::script('assets/js/jquery-3.1.1.min.js') !!}
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    <script type="text/javascript">
        var map
        var marker
        
        function initMap() {
          var ubicacion = {lat: 19.054299, lng: -98.224034};
          map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: ubicacion
          });

          var contentString = '<div id="content">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<h1 id="firstHeading" class="firstHeading">El Cultivo</h1>'+
              '<div id="bodyContent">'+
              '<p>Si usted desea guardar esta ubicación, por favor dar click en agregar ubicación.</p>'+
              '</div>'+
              '</div>';

          var infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 200
          });

          marker = new google.maps.Marker({
            position: ubicacion,
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            title: 'Alguna ubicación X'
          });

          marker.addListener('click', function() {
            print_ubi(marker.getPosition().lat(), marker.getPosition().lng())
            infowindow.open(map, marker);
          });
        }

        function print_ubi (lat,lng) {
            console.log(lat);
            console.log(lng);
        }

        function move_marker(){
            ubicacion = {lat: 19.055199, lng: -98.217253};
            marker.setPosition(ubicacion);
            map.setCenter(ubicacion)
        }
    </script>
</body>
</html>