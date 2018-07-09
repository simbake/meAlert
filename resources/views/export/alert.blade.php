<table class="table table-striped table-hover table-bordered table-hover table-responsive" id='datatable' style="width:100%">
  <thead>
  <tr>
    <th>Alert Code</th>
    <th>Facility Reported</th>
    <th>Disease Reported</th>
    <th>Patient Age</th>
    <th>Patient Sex</th>
    <th>Patient Status</th>
    <th>Reported By</th>
    <th>Reported On</th>
  </tr>
</thead>
<tbody>
  @foreach($alerts as $alert)
  <tr>
    <?php //echo gettype($alert->respond); exit;?>
    <td>{{ $alert->alert_code }}</td>
    <td>{{ $alert->facility->facility_name }}</td>
    <td>{{ $alert->disease->disease_name }}</td>
    <td>{{ $alert->age }}</td>
    <td>{{ $alert->sex }}</td>
    <td>{{ $alert->status }}</td>
    <td>{{ $alert->user->name }}</td>
    <td>{{ $alert->created_at->toDayDateTimeString() }}</td>
  </tr>
  @endforeach
</tbody>
</table>
