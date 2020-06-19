<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class DeviceController extends Controller
{

    public function index()
    {
        $query = Input::get('query', false);
        $data = Device::all();
        $limit = Input::get('limit', false);
        $page = Input::get('page', false);
        if ($limit&&$query)

            foreach (json_decode($query, true) as $column => $value)
                if ($value !== "") {

                    $data = $data->filter(function ($article) use ($column, $value) {
                        return strpos(strtolower($article->$column), strtolower($value)) !== false;
                    });

                }
        $count = $data->count();
        $data = $data->slice(($page - 1) * $limit)->take($limit)->values();
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
