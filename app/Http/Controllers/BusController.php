<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buses = Bus::paginate(5);
        return view('buses', compact('buses'));
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
        $this->validate($request, [
            'bus_no' => 'required'
        ]);

        $bus = new Bus();
        $bus->bus_no = $request->bus_no;

        $save = $bus->save();

        if ($save) {
            toast('Bus added successfully', 'success');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy($bus)
    {
        $delete = Bus::findOrFail($bus);
        if ($delete->delete()) {
            toast('Bus removed successfully', 'success');
            return redirect()->back();
        }else{
            toast('An error occured. Try again later', 'warning');
            return redirect()->back();
        }
    }
}
