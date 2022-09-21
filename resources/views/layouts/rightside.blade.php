<aside class="">
  <div class="p-3 mb-3 bg-light rounded">
    <h4 class="font-italic">Alerts</h4>
    <!--<p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>-->
    <ul class="list-group list-group-flush">
        <div id="alerts_list">
        </div>
      <ul>
  </div>

  <div class="p-3 mb-0 bg-light rounded">
    <h4 class="font-italic">Activity</h4>
    <!--<p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>-->

    <div class="col-inside-xl decor-default activities rounded" id="activity_list">

    </div>

  </div>

  <!--<div class="p-3">
    <h4 class="font-italic">Elsewhere</h4>
    <ol class="list-unstyled">
      <li><a href="#">GitHub</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">Facebook</a></li>
    </ol>
  </div>-->
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
            $("#alerts_list").append("<li class='list-group-item d-flex justify-content-between align-items-center'>"+json[key]['disease_name']+
            "<span class='badge badge-primary badge-pill'>"+json[key]['alerts_count']+"</span></li>").fadeIn(500);;
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
       $("#activity_list").append("<div class='unit'><a class='avatar' href='#'><img src='{{route('index')}}/css/svg/alert.svg' class='img-responsive' alt='profile'></a><div class='field title'><b>"+
       json[key]["disease"]['disease_name']+
       "</b> reported by  <b>"
       +json[key]["user"]['username']+"</b></div><div class='field date'><span class='f-l'>"+
       moment(json[key]['created_at']).fromNow()+
       "</span></div></div>");
      //  if (json.hasOwnProperty(key)) {
      //  }
    }
  }
  });
}
</script>
@endsection
