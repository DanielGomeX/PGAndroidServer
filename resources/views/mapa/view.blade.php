@extends('layout.base')
@section('content')


<div class="panel panel-primary">
	<div class="panel-heading">
		
	</div>
  <div class="panel-body">
  		<div id="map" style="height:500px"></div>	  
  </div>
</div>

@endsection
@section('scripts')
  <script>

var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -23.5669599, lng: -46.6940476},
    zoom: 17
  });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
        async defer></script>

@endsection