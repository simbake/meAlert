@extends('layouts.master')

@section('content')
<style type="text/css">
.iframe-rwd  {
position: relative;
padding-bottom: 65.25%;
padding-top: 0px;
height: 0;
overflow: hidden;
}
.iframe-rwd iframe {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
  </style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="row">
          <div class="col-md-2"></div>

           <div class="col-md-10">
            <div class="card">
                <div class="card-header">Map</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class="iframe-rwd">
                    <div id="map"></div>
                  </div>
                </div>
            </div><hr></hr>
          </div></div>
        </div>
    </div>
</div>
<div class="container"></div>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-2"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Chart</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class="">
                    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCLFGxuQi15Sfc3EHJ0qq0uK6FhGED-bwI"></script>
<script src="js/gmaps.js"></script>
<script src="highcharts/highcharts.js"></script>
<script src="highcharts/exporting.js"></script>
<script src="highcharts/export-data.js"></script>
<script>
$(document).ready(function () {
    var map = new GMaps({
        div: '#map',
        lat: -2,
        lng: 38.9062,
        width: '100%',
        height: '800px',
        zoom: 6,
        zoomControl: true,
        zoomControlOpt: {
            style: 'SMALL',
            position: 'TOP_LEFT'
        },
        panControl: false
    });
    load_mapmarkers(map);
    load_chart();
});

function load_mapmarkers(map){
  /*$.ajax({url: "/home_alerts", success: function(result){
          alert(result);
      }});*/
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
                //console.log(key + " -> " + json[key]['facility']['facility_name']);
            }
        }
      }
});
}

function load_chart(){
  Highcharts.chart('container', {
    chart: {
        type: 'column'
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
        <?php //dd($Positive); ?>
        data:[{!!implode(",",$Total_disease)!!}],
        name:"Total Alerts"
      },
      {
      <?php //dd($Positive); ?>
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
