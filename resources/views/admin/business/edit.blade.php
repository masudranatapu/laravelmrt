@extends('admin.layouts.app')

@section('title', 'Edit Business')

@section('content')
    <admin-businesse-edit :business="{{ $business }}" :packages="{{ $packages }}":pricing_plans="{{ $pricingPlans }}" :business_types="{{ $businessType }}"></admin-businesse-edit>
@endsection
