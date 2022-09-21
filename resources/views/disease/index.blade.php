@extends('layouts.master')

@section('content')
@Guest

@else
@if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "County Administrator" || Auth::user()->access_level == "Sub-County Administrator")
<a href="{{route('index')}}/disease/create" class="btn btn-primary">New Disease</a>
@endif
@endguest
<hr>

<table id='datatable' class="table table-striped table-hover table-bordered table-hover table-responsive-md" style="width:100%!important">
<thead>
  <tr><?php $counter = 1; ?>
    <th>Disease acronym</th>
    <th>Disease name</th>
    <th>Case definition</th>
    <th>Lab sample handling</th>
  </tr>
</thead>
<tbody>
  @foreach($diseases as $disease)
  <tr>
    <td>{{ $disease->disease_acronym }}</td>
    <td>{{ $disease->disease_name }}</td>
    <td>
      <center>
      <button type="button" name="{{ $disease->disease_name }}"  data-case="Case Definition" id="case_definition" class="btn btn-outline-secondary btn-sm button_this" data-toggle="modal"  data-whatever="{!! $disease->case_definition !!}">Case Definition</button>
    </center>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Case Definition</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
</td>
    <td>
      <center>
     <button type="button" name="{{ $disease->disease_name }}" data-case="Lab sample handling" id="lab_sample" class="btn btn-outline-secondary btn-sm button_this" data-toggle="modal" data-target="#exampleModal" data-whatever="{!! $disease->lab_sample_handling !!}">Lab Sample Handling</button>
   </center>
    </td>
  </tr>
  @endforeach
</tbody>
</table>
@endsection

@section('js')
<script>
(function($){
    // Define click handler.
    $('.button_this').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id')

        show_modal($(this))
    });
    function show_modal(button_data){
     var modalz=$('#exampleModal')
     var modal_title = button_data.data('case')+" for "+button_data.attr('name')
     var modal_body = button_data.data('whatever')
     modalz.find('.modal-title').text(modal_title)
     modalz.find('.modal-body').text(modal_body)
     modalz.modal('show')
      //alert(button_id);
    }
  }(jQuery));
/*$(document).ready(function(){

});*/
/*
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = event.srcElement // Button that triggered the modal
  var recipient = button.data('whatever')
  alert(recipient) // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  var title = button.attr('name');
  button.attr('name')
  if(title == "case_definition"){
  modal.find('.modal-title').text("Case Definition for "+button.attr('name'));
}else if(title == "lab_sample"){
  modal.find('.modal-title').text("Lab Sample Handling for "+button.attr('name'));
}
  modal.find('.modal-body').text(recipient)
})*/
</script>
@endsection
