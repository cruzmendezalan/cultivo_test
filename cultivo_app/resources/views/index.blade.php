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
          <div class="col-md-12">
            <a href="{!!route('locations.index') !!}" title="" class="btn btn-primary">Admin</a>
          </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                  {{-- Impresion de las locaciones --}}
                  @forelse ($locations as $location)
                      <button type="button" class="btn btn-default btn-block" lat="{!! $location->latitud !!}" lng="{!! $location->longitud !!}" _id="{!! $location->id !!}" onclick="marker_change(this)">{!! $location->nombre !!}, visitas: {!! $location->visitas !!}</button>
                  @empty
                      <button type="button" class="list-group-item">"No hay locaciones registradas"</button>
                  @endforelse
            </div>
            <div class="col-md-8"><div id="map" style="height: 300px;"></div></div>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="modal_locacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  {!! Form::open(['route' => 'locations.store', 'class' => 'form-horizontal']) !!}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar locación</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        <div class="col-md-2">
                            {!! Form::label('nombre_locacion', 'Nombre: ') !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::text('nombre_locacion', null,array('class'    => 'form-control', 
                                                                'required' => 'required')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            {!! Form::label('latitud_locacion', 'Latitud: ') !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::text('latitud_locacion', null,array('class'    => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            {!! Form::label('longitud_locacion', 'Longitud: ') !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::text('longitud_locacion', null,array('class'    => 'form-control')) !!}
                        </div>
                    </div>
                 
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar ubicacion</button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>

    <!-- Scripts -->
    {!! Html::script('assets/js/jquery-3.1.1.min.js') !!}
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    <script type="text/javascript">
        var map
        var marker
        var nombre_locacion
        var location_id
        var infowindow

        @if ($locations->first())
          var contentString = load_content_string({!! $locations->first()->id !!})
        @else
          var contentString = load_content_string()
        @endif
        
        
        function initMap() {
          @if ($locations->first())
            var ubicacion = {lat: {!! $locations->first()->latitud !!}, lng: {!! $locations->first()->longitud !!}};
          @else
            var ubicacion = {lat: 19.054299, lng: -98.224034};
          @endif
          map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: ubicacion
          });

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 400
          });

          @if ($locations->first())
            marker = new google.maps.Marker({
              position: ubicacion,
              map: map,
              animation: google.maps.Animation.DROP,
              title: 'Alguna ubicación X'
            });

          marker.addListener('click', function() {
            $("#latitud_locacion").val(marker.getPosition().lat())
            $("#longitud_locacion").val(marker.getPosition().lng())
            infowindow.open(map, marker);
          });
          @endif
        }
        
        function load_content_string(id){
          var str = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h1 id="firstHeading" class="firstHeading">Marca tu visita</h1>'+
                    '<div id="bodyContent" class="text-center">'+
                    '{!! Form::open(['route' => 'cultivo.store', 'class' => 'form-horizontal']) !!}'+
                    '<div class="col-md-12">'+
                      '<div class="form-group">'+
                        '<input type="hidden" name="ubicacion_id" id="ubicacion_id" value="'+id+'">'+
                        '<input type="email" name="visit_email" value="" placeholder="tu dirección de correo" class="form-control" required>'+  
                      '</div>'+
                      '<button type="submit" class="btn btn-success">Hacer check in</button>'+
                    '</div>'+
                    '{!! Form::close() !!}'
                    '</div>'+
                    '</div>';
          return str;
        }

        function marker_change(obj){
          ubicacion = {lat: parseFloat($(obj).attr('lat')), lng: parseFloat($(obj).attr('lng'))};
          infowindow.setContent(load_content_string($(obj).attr('_id')))
          marker.setPosition(ubicacion);
        }
    </script>
</body>
</html>