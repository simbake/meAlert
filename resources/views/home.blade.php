@extends('layouts.master')

@section('content')
  <div class="row">
<div class="col-xl-6">
    <div class="row">
        <!--<div class="col-md-12">-->
           <div class="col-xl-12">
            <div class="card">
                <div class="card-header">Map</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class="Flexible-container">
                    <div class="map embed-responsive-item" id="map"></div>

                  </div>
                </div>
            </div>
          </div>
        <!--</div>-->
    </div>
</div>

<div class="col-xl-6">
    <div class="row justify-content-center">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">Chart</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class="">
                    <div id="container" style="max-width: 100%; height:500px;"></div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyC8aYtYtDU-hHHL2Td_ksld2gYlRelzhBs"></script>
<script src="js/gmaps.js"></script>
<script src="highcharts/highcharts.js"></script>
<script src="highcharts/exporting.js"></script>
<script src="highcharts/export-data.js"></script>
<script>
$(document).ready(function () {
    var map = new GMaps({
        div: '#map',
        lat: 0,
        lng: 35.9062,
        height: '500px',
        zoom: 6,
    });
    load_mapmarkers(map);
    load_chart();

});
function load_mapmarkers(map){
      $.ajax({
  type: 'GET',
  url: "{{url('/home_alerts')}}",
  dataType: 'json',
  success: function(result){
       //var json = JSON.parse(result);
       var json = result;
       var results = "";
         for (var key in result) {
            if (json.hasOwnProperty(key)) {
              map.addMarker({
 lat: json[key]['latitude'],
 lng: json[key]['longitude'],
 title: json[key]['facility_name'],
 click: function(e) {
    },
    infoWindow: {
      content: "<b><strong>Facility Name:</strong></b> " + json[key]['facility_name'] + "<br/>"+
      "<b><strong>Alerts Reported:</strong></b> "+json[key]["Total"]+"<br/><a href='{{url('/facility_alerts')}}/"+json[key]['facility_id']+"'>View alerts</a>"
    }
           });

            }
        }
      }
});
}

function load_chart(){
  Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'lifetime Alert Analysis'
    },
    //
   xAxis: {
        categories:[<?php echo '"'.implode('","', $diseasez).'"' ?>],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Alerts'
        },
    },
    legend: {
        reversed: false
    },

    /*plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: false
            }
        }
    },*/
    tooltip: {

    },
    series: [
      {

        data:[{!!implode(",",$unconfirmed)!!}],
        name:"Unconfirmed"
      },
      {

      data:[{!!implode(",",$Positive)!!}],
      name:"Positive"
    },{
      data:[{!!implode(",",$Negative)!!}],
      name:"Negative"
    },{
      data:[{!!implode(",",$Undetermined)!!}],
      name:"Indeterminate"
    },{
      data:[{!!implode(",",$Not_done)!!}],
      name:"Not Done"
    }]
});
}
</script>


@endsection
