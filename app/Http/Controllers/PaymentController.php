<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Payment;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id)
    {
        $vehicle = Vehicle::where('id',$id)->first();
        return view('payments.create',compact('vehicle'));
    }

    public function processPayment(Request $request,$id)
    {
        $vehicle = Vehicle::where('id',$id)->where('status','active')->first();
        $token = $request->input('stripeToken');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Stripe\Charge::create([
                'amount' => (int) $vehicle->price,
                'currency' => 'USD',
                'source' => $token,
                'description' => 'Payment for vehicle having ID. '.$vehicle->id,
            ]);
            $vehicle->status="sold";
            $vehicle->save();

            $payment = Payment::create([
                'user_id'=>auth()->id(),'amount'=>$vehicle->price,'vehicle_id'=>$id,'extra'=>json_encode($charge->_values)
            ]);
            return redirect()->route('vehicles.index');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('vehicles.index');
        }
    }

}
