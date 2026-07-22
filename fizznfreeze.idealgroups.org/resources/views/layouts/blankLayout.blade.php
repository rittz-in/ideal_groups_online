@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
    $configData = Helper::appClasses();

    /* Display elements */
    $customizerHidden = $customizerHidden ?? '';

@endphp

@extends('layouts/commonMaster')

@section('layoutContent')
    <!-- Content -->
    @yield('content')
    <style>
        .btn-primary {
            color: #fff;
            background-color: #DCF669;
            border-color: #DCF669;
        }

        :root {
            --bs-primary: #DCF669 !important;
        }
    </style>
    <!--/ Content -->
@endsection
