<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

abstract class BaseController extends Controller
{
    public function isLate($data): bool
    {
        if ($data->status == config('constants.peminjaman.status.6')) { //accepted
            return $data->updated_at > $data->return_at;
        } else if ($data->status == config('constants.peminjaman.status.2')) { //borrowed
            return Carbon::now() > $data->return_at;
        } else {
            return false;
        }
    }
}
