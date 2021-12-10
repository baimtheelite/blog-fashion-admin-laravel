{{-- TEMPLATE BUAT ISI CONTENT WEB --}}

@extends('layouts.master')

@section('title', 'Artikel')

@section('header')

@endsection

@section('content')

    @include('layouts._headercontent', ['title' => 'Artikel', 'breadcrumbs' => Breadcrumbs::render('article')])

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Artikel
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
