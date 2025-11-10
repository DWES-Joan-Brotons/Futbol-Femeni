@extends('layouts.app')
@section('title', "Detall d'Equip")

@section('content')
<x-equip :nom="$equip->nom" :estadi="$equip->estadi->nom" :titols="$equip->titols"/>
@endsection