<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class EventRegisterController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|unique:event_registers,email',
            'phone' => 'required|digits:10',
            'password' => 'required|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [

            'phone.digits' => 'Phone number must be 10 digits.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $eventRegister = new EventRegister();
        $eventRegister->company_name = $request->company_name;
        $eventRegister->contact_person = $request->contact_person;
        $eventRegister->email = $request->email;
        $eventRegister->address = $request->input('address-1');
        $eventRegister->phone = $request->phone;
        $eventRegister->password = Hash::make($request->password);
        $eventRegister->event_id = 1;


        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $directory = public_path('images/profilephoto');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($directory, $imageName);
            $eventRegister->profile_image = 'images/profilephoto/' . $imageName;
        }


        $eventRegister->save();

        return redirect()->route('join_event')->with('success', 'Registration successful!');
    }

}
