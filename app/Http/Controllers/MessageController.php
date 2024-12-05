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

class MessageController extends Controller
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


    public function ViewUserMessages($encrypted_id)
    {
        $userId = decrypt($encrypted_id);

        return view('content.apps.event.user_message', compact('userId'));
    }


    public function ViewAllUserMessages($user_id)
    {
        $userId = $user_id;


        // Query the data
        $eventMessage = DB::table('events_notifications as en')
            ->select(
                'en.id',
                'en.read_by',
                'er.company_name',
                'en.message',
                'en.user_id'
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



        // Prepare the data for DataTables
        return DataTables::of($eventMessage)
            ->addColumn('company_name', function ($row) {
                return $row->company_name;
            })
            ->addColumn('message', function ($row) {
                return $row->message;
            })
            ->addColumn('action', function ($row) {
                $encryptedId = encrypt($row->read_by);
                $UserId = encrypt($row->user_id);

                return "<a data-bs-toggle='tooltip' title='View Messages'  class='btn btn-primary btn-sm'
                data-bs-delay='400' href='" . route('app-event-user-chat-messages', ['encryptedId' => $encryptedId, 'userId' => $UserId]) . "'> <i class='bi bi-chat-dots'></i></a>";
            })
            ->rawColumns(['company_name', 'message', 'action'])
            ->make(true);
    }


    /*--------  View Chat Details ----------*/

    public function ViewUserChatMessages($encrypted_id, $userId)
    {
        $chatId = decrypt($encrypted_id);
        $user_id = decrypt($userId);




        $username = EventRegister::where('id', $user_id)->first();

        $chatDetails = EventNotification::where(function ($query) use ($chatId, $user_id) {
            $query->where('read_by', $chatId)
                ->where('sent_by', $user_id);
        })->orWhere(function ($query) use ($chatId, $user_id) {
            $query->where('read_by', $user_id)
                ->where('sent_by', $chatId);
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




        return view('content.apps.event.view_chats', compact('chatDetails', 'messageDatas', 'user_id'));





    }


}