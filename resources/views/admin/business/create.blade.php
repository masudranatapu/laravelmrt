@extends('admin.layouts.app')

@section('title', 'Add New Business')

@section('content')
    <admin-businesse-create :packages="{{ $packages }}" :pricingplans="{{ $pricingPlans }}" :businesstype="{{ $businessType }}"></admin-businesse-create>
@endsection
