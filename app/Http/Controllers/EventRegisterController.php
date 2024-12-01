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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;
use App\Models\EventNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSent;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            'designation' => 'required|string|max:255',
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
        // $eventRegister->password = encrypt($request->password);
        $eventRegister->designation = $request->designation;

        $eventRegister->linkedin = $request->linkedin;
        $eventRegister->total_experience = $request->total_experience;
        $eventRegister->bio = $request->bio;
        $eventRegister->category = implode(",", $request->category);
        $eventRegister->interest = implode(",", $request->interests);
        $eventRegister->event_id = 1;

        // dd($eventRegister->password);


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

        // dd($eventRegister);
        $eventRegister->save();

        return redirect()->route('join_event')->with('success', 'Thank you for registering! Your spot is confirmed, and we can’t wait to see you at the event!');
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
                    // $startDate = $event->start_date ?? '-';
    
                    // $startDate = Carbon::now()->format('d-m-Y');
                    $startTime = $event->start_time ?? '-';

                    $startDate = $event->start_date = Carbon::parse($event->start_date)->format('d-m-Y');
                    // $event->end_date = Carbon::parse($event->end_date)->format('d-m-Y');
                    // Return combined date and time
                    return $startDate . ' ' . $startTime;
                })
                // ->addColumn('action', function ($event) {
                //     // Encrypt the event ID
                //     $encryptedId = encrypt($event->id);

                //     // Return the button with the encrypted ID
                //     // return '<button class="btn btn-primary btn-sm view-community view_community_btn" data-id="' . $encryptedId . '">View Registered Community</button>';
                // })
                ->make(true);
        }

        return view('users_welcome', compact('events'));
    }



    /*-----------  View Event Message List --------*/
    public function EventMessage(Request $request)
    {
        if (!Session::has('user')) {
            return redirect()->route('login');  // Redirect to login if the user is not logged in
        }

        $userId = Session::get('user')->id;


        // Get the event registrations for the user
        // $eventRegisters = EventNotification::where('id', $userId)
        //     ->whereNull('deleted_at') // Only non-deleted events
        //     ->get();


        $eventMessage = DB::table('events_notifications as en')
            ->select(
                'en.read_by',
                'er.company_name',
                'en.message as messages'
            )
            ->join('event_registers as er', 'en.read_by', '=', 'er.id')
            ->where('en.user_id', $userId)
            ->whereIn('en.id', function ($query) use ($userId) {
                $query->select(DB::raw('MIN(id)'))
                    ->from('events_notifications')
                    ->where('user_id', $userId)
                    ->groupBy('read_by');
            })
            ->get();







        if ($request->ajax()) {
            return DataTables::of($eventMessage)
                ->addColumn('company_name', function ($eventMessage) {
                    // Combine Start Date, Start Time, End Date, and End Time
    
                    return $eventMessage->company_name;
                })->addColumn('message', function ($eventMessage) {
                    // Combine Start Date, Start Time, End Date, and End Time
                    return $eventMessage->messages;

                    // Return combined date and time
    
                })
                ->addColumn('action', function ($eventMessage) {
                    // Encrypt the event ID
                    //$encryptedId = encrypt($event->id);
    
                    $encryptedId = encrypt($eventMessage->read_by);

                    // Return the button with the encrypted ID
                    return '<button class="btn btn-primary btn-sm view-messages view_community_btn" data-id="' . $encryptedId . '">View Messages</button>';
                })
                ->make(true);
        }

        return view('event_messages', compact('eventMessage'));
    }

    /*-----------  End Evet Message List ------------*/


    public function view($encryptedId)
    {
        // dd($encryptedId);
        $eventId = decrypt($encryptedId);
        $event = Event::findOrFail($eventId);
        $registrants = EventRegister::where('event_id', $eventId)->get();
        // dd($registrants);

        return view('community_view', compact('event', 'registrants'));
    }


    /*----- View messages --------*/

    public function eventViewMessages($encryptedId)
    {

        $CompanyId = decrypt($encryptedId);
        $userId = Session::get('user')->id;

        $username = EventRegister::where('id', $userId)->first();

        $chatDetails = EventNotification::where(function ($query) use ($CompanyId, $userId) {
            $query->where('read_by', $CompanyId)
                ->where('sent_by', $userId);
        })->orWhere(function ($query) use ($CompanyId, $userId) {
            $query->where('read_by', $userId)
                ->where('sent_by', $CompanyId);
        })->get();


        return view('event_chats', compact('chatDetails', 'userId', 'username'));
    }


    /*------ End messages -------*/

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
            $user->password = encrypt($request->password);
        }

        // Save the updated user information
        $user->save();

        // Redirect with success message
        return redirect()->route('profile.edit')->with('success', 'Your profile has been successfully Updated !.');
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


    public function listGuests()
    {
        if (Session::has('user')) {
            $userId = Session::get('user')->id;
            $userData = EventGuest::join('events', 'event_guests.event_id', '=', 'events.id')
                ->where('event_guests.user_id', $userId)
                ->whereNull('event_guests.deleted_at') // Filter out soft-deleted guests
                ->select('event_guests.*', 'events.name as event_name')
                ->get();
            return view('list_guests', compact('userData'));
        }

        return redirect()->route('users_login');
    }

    /*------------- Attending List ------*/
    public function listEventAttending()
    {
        if (Session::has('user')) {
            $userId = Session::get('user')->id;
            $eventInfo = EventRegister::where('id', $userId)->first();
            $eventId = $eventInfo->event_id;


            $event = Event::findOrFail($eventId);
            $registrants = EventRegister::where('event_id', $eventId)
                ->where('id', '!=', $userId)
                ->get();

            // $userData = EventGuest::join('events', 'event_guests.event_id', '=', 'events.id')
            //     ->where('event_guests.user_id', $userId)
            //     ->whereNull('event_guests.deleted_at') // Filter out soft-deleted guests
            //     ->select('event_guests.*', 'events.name as event_name')
            //     ->get();
            return view('community_view', compact('event', 'registrants'));
        }

        //return redirect()->route('users_login');
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
    public function deleteGuest($id)
    {
        $guest = EventGuest::find($id);

        // Check if the guest exists
        if ($guest) {
            // Soft delete the guest (sets the deleted_at field)
            $guest->delete();

            // Redirect back with a success message
            return back()->with('success', 'Guest deleted successfully!');
        }

        // If guest not found, return an error
        return back()->with('error', 'Guest not found!');
    }

    public function sendMessage(Request $request)
    {
        $userId = Session::get('user')->id;

        // Save the message in the EventNotification table
        $notification = new EventNotification();
        $notification->user_id = $userId;
        $notification->event_id = $request->event_id;
        $notification->message = $request->message;
        $notification->sent_by = $userId;
        $notification->read_by = $request->registrant_id;
        $notification->created_by = $userId;
        $notification->save();

        try {
            // Send an email to the recipient (registrant)
            $registrant = EventRegister::find($request->registrant_id);
            Mail::to($registrant->email)->send(new MessageSent($notification));

            // If email was sent successfully, update the status to 1 (success)
            $notification->status = 1; // success
            $notification->save();

            // Redirect back with a success message
            return back()->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // If there was an error in sending the email, update the status to 0 (failure)
            $notification->status = 0; // failure
            $notification->save();

            // Redirect back with an error message
            return back()->with('error', 'Failed to send the message. Please try again!');
        }
    }


    public function getContactPerson($encryptedId)
    {
        $id = decrypt($encryptedId);
        $getPerson = EventRegister::where('id', $id)->first();

        return view('contact_view', compact('getPerson'));
    }

    public function userQrCode()
    {
        $ss = QrCode::size(250)->generate('name: Pradip
        email:gpradipdanMicrosoft Message	

        phone:9890988909');
        return view('qr_code', compact('ss'));
    }


}
