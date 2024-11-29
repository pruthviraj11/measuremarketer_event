<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use Spatie\Permission\Models\Permission;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use App\Services\EventService;


use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
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
    public function index()
    {
        return view('content.apps.event.list');
    }


    public function getAll()
    {
        $events = $this->eventService->getAllEvents();

        return DataTables::of($events)->addColumn('event_name', function ($row) {
            return $row->name;
        })->addColumn('event_name', function ($row) {
            return $row->name;
        })->addColumn('start_date', function ($row) {
            return $row->start_date . " " . $row->start_time;

        })->addColumn('end_date', function ($row) {
            return $row->end_date . " " . $row->end_time;

        })->addColumn('hostname', function ($row) {
            return $row->hostname;
        })->addColumn('address', function ($row) {
            return $row->address;
        })->addColumn('users', function ($row) {

            $encryptedId = encrypt($row->id);
            $countUsers = $this->eventService->CountUsers($row->id);

            $RegisteredLists = "<a data-bs-toggle='tooltip' title='View Registered' data-bs-delay='400' class='btn btn-primary'  href='" . route('app-event-registers-users', $encryptedId) . "'>$countUsers </br>Registered </a>";

            return $RegisteredLists;

        })->addColumn('actions', function ($row) {
            $encryptedId = encrypt($row->id);



            // Delete Button
            $deleteButton = "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class='btn btn-danger confirm-delete' data-idos='.$encryptedId' id='confirm-color  href='" . route('app-users-destroy', $encryptedId) . "'><i data-feather='trash-2'></i></a>";

            return $deleteButton;
        })->rawColumns(['event_name', 'start_date', 'end_date', 'hostname', 'address', 'users', 'actions'])->make(true);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            $deleted = $this->eventService->deleteEvent($id);
            if (!empty($deleted)) {
                return redirect()->route("app-event-list")->with('success', 'Event Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Event');
            }
        } catch (\Exception $error) {
            return redirect()->route("app-event-list")->with('error', 'Error while editing Events');
        }
    }


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
            return $row->company_name;
        })->addColumn('company_name', function ($row) {
            return $row->company_name;
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


            $RegisteredLists = "<a data-bs-toggle='tooltip' title='View Guests' data-bs-delay='400' class='btn btn-primary'  href='" . route('app-event-registers-guests', $encryptedId) . "'>$countUsers </br> Guests</a>";

            return $RegisteredLists;

        })->addColumn('actions', function ($row) {
            $encryptedId = encrypt($row->id);

            // Delete Button
            $deleteButton = "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class='btn btn-danger confirm-delete' data-idos='.$encryptedId' id='confirm-color  href='" . route('app-users-destroy', $encryptedId) . "'><i data-feather='trash-2'></i></a>";

            return $deleteButton;
        })->rawColumns(['event_name', 'start_date', 'end_date', 'hostname', 'address', 'guests', 'actions'])->make(true);
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


    /*-------  Registered Guest information -----------*/

    public function RegisteredGuests($encrypted_id)
    {
        $id = decrypt($encrypted_id);
        $registredInfo = $this->eventService->getUserRegistered($id);

        $userId = $registredInfo->id;
        $eventId = $registredInfo->event_id;

        $eventInfo = $this->eventService->getEvent($eventId);
        $eventName = $eventInfo->name;

        $registeredUser = $registredInfo->company_name;

        // $users = $this->eventService->getUserGuests($userId, $eventId);
        //$eventInfo = $this->eventService->getEvent($id);
        // $eventName = $eventInfo->name;



        return view('content.apps.event.registered_user_list', compact('eventName', 'registeredUser', 'id', 'eventId'));
    }


    /*------  Registered User Guest Details ---*/
    public function getAllRegisteredGuests($id)
    {
        $registredInfo = $this->eventService->getUserRegistered($id);

        $userId = $registredInfo->id;
        $eventId = $registredInfo->event_id;

        $guests = $this->eventService->getUserGuests($userId, $eventId);

        return DataTables::of($guests)->addColumn('name', function ($row) {
            return $row->name;
        })->addColumn('name', function ($row) {
            return $row->name;
        })->addColumn('phone', function ($row) {
            return $row->phone;

        })->addColumn('email', function ($row) {
            return $row->email;

        })->rawColumns(['name', 'phone', 'email'])->make(true);


    }














}
