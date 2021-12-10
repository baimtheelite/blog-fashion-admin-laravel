@extends('layouts.master')

@section('title', 'home')

@section('header')
    <style>
        .cover {
            object-fit: cover;
            width: 80px;
            height: 80px !important;
        }

    </style>
@endsection

@section('content')
    @include('layouts._headercontent', ['title' => 'Dashboard', 'breadcrumbs' => Breadcrumbs::render('dashboard')])

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Pengumuman Dari Admin
                    </div>
                    <div class="card-body">
                        {{-- <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Isi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table> --}}
                        <div class="alert alert-info">
                            {!! $announcement->text !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Aktivitas Terakhir</h3>
                        <div class="card-tools">
                            {{--  --}}
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0" style="overflow-y: scroll; max-height: 500px">
                        <table class="table table-striped table-valign-middle">
                            {{-- <thead>
                                <tr>
                                    <th></th>
                                    <th>Aktivitas</th>
                                </tr>
                            </thead> --}}
                            <tbody>
                                @foreach ($userActivities as $activity)
                                    <tr>
                                        <td>
                                            <a href="{{ route('profile.index', $activity->user_id) }}">
                                                <img src="{{ $activity->user->avatar }}" alt="Ava"
                                                    class="img-circle img-size-32 mr-2">
                                            </a>
                                        </td>
                                        <td>{{ $activity->aktivitas }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($activity->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Members</h3>

                                <div class="card-tools">
                                    <span class="badge badge-danger">{{ $latestUsers->count() }} New Members</span>
                                    {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @foreach ($latestUsers as $user)
                                        <li>
                                            <img class="cover"
                                                src="{{ $user->avatar ?? 'https://pbs.twimg.com/media/BtFUrp6CEAEmsml?format=jpg&name=small' }}"
                                                alt="User Image">
                                            <a class="users-list-name"
                                                href="{{ route('profile.index', $user->id) }}">{{ $user->name }}</a>
                                            <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                                        </li>
                                    @endforeach
                                    {{-- <li>
                                        <img src="dist/img/user8-128x128.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">Norman</a>
                                        <span class="users-list-date">Yesterday</span>
                                    </li> --}}
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer text-center">
                                <a href="javascript:">View All Users</a>
                            </div> --}}
                            <!-- /.card-footer -->
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" onclick="sendNotitificationFCM('Test', 'Body')">Send Notification</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script>
        $(".table").dataTable();
    </script> --}}
@endpush
