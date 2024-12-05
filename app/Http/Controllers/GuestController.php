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

class GuestController extends Controller
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

        })->addColumn('designation', function ($row) {
            return $row->designation ? $row->designation : '-';


        })->addColumn('phone', function ($row) {
            return $row->phone;

        })->addColumn('email', function ($row) {
            return $row->email;

        })->rawColumns(['name', 'phone', 'email'])->make(true);


    }

}
