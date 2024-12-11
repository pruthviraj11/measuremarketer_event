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
use App\Models\EventCategory;
use App\Models\EventInterest;



use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;
use App\Models\EventNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSent;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;

class EventRegisterController extends Controller
{

    public function showJoinEventForm()
    {
        $categories = EventCategory::all();
        $interests = EventInterest::all();
        return view('join_event', compact('categories', 'interests'));
    }



    public function store(Request $request)
    {


        // $request->validate([
        //     'company_name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:event_registers,email',
        //     'phone' => 'required|digits:10',
        //     'password' => 'required|min:4|confirmed',
        //     'designation' => 'required|string|max:255',
        // ], [

        //     'phone.digits' => 'Phone number must be 10 digits.',
        // ]);


        $eventRegister = new EventRegister();


        if ($request->category == '') {
            $categories = '';
        } else {
            $categories = implode(",", $request->category);
        }

        if ($request->interests == '') {
            $interests = '';
        } else {
            $interests = implode(",", $request->interests);
        }

        $formType = $request->registration_type;



        if ($formType == "company") {
            $eventRegister->company_name = $request->company_name;
            $eventRegister->total_experience = $request->total_experience;
            $eventRegister->contact_person = $request->contact_person;
            $eventRegister->designation = $request->designation;
            $eventRegister->email = $request->email;
            $eventRegister->phone = $request->phone;
            $eventRegister->linkedin = $request->linkedin;
            $eventRegister->address = $request->address;

            if ($request->email_check != '') {
                $eventRegister->email_check = $request->email_check;
            } else {
                $eventRegister->email_check = "0";
            }

            if ($request->phone_check != '') {
                $eventRegister->phone_check = $request->phone_check;
            } else {
                $eventRegister->phone_check = "0";
            }

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
        } else {
            $eventRegister->full_name = $request->individual_full_name;
            $eventRegister->email = $request->individual_email;
            $eventRegister->phone = $request->individual_phone;
            $eventRegister->linkedin = $request->individual_linkedin;
            $eventRegister->company_name = $request->individual_company_name;
            $eventRegister->designation = $request->individual_designation;
            $eventRegister->total_experience = $request->individual_total_experience;
            $eventRegister->address = $request->individual_address;
            $eventRegister->bio = $request->individual_bio;

            if ($request->individual_email_check != '') {
                $eventRegister->email_check = $request->individual_email_check;
            } else {
                $eventRegister->email_check = "0";
            }

            if ($request->individual_phone_check != '') {
                $eventRegister->phone_check = $request->individual_phone_check;
            } else {
                $eventRegister->phone_check = "0";
            }
        }

        $eventRegister->event_id = 1;
        $eventRegister->form_type = $request->registration_type;
        $eventRegister->category = $categories;
        $eventRegister->interest = $interests;
        $eventRegister->password = Hash::make($request->password);
        // $eventRegister->password = encrypt($request->password);




        // $eventRegister->email = $request->email;
        // $eventRegister->address = $request->input('address-1');
        // $eventRegister->phone = $request->phone;
        // $eventRegister->password = Hash::make($request->password);
        // // $eventRegister->password = encrypt($request->password);
        // $eventRegister->designation = $request->designation;

        // $eventRegister->linkedin = $request->linkedin;
        // $eventRegister->total_experience = $request->total_experience;

        // $eventRegister->category = $categoryies;
        // $eventRegister->interest = $interests;
        // $eventRegister->event_id = 1;

        // $eventRegister->form_type = $request->registration_type;

        // $regType = $request->registration_type;
        // if ($regType == "company") {
        //     $eventRegister->contact_person = $request->contact_person;
        //     if ($request->hasFile('profile_image')) {
        //         $image = $request->file('profile_image');
        //         $directory = public_path('images/profilephoto');
        //         if (!file_exists($directory)) {
        //             mkdir($directory, 0777, true);
        //         }
        //         $imageName = time() . '.' . $image->getClientOriginalExtension();
        //         $image->move($directory, $imageName);
        //         $eventRegister->profile_image = 'images/profilephoto/' . $imageName;
        //     }

        // } else {

        //     $eventRegister->full_name = $request->full_name;
        //     $eventRegister->bio = $request->bio;

        // }



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


        $messageInfo = [];

        foreach ($chatDetails as $chatDetail) {
            $companyname = EventRegister::where('id', $chatDetail->sent_by)->first();
            $messageCompany['company_name'] = $companyname->company_name;
            $messageCompany['id'] = $chatDetail->id;
            $messageCompany['user_id'] = $chatDetail->user_id;
            $messageCompany['event_id'] = $chatDetail->event_id;
            $messageCompany['message'] = $chatDetail->message;
            $messageCompany['sent_by'] = $chatDetail->sent_by;
            $messageCompany['read_by'] = $chatDetail->read_by;
            $messageCompany['status'] = $chatDetail->status;
            $messageCompany['created_at'] = $chatDetail->created_at;
            $messageCompany['updated_at'] = $chatDetail->updated_at;

            array_push($messageInfo, $messageCompany);
        }


        $messageDatas = $messageInfo;

        // dd($messageDatas);

        $getPerson = EventRegister::where('id', $CompanyId)->first();
        return view('event_chats', compact('chatDetails', 'messageDatas', 'userId', 'username', 'getPerson'));
    }


