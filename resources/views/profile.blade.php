@extends('layouts.master')

@section('title', 'Profile')

@section('header')
    <style>
        .avatar {
            width: 300px;
            height: 200px;
            object-fit: fill;
        }

    </style>
@endsection

@section('content')

    @include('layouts._headercontent', ['title' => 'Profile', 'breadcrumbs' => Breadcrumbs::render('profile')])

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <img id="display-avatar" class="img-rounded img-fluid avatar"
                                    src="{{ $user ? $user->avatar : auth()->user()->avatar ?? 'https://pbs.twimg.com/media/BtFUrp6CEAEmsml?format=jpg&name=small' }}"
                                    alt="">
                                <h2 id="display-name" class="mt-4">{{ $user ? $user->name : auth()->user()->name }}</h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="true">Profil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab"
                                            aria-controls="password" aria-selected="false">Ganti Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="activities-tab" data-toggle="tab" href="#activities"
                                            role="tab" aria-controls="activities" aria-selected="false">Aktivitas User</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <form class="mt-2" id="update-profile" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{ auth()->id() }}">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input class="form-control" type="text" name="name"
                                                    value="{{ $user ? $user->name : auth()->user()->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input class="form-control" type="email" name="email"
                                                    value="{{ $user ? $user->email : auth()->user()->email }}">
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="avatar">Avatar</label>
                                                <input class="form-control-file" type="file" name="avatar">
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="">Avatar</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="avatar" id="avatar">
                                                    <label class="custom-file-label" for="avatar">Pilih Avatar</label>
                                                </div>

                                            </div>
                                            <button class="btn btn-primary float-right" type="submit">Simpan</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                        <form class="mt-2" id="update-password" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{ auth()->id() }}">

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" name="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">Password</label>
                                                <input class="form-control" type="password" name="new_password">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password Confirmation</label>
                                                <input class="form-control" type="password" name="confirm_new_password">
                                            </div>
                                            <button class="btn btn-primary float-right" type="submit">Simpan</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="activities" role="tabpanel"
                                        aria-labelledby="activities-tab">
                                        <table class="table table-striped table-valign-middle">
                                            {{-- <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Aktivitas</th>
                                                </tr>
                                            </thead> --}}
                                            <tbody>
                                                @forelse ($user ? $user->activities : Auth::user()->activities as $activity)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ $activity->user->avatar }}" alt="Ava"
                                                                class="img-circle img-size-32 mr-2">
                                                        </td>
                                                        <td>{{ $activity->aktivitas }}</td>
                                                        <td>{{ date('d/m/Y H:i', strtotime($activity->created_at)) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="3">Tidak ada aktivitas tercatat.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script>
        // update profile
        $("form#update-profile").on('submit', function(e) {
            e.preventDefault();

            ajaxPost('{{ route("profile.update") }}', 'POST', new FormData(this));
        });

        // update password
        $("form#update-password").on('submit', function(e) {
            e.preventDefault();

            ajaxPost('{{ route("profile.updatePassword") }}', 'POST', new FormData(this));
        });
    </script>

    @if ($user)
        <script>
            $(document).ready(function() {
                $("input, select, button").attr("disabled", "disabled");
            });
        </script>
    @endif

@endpush
