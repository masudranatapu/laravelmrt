@extends('admin.layouts.app')

@section('title', 'Add New Business')

@section('content')
    <admin-businesse-create :packages="{{ $packages }}" :pricing_plans="{{ $pricingPlans }}" :business_types="{{ $businessType }}"></admin-businesse-create>
@endsection
