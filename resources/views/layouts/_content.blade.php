{{-- TEMPLATE BUAT ISI CONTENT WEB --}}

@extends('layouts.master')

@section('title', 'Content')

@section('header')

@endsection

@section('content')

    @include('layouts._headercontent', ['title' => 'Content', 'breadcrumbs' => Breadcrumbs::render('dashboard')])

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Content
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