    /*------ End messages -------*/

    public function editProfile()
    {
        if (!Session::has('user')) {
            return redirect()->route('login');  // Redirect to login if the user is not logged in
        }

        $userId = Session::get('user')->id;

        $user = EventRegister::where('id', $userId)->first();

        $categories = EventCategory::all();
        $interests = EventInterest::all();
        // dd($user);
        // Return the view with user data
        return view('user_profile', compact('user', 'categories', 'interests'));
    }

    /*-----  Profile Button ----*/
    public function ProfileButton()
    {
        $userId = Session::get('user')->id;
        return view('view_profile', compact('userId'));
    }




    public function updateProfile(Request $request)
    {
        $userId = Session::get('user')->id;
        // Get the authenticated user
        $user = EventRegister::findOrFail($userId);

        // Update the user's details

        if ($request->category != "") {
            $categories = implode(",", $request->category);
        } else {
            $categories = '';
        }

        if ($request->interests != "") {
            $interests = implode(",", $request->interests);
        } else {
            $interests = '';
        }








        $formType = $request->registration_type;
        if ($formType == "company") {

            $user->company_name = $request->company_name;
            $user->total_experience = $request->total_experience;
            $user->contact_person = $request->contact_person;
            $user->designation = $request->designation;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->linkedin = $request->linkedin;
            $user->address = $request->address;

            if ($request->email_check != '') {
                $user->email_check = $request->email_check;
            } else {
                $user->email_check = "0";
            }

            if ($request->phone_check != '') {
                $user->phone_check = $request->phone_check;
            } else {
                $user->phone_check = "0";
            }






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

        } else {
            $user->full_name = $request->individual_full_name;
            $user->email = $request->individual_email;
            $user->phone = $request->individual_phone;
            $user->linkedin = $request->individual_linkedin;
            $user->company_name = $request->individual_company_name;
            $user->designation = $request->individual_designation;
            $user->total_experience = $request->individual_total_experience;
            $user->address = $request->individual_address;
            $user->bio = $request->individual_bio;

            if ($request->individual_email_check != '') {
                $user->email_check = $request->individual_email_check;
            } else {
                $user->email_check = "0";
            }

            if ($request->individual_phone_check != '') {
                $user->phone_check = $request->individual_phone_check;
            } else {
                $user->phone_check = "0";
            }



        }

        $user->category = $categories;
        $user->interest = $interests;

        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }

        $user->save();


        $user->form_type = $request->registration_type;





        //$formType = $request->form_type;




        // Handle image upload if present

        // Update the password if provided



        // if ($request->filled('password')) {
        //     $user->password = encrypt($request->password);
        // }

        // Save the updated user information
        $user->save();

