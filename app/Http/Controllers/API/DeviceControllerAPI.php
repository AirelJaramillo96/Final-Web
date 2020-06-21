<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceControllerAPI extends Controller
{

    public function index()
    {

        $data = Device::all();

        $count = $data->count();
        return compact('data', 'count');
    }

}
