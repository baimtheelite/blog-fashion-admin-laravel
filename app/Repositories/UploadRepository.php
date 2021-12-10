<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class UploadRepository {

    public function upload($request, $name) {
        if($request->has($name)) {
            $file = $request->file($name);
            $namaFile = $name . '_' . customTanggal(date('Y-m-d H:i:s'), 'dmY His') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs(
                'public/'. $name, $namaFile
            );

            return Storage::url($path);
        }
    }

    public function remove($path)
    {
        return Storage::delete($path);
    }
}
