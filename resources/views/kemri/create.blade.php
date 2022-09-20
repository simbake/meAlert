@extends('layouts.master')

@section('content')
<div class="container">
<h1>Create response</h1>
<hr>
<form method="POST" action="{{route('index')}}/kemri/store/{{ $alert->id }}">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="alert_code"><strong>Alert Code</strong></label>
    <input type="text" class="form-control" id="alert_code" name="alert_code" disabled value="{{ $alert->alert_code }}">
  </div>
  <div class="form-group">
    <label for="specimen_received"><strong>Date Received</strong></label><br/>
    <input type="text" class="form-control" id="specimen_received" name="specimen_received" />
  </div>
  <div class="form-group">
    <label for="specimen_type"><strong>Specimen Type</strong></label>
    <select class="form-control" onchange="showfields_type()" name="specimen_type" id="specimen_type">
    <option value="Stool">Stool</option>
    <option value="Blood">Blood</option>
    <option value="Serum">Serum</option>
    <option value="Human Tissue">Human Tissue</option>
    <option value="Other">Other</option>
    </select>
  </div>
  <div class="form-group" id="other_specimen_type">
    <input type="text" class="form-control" placeholder="Other Specimen Type" name="specimen_type_other" id="specimen_type_other"/>
  </div>

  <div class="form-group">
    <label for="condition"><strong>Specimen condition</strong></label>
    <select class="form-control" onchange="showfields_condition()" name="condition" id="condition">
    <option value="Adequate">Adequate</option>
    <option value="Inadequate">Inadequate</option>
    <option value="Other">Other</option>
    </select>
  </div>

  <div class="form-group" id="condition_other">
    <input type="text" name="other_condition" placeholder="Other Condition" class="form-control" id="other_condition"/>
  </div>

  <div class="form-group">
    <label for="results"><strong>Results:</strong></label>
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="results" id="Positive" value="Positive">
  <label class="form-check-label" for="Positive">Positive</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="results" id="Negative" value="Negative">
  <label class="form-check-label" for="Negative">Negative</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="results" id="Indeterminate" value="Indeterminate">
  <label class="form-check-label" for="Indeterminate">Indeterminate</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="results" id="not_done" value="Not Done">
  <label class="form-check-label" for="not_done">Not Done</label>
</div>
  </div>

  <div class="form-group">
    <textarea class="form-control" name="comments" id="comments" placeholder="Comments"></textarea>

  </div>

  <button type="submit" class="btn btn-primary">Create Response</button>
</form>
</div>
@include('layouts.errors')
@endsection

@section('js')

<script>
$(function() {
$('#other_specimen_type').hide();
$('#condition_other').hide();
$('#specimen_received').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
})
function showfields_type(){
  var value = document.getElementById('specimen_type').value;
  if(value == 'Other'){
    $('#other_specimen_type').show();
  }
  else{
    $('#other_specimen_type').hide();
  }
}
function showfields_condition(){
  var value = document.getElementById('condition').value;
  if(value == 'Other'){
    $('#condition_other').show();
  }
  else{
    $('#condition_other').hide();
  }
}
</script>
@endsection
