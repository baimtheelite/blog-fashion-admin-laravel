<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\User;
use App\Notifications\ProfileUpdated;
use App\Repositories\UploadRepository;
use App\Repositories\UserActivityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index($id = null)
    {
        $user = $id ? User::findOrFail($id) : null;

        return view('profile', compact('user'));
    }

    public function update(StoreProfileRequest $request)
    {
        $uploadRepository = new UploadRepository();

        $id = Auth::id();
        $user = User::find($id);

        $data = $request->validated();

        if($avatar = $uploadRepository->upload($request, 'avatar')) {
            $data['avatar'] = $avatar;
        }

        $user->update($data);

        UserActivityRepository::insertLog('Profile', "{$user->name} Memperbarui Profile"); //insert log user_activities

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil memperbarui profile',
            'data' => $data
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());

        //validasi password
        $request->validate([
            'password'              => 'required',
            'new_password'          => 'required|min:5',
            'confirm_new_password'  => 'required|same:new_password'
        ]);

        if (! Hash::check($request->password, $user->password)) {

            return response()->json([
                'status' => 'failed',
                'errors' => [
                    'password' => 'Password Anda salah!'
                ]
            ], 422);
        }

        $encryptedPassword = bcrypt($request->new_password);

        $user->update([
            'password' => $encryptedPassword
        ]);

        UserActivityRepository::insertLog('Profile', "{$user->name} Memperbarui Password"); //insert log user_activities

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah password!'
        ]);

    }
}
