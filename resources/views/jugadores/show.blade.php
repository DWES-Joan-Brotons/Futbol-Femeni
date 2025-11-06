@extends('layouts.app')
@section('title', "Detall de Jugadora")

@section('content')
{{-- Usem el nou component <x-jugadora> --}}
<x-jugadora 
  :nom="$jugadora['nom']" 
  :equip="$jugadora['equip']" 
  :posicio="$jugadora['posicio']"
/>
@endsection