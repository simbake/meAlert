@extends('layouts.master')

@section('content')

<h1>Create an alert</h1>
<hr>
<form method="POST" action="{{route('index')}}/response/store/{{ $alert->id }}">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="alert_code"><strong>Alert Code</strong></label>
    <input type="text" class="form-control" id="alert_code" name="alert_code" disabled value="{{ $alert->alert_code }}">
  </div>
  <div class="form-group">
    <label for=""><strong>Action Taken: </strong></label><br/>
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="phone_call" id="phone_call" value="Phone call">
  <label class="form-check-label" for="phone_call">Phone call</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="visited" id="visited" value="Visited">
  <label class="form-check-label" for="visited">Visited</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="sample_taken" id="sample_taken" value="Sample Taken">
  <label class="form-check-label" for="sample_taken">Sample Taken</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="investigations_made" id="investigations_made" value="Investigations made">
  <label class="form-check-label" for="investigations_made">Investigations made</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="public_health_action_taken" id="public_health_action_taken" value="Public Health Action Taken">
  <label class="form-check-label" for="public_health_action_taken">Public Health Action Taken</label>
</div>
  </div>
  <div class="form-group" id="public_health_action">
    <label for="public_action"><strong>Public Health Action Taken</strong></label>
    <select class="form-control" onchange="showfields_public_action()" name="public_action" id="public_action">
    <option value="Sprayed">Sprayed</option>
    <option value="Cases searched in community">Cases searched in community</option>
    <option value="Treated water">Treated water</option>
    <option value="Conducted public awareness">Conducted public awareness</option>
    <option value="Other">Other</option>
    </select>
  </div>
  <div class="form-group" id="other_public_health_action">
    <textarea class="form-control" id="other_public_action" name="other_public_action"></textarea>
  </div>

  <div class="form-group">
    <label for="findings"><strong>Findings</strong></label>
    <select class="form-control" onchange="showfields_findings_other()" name="findings" id="findings">
    <option value="Meets case definition">Meets case definition</option>
    <option value="Doesn't meet case definition">Doesn't meet case definition</option>
    <option value="Confrimed outbreak">Confirmed outbreak</option>
    <option value="Other">Other</option>
    </select>
  </div>

  <div class="form-group" id="findings_other">
    <textarea class="form-control" id="other_findings" name="other_findings"></textarea>
  </div>

  <div class="form-group">
    <textarea class="form-control" name="comments" id="comments" placeholder="Comments"></textarea>

  </div>

  <button type="submit" class="btn btn-primary">Create Response</button>
</form>
@include('layouts.errors')
@endsection

@section('js')

<script>
$(function() {
$('#public_health_action').hide();
$('#other_public_health_action').hide();
$('#findings_other').hide();
})
$("#public_health_action_taken").click( function(){
   if( $(this).is(':checked') ){
     $('#public_health_action').show();
     showfields_public_action();
   }else{
     $('#public_health_action').hide();
     $('#other_public_health_action').hide();
   }
});

function showfields_public_action(){
  var value = document.getElementById('public_action').value;
  if(value == 'Other'){
    $('#other_public_health_action').show();
  }
  else{
    $('#div_county').hide();
    $('#other_public_health_action').hide();;
  }
}
function showfields_findings_other(){
  var value = document.getElementById('findings').value;
  if(value == 'Other'){
    $('#findings_other').show();
  }
  else{
    $('#findings_other').hide();
  }
}
</script>
@endsection
