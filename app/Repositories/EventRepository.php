<?php
namespace App\Repositories;

use App\Models\User;

use App\Models\Event;
use App\Models\EventRegister;
use App\Models\EventGuest;




class EventRepository
{

    public function getAll()
    {
        return Event::all();
    }



    public function delete($id)
    {
        return Event::where('id', $id)->delete();
    }

    public function find($id)
    {
        return Event::find($id);
    }

    public function CountUsers($eventId)
    {
        return EventRegister::where('event_id', $eventId)->count();
    }

    public function getAllRegistered($eventId)
    {
        return EventRegister::where('event_id', $eventId)->get();
    }

    public function deleteRegisteredUser($id)
    {
        return EventRegister::where('id', $id)->delete();
    }


    public function getUserRegistered($id)
    {
        return EventRegister::find($id);
    }

    public function CountUserGuests($userId, $eventId)
    {
        return EventGuest::where('user_id', $userId)->where('event_id', $eventId)->count();
    }

    public function CountMessages($userId, $eventId)
    {
        return EventGuest::where('user_id', $userId)->where('event_id', $eventId)->count();
    }



    public function getUserGuests($userId, $eventId)
    {
        return EventGuest::where('user_id', $userId)->where('event_id', $eventId)->get();
    }













    // public function create(array $data)
    // {
    //     return User::create($data);
    // }

    // public function update($id, array $data)
    // {
    //     return User::where('id', $id)->update($data);
    // }



}
