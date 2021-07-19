@component('mail::message')
# You have a new match coming soon

You are a part of the match between {{ $match->teamOne->name }} and {{ $match->teamTwo->name }}
on {{ $matchTime }}. The place of the match is {{ $match->venue }}. For more details,
please visit the link below!

@component('mail::button', ['url' => route('matches')])
Visit Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
