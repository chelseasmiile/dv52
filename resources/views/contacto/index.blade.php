@extends('layouts.layout')
@section('content')
<div>
    <label for="Nombre">Nombre</label>
    <input type="text" name = "Nombre">
    <label for="Correo">Correo</label>
    <input type="email" name = "Correo">
    <button href="{!!route('contacto.create')!!}">Hola</button>
</div>
@endsection