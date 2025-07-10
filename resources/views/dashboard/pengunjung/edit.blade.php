@extends('dashboard.layouts.admin')

@section('title', 'Edit Pengunjung')

@section('content')
    <form action="{{ route('pengunjung.update', $pengunjung->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        @csrf
        @method('PUT')
        @include('dashboard.pengunjung.form')
    </form>
@endsection
