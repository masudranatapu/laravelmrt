@extends('backend.layouts.app')

@section('title', 'User Profile')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/bundles/jquery-selectric/selectric.css') }}">
@endpush

@section('content')
    <section class="section">
        <backend-profile></backend-profile>
    </section>
@endsection

@push('js')
    <script src="{{ asset('backend/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endpush
