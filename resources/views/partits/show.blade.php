@extends('layouts.app')
@section('title', "Detall de Partit")

@section('content')
{{-- Usem el component <x-partit> per als detalls --}}
<x-partit 
  :local="$partit['local']" 
  :visitant="$partit['visitant']" 
  :data="$partit['data']"
  :resultat="$partit['resultat'] ?? null" {{-- Passem null si no està definit --}}
/>
@endsection