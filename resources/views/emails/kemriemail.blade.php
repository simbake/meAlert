@component('mail::message')
Hi {{$user->name}},

{{$alert->alert_code}}. A suspected case of {{$alert->disease->disease_name}},
has been found as '{{$results->specimen_results}}' by KEMRI on {{$results->created_at->toDayDateTimeString()}}.



@component("mail::button", ["url" => ""])
View in browser
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
