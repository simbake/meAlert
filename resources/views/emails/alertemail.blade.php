@component('mail::message')
Hi {{$user->name}},

{{$alert->alert_code}}. {{$alert->disease->disease_name}} has been reported at {{$alert->facility->facility_name}}
in {{$alert->facility->subcounty->name}},{{$alert->facility->county->name}} County on {{$alert->created_at->toDayDateTimeString()}}.
@component("mail::button", ["url" => "/alerts/$alert->id"])
View details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
