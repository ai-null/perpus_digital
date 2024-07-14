<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    public function isLate($data): bool
    {
        return ($data->status == config('constants.peminjaman.status.2')
            || $data->status == config('constants.peminjaman.status.6'))
            && $data->created_at > $data->return_at;
    }
}
