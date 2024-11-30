<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Event;
use App\Models\EventGuest;
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
                    return '<button class="btn btn-primary btn-sm view-community view_community_btn" data-id="' . $encryptedId . '">View Registered Community</button>';
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

    public function editProfile()
    {
        if (!Session::has('user')) {
            return redirect()->route('login');  // Redirect to login if the user is not logged in
        }

        $userId = Session::get('user')->id;

        $user = EventRegister::where('id', $userId)->first();
        // dd($user);
        // Return the view with user data
        return view('user_profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $userId = Session::get('user')->id;
        // Get the authenticated user
        $user = EventRegister::findOrFail($userId);

        // Update the user's details
        $user->company_name = $request->company_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->contact_person = $request->contact_person;

        // Handle image upload if present
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists in the public directory
            if ($user->profile_image && file_exists(public_path('images/profilephoto/' . $user->profile_image))) {
                unlink(public_path('images/profilephoto/' . $user->profile_image));
            }

            // Store the new image in the 'public/images/profilephoto' directory
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the image to the 'public/images/profilephoto' directory
            $image->move(public_path('images/profilephoto'), $imageName);

            // Update the database with the new image name (relative path)
            $user->profile_image = 'images/profilephoto/' . $imageName;
        }

        // Update the password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user information
        $user->save();

        // Redirect with success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
    public function showFormGuests()
    {
        if (Session::has('user')) {
            $userId = Session::get('user')->id;
            $userData = EventRegister::where('id', $userId)->first();
            $eventId = $userData->event_id;
            return view('add_guests', compact('eventId'));
        }

        return redirect()->route('users_login');
    }


    // Save new guest data
    public function storeGuests(Request $request)
    {
        // Validate the data
        $request->validate([
            'guests.*.name' => 'required|string',
            'guests.*.email' => 'nullable|email',
            'guests.*.phone' => 'nullable|string',
        ]);

        $userId = Session::get('user')->id;
        $eventId = $request->input('event_id'); // Assuming event_id is passed

        // Loop through the guests and save each one
        foreach ($request->guests as $guest) {
            EventGuest::create([
                'user_id' => $userId,
                'event_id' => $eventId,
                'name' => $guest['name'],
                'phone' => $guest['phone'] ?? null,
                'email' => $guest['email'] ?? null,
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);
        }

        return back()->with('success', 'Guests added successfully!');
    }

}
