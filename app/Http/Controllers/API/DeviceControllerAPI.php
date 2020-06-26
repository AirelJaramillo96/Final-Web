<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
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

    public function change_value(DeviceRequest $request)
    {
        $device = Device::where('name', $request->name)->first();

        if ($device) {
            if ($device->status === 0)
                $device->status = 1;
            else
                $device->status = 0;

            $device->save();

            return $device->status ? 'true' : 'false';
        } else {
            return 'Dispositivo no encontrado';
        }


    }

}
