@extends('layouts.app')
@section('contenido')

<template v-if="menu=='index'">
   <welcome-component></welcome-component>
</template>

<template v-if="menu=='usuarios'">
    <usuario-component></usuario-component>
</template>

<template v-if="menu=='roles'" >
   <role-component></role-component>
</template>

<template v-if="menu=='permisos'">
    <permiso-component></permiso-component>
</template>

<template v-if="menu=='medicamentos'">
    <index-medicamento></index-medicamento>
</template>



@endsection
