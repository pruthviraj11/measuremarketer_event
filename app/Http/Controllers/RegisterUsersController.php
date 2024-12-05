<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use Spatie\Permission\Models\Permission;

use App\Models\Role;
use App\Models\User;

use App\Models\Event;
use App\Models\EventRegister;
use App\Models\EventGuest;
use App\Models\EventCategory;
use App\Models\EventInterest;
use App\Models\EventNotification;


use App\Services\RoleService;
use App\Services\UserService;
use App\Services\EventService;


use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RegisterUsersController extends Controller
{
    protected UserService $userService;
    protected EventService $eventService;
    protected RoleService $roleService;

    public function __construct(UserService $userService, RoleService $roleService, EventService $eventService)
    {
        $this->userService = $userService;
        $this->eventService = $eventService;
        $this->roleService = $roleService;

        $this->middleware('permission:event-list|event-create|event-edit|event-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:event-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:event-delete', ['only' => ['destroy']]);


        // Permission::create(['name' => 'event-list', 'guard_name' => 'web', 'module_name' => 'Events']);
        // Permission::create(['name' => 'event-create', 'guard_name' => 'web', 'module_name' => 'Events']);
        // Permission::create(['name' => 'event-edit', 'guard_name' => 'web', 'module_name' => 'Events']);
        // Permission::create(['name' => 'event-delete', 'guard_name' => 'web', 'module_name' => 'Events']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */


    /*------  View Registerd User Section --------*/
    public function UserRegistered($encrypted_id)
    {
        $id = decrypt($encrypted_id);
        $eventInfo = $this->eventService->getEvent($id);
        $eventName = $eventInfo->name;

        return view('content.apps.event.registeredlist', compact('eventName', 'id'));
    }


    /*------------ Registerd User Lists -------*/
    public function getAllRegistered($eventId)
    {
        $id = $eventId;

        $registered = $this->eventService->getAllRegistered($id);


        return DataTables::of($registered)->addColumn('company_name', function ($row) {

            if (!empty($row->profile_image)) {

                $imageUrl = asset($row->profile_image);
                $UserImage = "<img src='{$imageUrl}' alt='Client Photo' width='50' height='50' style='border-radius: 10px;' class='clientImage'/>";
            } else {
                $UserImage = "<img src='' alt='No Image' width='50' height='50' style='border-radius: 10px;' class='clientImage'/>";
            }
            $UserImage;

            return $UserImage . '</br>' . $row->company_name;



        })->addColumn('email', function ($row) {
            return $row->email;

        })->addColumn('phone', function ($row) {
            return $row->phone;

        })->addColumn('contact_person', function ($row) {
            return $row->contact_person;
        })->addColumn('address', function ($row) {
            return $row->address;
        })->addColumn('guests', function ($row) {

            $encryptedId = encrypt($row->id);

            $userId = $row->id;
            $eventId = $row->event_id;

            $countUsers = $this->eventService->CountUserGuests($userId, $eventId);

            $MessageCount = DB::table('events_notifications as en')
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
                ->count();

            $RegisteredLists = "<a data-bs-toggle='tooltip' title='View Guests' data-bs-delay='400' class=''  href='" . route('app-event-registers-guests', $encryptedId) . "'>$countUsers Guests</a></br>";
            $CountMessage = "<a data-bs-toggle='tooltip' title='View Messages' data-bs-delay='400' class=''  href='" . route('app-event-user-views-messages', $encryptedId) . "'>$MessageCount Messages</a>";

            return $RegisteredLists . $CountMessage;

        })->addColumn('actions', function ($row) {
            $encryptedId = encrypt($row->id);

            $viewDetail = "<a data-bs-toggle='tooltip' title='View Users' data-bs-delay='400' class='me_1 btn-sm btneye ' href='" . route('app-event-user-registered-views', $encryptedId) . "' target='_blank'><i data-feather='eye'></i></a>";
            // Delete Button
            $deleteButton = "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class='btn btn-danger confirm-delete' data-idos='.$encryptedId' id='confirm-color  href='" . route('app-users-destroy', $encryptedId) . "'><i data-feather='trash-2'></i></a>";

            $buttons = "<div class='d-inline-flex align-items-center'>" . $viewDetail . $deleteButton . "</div>";


            return $buttons;
        })->rawColumns(['company_name', 'email', 'phone', 'contact_person', 'address', 'guests', 'actions'])->make(true);
    }


    /*----------  View Registered User Details -----------*/

    public function ViewRegisteredUser($encrypted_id)
    {

        $id = decrypt($encrypted_id);

        $registeredUser = $this->eventService->getUserRegistered($id);
        $categories = EventCategory::all();
        $interests = EventInterest::all();


        if ($registeredUser->category != '') {
            $explodeCategories = explode(",", $registeredUser->category);

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


        if ($registeredUser->interest != '') {
            $explodeinterests = explode(",", $registeredUser->category);

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


        return view('content.apps.event.view_users', compact('registeredUser', 'categoryName', 'interestName'));


    }


    /*--------------  Event Registerd User Delete ---------*/
    public function RegisteredUserDestroy($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);

            $registeredUser = $this->eventService->getUserRegistered($id);

            $eventId = encrypt($registeredUser->event_id);


            $deleted = $this->eventService->deleteRegisteredUser($id);
            if (!empty($deleted)) {
                return redirect()->route("app-event-registers-users", $eventId)->with('success', 'Registered User Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Registered User');
            }
        } catch (\Exception $error) {
            return redirect()->route("app-event-registers-users", $eventId)->with('error', 'Error while editing Registered User');
        }
    }





}