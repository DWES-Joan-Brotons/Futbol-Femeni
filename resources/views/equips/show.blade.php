@extends('layouts.app')
@section('title', "Detall d'Equip")

@section('content')
<x-equip :nom="$equip['nom']" :estadi="$equip['estadi']" :titols="$equip['titols']"/>
@endsection