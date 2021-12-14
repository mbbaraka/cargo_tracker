<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\Models\Bus;
use App\Models\Location;
use App\Models\Shipping;
use League\Flysystem\Adapter\Local;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get buses
        $buses = Bus::get()->count();
        // cargo
        $cargos = Shipping::where('status', 'picked')->count();
        // shipping now
        $shipping = Shipping::where('status', 'shipping')->count();
        // Receinved
        $received = Shipping::where('status', 'received')->count();
        // Receinved
        $reached = Shipping::where('status', 'reached')->count();
        // Receinved
        // By location
        $location = Location::get();
        return view('home', compact('buses', 'cargos', 'shipping', 'reached', 'received', 'location'));

    }


    /**
     * Show the new transaction page
     *
     */

     public function new () {
        $buses = Bus::get();
        $locations = Location::get();
        return view('new', compact('locations', 'buses'));

     }

    /**
     * Account profile page
     * and account updating
     * */

     public function profile () {
         $user = Auth::user();
         return view('profile', compact('user'));
     }

    /** Change Password */

    public function changePassword (Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");
    }
}
