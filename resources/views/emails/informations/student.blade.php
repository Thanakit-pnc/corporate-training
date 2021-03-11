@component('mail::message')
# {{ $content['title'] }}

{{ $content['content'] }}

@component('mail::table')
|Name|Username|Mobile|
|-------------|:-------------:|--------:|
@foreach ($content['students'] as $student)
|{{ $student->name }}|{{ $student->username }}|{{ $student->mobile }}|
@endforeach
@endcomponent

@component('mail::button', ['url' => 'http://localhost/corporate-training/login'])
Click to make test
@endcomponent

[Go to link]({{ url('/') }})

Thanks,<br>
{{ config('app.name') }}
@endcomponent
