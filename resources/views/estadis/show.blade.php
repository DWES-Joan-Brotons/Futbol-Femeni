@extends('layouts.app')
@section('title', "Detall d'Estadi")

@section('content')
{{-- Usem el nou component <x-estadi> --}}
<x-estadi 
  :nom="$estadi['nom']" 
  :ciutat="$estadi['ciutat']" 
  :capacitat="$estadi['capacitat']" 
  :equip_principal="$estadi['equip_principal']"
/>
@endsection