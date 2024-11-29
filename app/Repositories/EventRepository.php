<?php
namespace App\Repositories;

use App\Models\User;

use App\Models\Event;



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
        return User::find($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        return User::where('id', $id)->update($data);
    }



}