        // Redirect with success message
        return redirect()->route('profile.edit')->with('success', 'Your profile has been successfully Updated..!');
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
    public function listEventAttending(Request $request)
    {
        if (Session::has('user')) {
            // $userId = Session::get('user')->id;
            // $eventInfo = EventRegister::where('id', $userId)->first();
            // $eventId = $eventInfo->event_id;


            // $event = Event::findOrFail($eventId);
            // $registrants = EventRegister::where('event_id', $eventId)
            //     ->where('id', '!=', $userId)
            //     ->get();

            // $categories = EventCategory::all();


            // return view('community_view', compact('event', 'registrants', 'categories'));


            $userId = Session::get('user')->id;
            $eventInfo = EventRegister::where('id', $userId)->first();
            $eventId = $eventInfo->event_id;

            $event = Event::findOrFail($eventId);
            $categories = EventCategory::all();

            // Fetch registrants with optional category filter
            $query = EventRegister::where('event_id', $eventId)
                ->where('id', '!=', $userId);

            // if ($request->has('category') && $request->category) {
            //     $query->whereRaw("FIND_IN_SET(?, category)", [$request->category]);
            // }

            // if ($request->has('categories') && is_array($request->categories)) {
            //     $query->where(function ($q) use ($request) {
            //         foreach ($request->categories as $category) {
            //             $q->orWhereRaw("FIND_IN_SET(?, category)", [$category]);
            //         }
            //     });
            // }

            // $registrants = $query->get();


            if ($request->has('categories') && is_array($request->categories)) {
                $query->where(function ($q) use ($request) {
                    foreach ($request->categories as $category) {
                        $q->orWhereRaw("FIND_IN_SET(?, category)", [$category]);
                    }
                });
            }

            $registrants = $query->get()->map(function ($registrant) {
                $registrant->encrypted_id = encrypt($registrant->id); // Add encrypted ID
                return $registrant;
            });





            if ($request->ajax()) {



                return response()->json(['registrants' => $registrants]);
            }

            return view('community_view', compact('event', 'registrants', 'categories'));




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
            'guests.*.designation' => 'nullable|string',
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
                'designation' => $guest['designation'] ?? null,
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


        $eventDetails = Event::where('id', $request->event_id)->first();

        $eventName = $eventDetails->name;

        $eventRegister = EventRegister::where('id', $request->registrant_id)->first();

        if ($eventRegister->form_type == "company") {
            $companyName = $eventRegister->company_name;
        } else {
            $companyName = $eventRegister->full_name;
        }


        //$companyName = $eventRegister ? $eventRegister->company_name : null;


        try {
            // Send an email to the recipient (registrant)
            $registrant = EventRegister::find($request->registrant_id);

            Mail::to($registrant->email)->send(new MessageSent($notification, $companyName, $eventName));

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
        $id = decrypt(value: $encryptedId);
        $getPerson = EventRegister::where('id', $id)->first();
        $name = $getPerson->company_name;
        $email = $getPerson->email;
        $phone = $getPerson->phone;


        $ss = QrCode::size(80)->generate(
            'name: ' . $name . '
        email:' . $email . '
        phone:' . $phone . ''
        );
        if ($getPerson->category != '') {
            $explodeCategories = explode(",", $getPerson->category);

            $dataCat = [];
            foreach ($explodeCategories as $explodeCategory) {
                $carInfo = EventCategory::where('id', $explodeCategory)->first();

                if ($carInfo) {
                    $dataCat[] = $carInfo->category;
                }
            }
            $categoryName = implode(",", $dataCat);

        } else {
            $categoryName = "---";
        }


        if ($getPerson->interest != '') {
            $explodeinterests = explode(",", $getPerson->category);

            $dataInterest = [];
            foreach ($explodeinterests as $explodeinterest) {
                $interestInfo = EventInterest::where('id', $explodeinterest)->first();

                if ($interestInfo) {
                    $dataInterest[] = $interestInfo->name;
                }
            }
            $interestName = implode(",", $dataInterest);

        } else {
            $interestName = "---";
        }


        return view('contact_view', compact('getPerson', 'categoryName', 'interestName', 'ss'));
    }

    public function userQrCode($encryptedId)
    {
        $id = $encryptedId;
        $getPerson = EventRegister::where('id', $id)->first();
        // dd($getPerson->id);

        $ss = QrCode::size(80)->generate(
            'name: name .
        email: email
        phone:phone '
        );
        return view('qr_code', compact('ss'));
    }


}
