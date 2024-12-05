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

}
