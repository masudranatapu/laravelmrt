@extends('admin.layouts.app')

@section('title', 'Add New Business')

@section('content')
    <admin-businesse-create :packages="{{ $packages }}" :pricingPlans="{{ $pricingPlans }}" :businessType="{{ $businessType }}"></admin-businesse-create>
@endsection
