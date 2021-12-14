<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use Alert;

class ShippingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::latest()->simplePaginate(6);
        return view('shippings', compact('shippings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = 'smsReminder'; //
        $apiKey   = '863a87ae9c7504d87c1667c90b16bd5809bf33fc9ba28043bf9becea550d2aa9'; //
        $AT       = new AfricasTalking($username, $apiKey);

        $this->validate($request, [
            'cargo_name' => 'required',
            'cargo_desc' => 'required|min:30',
            'sender_name' => 'required',
            'sender_phone' => 'required|min:10|max:10',
            'receiver_name' => 'required',
            'receiver_phone' => 'required',
            'origin' => 'required',
            'bus' => 'required',
            'destination' => 'required',
        ]);

            if ($request->origin === $request->destination) {
                toast('Origin and Destination cannot be the same', 'warning');
                return redirect()->back();
            }

            $ref_id = 'ID-'.random_int(1000000, 9999999);
            $shipping = new Shipping();
            $shipping->txn_id = 'TXN-'.random_int(1000000, 9999999);
            $shipping->cargo_id = $ref_id;
            $shipping->cargo_name = $request->cargo_name;
            $shipping->cargo_desc = $request->cargo_desc;
            $shipping->sender_id = 'SND-'.random_int(1000, 9999);
            $shipping->sender_name = $request->sender_name;
            $shipping->sender_phone = intval($request->sender_phone);
            $shipping->receiver_id = 'RCV-'.random_int(1000, 9999);
            $shipping->receiver_name = $request->receiver_name;
            $shipping->receiver_phone = $request->receiver_phone;
            $shipping->origin = $request->origin;
            $shipping->destination = $request->destination;
            $shipping->bus = $request->bus;

            $save = $shipping->save();

        if ($save) {
            // Get one of the services
            $sender      = $AT->sms();
            $receiver     = $AT->sms();

            // Use the service

            //send message to sender
            $result   = $sender->send([
                'enqueue' => 'true',
                'to'      => '+256' . intval($request->sender_phone),
                'message' => 'Hello ' . $request->sender_name . ', We have received your ' . $request->cargo_name . ' with RefNo: ' . $ref_id . '. Cargo is awaiting shipping. Thank you so much for using our service'
            ]);

            if ($result) {
                 //send message to receiver
                $result   = $receiver->send([
                    'enqueue' => 'true',
                    'to'      => '+256' . intval($request->receiver_phone),
                    'message' => 'Hello ' . $request->receiver_name . ', '. $request->sender_name . ' has ordered for the shipping of ' . $request->cargo_name . ' with RefNo: '. $ref_id . '. You will be notified once shipping starts.  Thank you for using our services.'
                ]);
            }else{
                toast('An error occured. SMS sending failed!', 'warning');
                return redirect()->back();
            }

            toast('Cargo ready for shipping!', 'success');
            return redirect()->back();

        }else{
            toast('An error occured. Please try again later!', 'warning');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $txn = Shipping::find($id);
        return view('show', compact('txn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $username = 'smsReminder'; //
        $apiKey   = '863a87ae9c7504d87c1667c90b16bd5809bf33fc9ba28043bf9becea550d2aa9'; //
        $AT       = new AfricasTalking($username, $apiKey);


        $txn = $request->txn_id;
        $id = Shipping::where('txn_id', $txn)->first();

        $id->status = $request->status;

        $save = $id->save();

        if ($save) {

            // Get one of the services
            $sender      = $AT->sms();
            $receiver     = $AT->sms();

            // Use the service

            //send message to sender
            $result   = $sender->send([
                'enqueue' => 'true',
                'to'      => '+256' . intval($id->sender_phone),
                'message' => 'Hello ' . $id->sender_name . ', Your Cargo ' . $id->cargo_name . ' with RefNo: ' . $id->cargo_id . ' has ' .$request->status. '. Thank you so much for using our service'
            ]);

            if ($result) {
                 //send message to receiver
                $result   = $receiver->send([
                    'enqueue' => 'true',
                    'to'      => '+256' . intval($id->receiver_phone),
                    'message' => 'Hello ' . $id->receiver_name . ', Your Cargo ' . $id->cargo_name . ' with RefNo: ' . $id->cargo_id . ' has ' .$request->status. '. Thank you so much for using our service'
                ]);
            }else{
                toast('An error occured. SMS sending failed!', 'warning');
                return redirect()->back();
            }
            toast('Cargo status updated successfully!', 'success');
            return redirect()->back();
        }else{
            toast('An error occured. Please try again later!', 'warning');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $txn = $request->txn_id;
        $delete = Shipping::where('txn_id', $txn)->delete();

        if ($delete) {
            # code...
            toast('Cargo status deleted successfully!', 'success');
            return redirect()->back();
        }else{
            toast('An error occured. Please try again later!', 'warning');
            return redirect()->back();
        }
    }
}
