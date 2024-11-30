<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Event;
use Yajra\DataTables\Facades\DataTables;

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

    public function RegisterdEvent(Request $request)
    {
        if (!Session::has('user')) {
            return redirect()->route('login');  // Redirect to login if the user is not logged in
        }

        $userId = Session::get('user')->id;

        // Get the event registrations for the user
        $eventRegisters = EventRegister::where('id', $userId)
            ->whereNull('deleted_at') // Only non-deleted events
            ->get();

        // Get event details based on registered event IDs
        $events = Event::whereIn('id', $eventRegisters->pluck('event_id'))
            ->get();

        // Check if it's an AJAX request and return the events as JSON
        if ($request->ajax()) {
            return DataTables::of($events)
                ->addColumn('event_date', function ($event) {
                    // Combine Start Date, Start Time, End Date, and End Time
                    $startDate = $event->start_date ?? '-';
                    $startTime = $event->start_time ?? '-';
                    $endDate = $event->end_date ?? '-';
                    $endTime = $event->end_time ?? '-';

                    // Return combined date and time
                    return $startDate . ' ' . $startTime . ' - ' . $endDate . ' ' . $endTime;
                })
                ->addColumn('action', function ($event) {
                    // Encrypt the event ID
                    $encryptedId = encrypt($event->id);

                    // Return the button with the encrypted ID
                    return '<button class="btn btn-primary btn-sm view-community" data-id="' . $encryptedId . '">View Community</button>';
                })
                ->make(true);
        }

        return view('users_welcome', compact('events'));
    }


    public function view($encryptedId)
    {
        // dd($encryptedId);
        $eventId = decrypt($encryptedId);
        $event = Event::findOrFail($eventId);
        $registrants = EventRegister::where('event_id', $eventId)->get();

        return view('community_view', compact('event', 'registrants'));
    }


}
