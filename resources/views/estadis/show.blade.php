@extends('layouts.app')
@section('title', "Detall d'Estadi")

@section('content')
<x-estadi :nom="$estadi->nom"   :capacitat="$estadi->capacitat" :equips="$estadi->Equips"/>
@endsection