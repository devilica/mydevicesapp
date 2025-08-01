<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{

    public function index(Request $request)
    {
        return $request->user()->devices;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'device_unique_id' => 'required|unique:devices,device_unique_id',
        ]);

        $device = Device::create($request->only('name', 'model', 'device_unique_id'));

        // Attach to current user
        $request->user()->devices()->attach($device->id);

        return response()->json($device, 201);
    }

    public function show($id, Request $request)
    {
        $device = $request->user()->devices()->findOrFail($id);
        return response()->json($device);
    }

    public function update($id, Request $request)
    {
        $device = $request->user()->devices()->findOrFail($id);
        $device->update($request->only(['name', 'model']));
        return response()->json($device);
    }

}
