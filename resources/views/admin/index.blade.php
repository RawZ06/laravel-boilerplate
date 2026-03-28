@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-home'],
    ]" />
@endsection

@section('content')
Hello
@endsection
