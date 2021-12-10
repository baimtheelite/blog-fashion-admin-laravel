{{-- TEMPLATE BUAT ISI CONTENT WEB --}}

@extends('layouts.master')

@section('title', 'Pengumuman')

@section('header')

@endsection

@section('content')

    @include('layouts._headercontent', ['title' => 'Pengumuman', 'breadcrumbs' => Breadcrumbs::render('dashboard')])

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Pengumuman
                    </div>
                    <div class="card-body">
                        {!! $output !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
