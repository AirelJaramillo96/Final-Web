<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class DeviceController extends Controller
{

    public function index()
    {


        $data = Device::all();

        $count = $data->count();
        return compact('data', 'count');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Device
     */
    public function store(Request $request)
    {
        $device = new Device();
        $device->fill($request->all());
        $device->user_id = Auth::user()->id;
        $device->status = 0;
        $device->save();

        return $device;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Device::findOrfail($id);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $device = Device::findOrfail($id);
        $device->fill($request->all());

        $device->save();

        return $device;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::findOrfail($id);
        $device->delete();

        return $device;
    }
}
