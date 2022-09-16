<aside class="col-md-12 blog-sidebar">
  <div class="p-3 mb-3 bg-light rounded">
    <h4 class="font-italic">Alerts</h4>
    <!--<p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>-->
    <ul class="list-group list-group-flush">
        <div id="alerts_list">
        </div>
      <ul>
  </div>

  <div class="p-3 bg-light rounded">
    <h4 class="font-italic">Activity Feed</h4>
    <ol class="list-unstyled mb-0 list-group-flush">
      <div id="activity_list"></div>
      {{ $articles=null }}
      @if($articles != null):
      @foreach($archives as $stats)
      <li><a href="/?month={{ $stats['month'] }}&year={{$stats['year']}}">{{ $stats['month'].' '.$stats['year']}}</a></li>
      @endforeach
      @endif
    </ol>
  </div>

  <div class="p-3">
    <h4 class="font-italic">Elsewhere</h4>
    <ol class="list-unstyled">
      <li><a href="#">GitHub</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">Facebook</a></li>
    </ol>
  </div>
</aside>
@section('right_sidejs')
<script src="js/moment.js"></script>
<script>
$(document).ready(function () {
loadAlertsList();
load_alerts_avtivity();
});

function loadAlertsList(){
  $.ajax({
type: 'GET',
url: "{{url('/right_alerts')}}",
dataType: 'json',
success: function(result){
   //var json = JSON.parse(result);
   var json = result;
   var results = "";
     for (var key in result) {
      //  if (json.hasOwnProperty(key)) {
            $("#alerts_list").append("<li class='list-group-item d-flex justify-content-between align-items-center'>"+json[key]['disease_name']+"   <span class='badge badge-primary badge-pill'>"+json[key]['alerts_count']+"</span></li>").fadeIn(500);;
            //console.log(key + " -> " + json[key]['facility']['facility_name']);
      //  }
    }
  }
});
}

function load_alerts_avtivity(){
  $.ajax({
  type: 'GET',
  url: "{{url('/activity_alerts_view')}}",
  dataType: 'json',
  success: function(result){
   //var json = JSON.parse(result);
   var json = result;
   var results = "";
     for (var key in result) {
      //  if (json.hasOwnProperty(key)) {
            $("#activity_list").append("<li class='list-group-item'><span class='float-md-left'>"+json[key]["disease"]['disease_name']+
            "</span><span class='badge badge-info badge-pill float-md-right'><img src='{{route('index')}}/css/svg/clock.svg' class='img-rounded img-responsive ' alt='Responsive image' id='logo' > "+moment(json[key]['created_at']).fromNow()+"</span><br/><span class='float-md-right'><img src='{{route('index')}}/css/svg/octoface.svg' class='img-rounded img-responsive ' alt='Responsive image' id='logo' > "+json[key]["user"]['username']+"</span><br/></li>").fadeIn(500);
            //console.log(key + " -> " + json[key]['facility']['facility_name']);
      //  }
    }
  }
  });
}
</script>
@endsection
