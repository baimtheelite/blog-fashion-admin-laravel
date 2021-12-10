@extends('layouts.master')

@section('title', 'Users')

@section('header')

@endsection

@section('content')

    @include('layouts._headercontent', ['title' => 'Users', 'breadcrumbs' => Breadcrumbs::render('user')])

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Users
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
