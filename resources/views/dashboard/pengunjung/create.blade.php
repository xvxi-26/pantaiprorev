@extends('dashboard.layouts.admin')

@section('title', 'Tambah Pengunjung')

@section('content')
    <form action="{{ route('pengunjung.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        @csrf
        @include('dashboard.pengunjung.form')
    </form>
@endsection
