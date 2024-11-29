<?php
namespace App\Services;
use App\Repositories\EventRepository;

class EventService
{
    protected EventRepository $userRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents()
    {
        $events = $this->eventRepository->getAll();
        return $events;
    }

    public function deleteEvent($id)
    {
        $deleted = $this->eventRepository->delete($id);
        return $deleted;
    }



    public function getUser($id)
    {
        $user = $this->eventRepository->find($id);
        return $user;
    }


}
