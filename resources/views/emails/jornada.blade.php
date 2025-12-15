<x-mail::message>
# Resum de la Jornada {{ $partits->first()->jornada }}

Partits programats:

@foreach($partits as $partit)
- **{{ $partit->equipLocal->nom }}** vs **{{ $partit->equipVisitant->nom }}**
@endforeach

Gràcies,<br>
{{ config('app.name') }}
</x-mail::message>
