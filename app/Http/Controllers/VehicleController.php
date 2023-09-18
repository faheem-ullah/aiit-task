<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index()
    {
        $query = Vehicle::query();
        $query->when(auth()->user()->role=="seller",function($q){
            $q->where('user_id', auth()->id());
        });

        $query->when(auth()->user()->role=="buyer",function($q){
            $q->where('status','active');
        });
        $vehicles = $query->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'mileage' => 'required|integer',
            'transmission' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Each image up to 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $files = array();
            foreach ($request->images as $image) {
                $file = time() . '-vehicle.' . $image->getClientOriginalExtension();
                $image->move('storage/vehicles', $file);
                $file = 'storage/vehicles/' . $file;
                $files[] = $file;
            }

            $vehicle = new Vehicle();
            $vehicle->title = $request->input('title');
            $vehicle->model = $request->input('model');
            $vehicle->user_id = auth()->id();
            $vehicle->mileage = $request->input('mileage');
            $vehicle->transmission = $request->input('transmission');
            $vehicle->price = $request->input('price');
            $vehicle->images = json_encode($files);
            $vehicle->save();

            return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function edit($id)
    {
        $vehicle = Vehicle::where('id', $id)->where('user_id', auth()->id())->first();
        if($vehicle){
            return view('vehicles.edit', compact('vehicle'));
        }
        return redirect()->back()->with('error','Record does not exist');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'mileage' => 'required|integer',
            'transmission' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->title = $request->input('title');
        $vehicle->model = $request->input('model');
        $vehicle->user_id = auth()->id();
        $vehicle->mileage = $request->input('mileage');
        $vehicle->transmission = $request->input('transmission');
        $vehicle->price = $request->input('price');
        $vehicle->save();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully');
    }

    public function destroy($id)
    {
        try {
            $vehicle = Vehicle::where('id', $id)->where('user_id', auth()->id())->first();
            $vehicle->delete();

            return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function purchase($id)
    {

    }
}
