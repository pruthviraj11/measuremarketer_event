<?php
namespace App\Services;
use App\Repositories\EventRepository;

class EventService
{
    protected EventRepository $eventRepository;

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



    public function getEvent($id)
    {
        $event = $this->eventRepository->find($id);
        return $event;
    }


    public function CountUsers($eventId)
    {
        $events = $this->eventRepository->CountUsers($eventId);
        return $events;
    }




    public function getAllRegistered($eventId)
    {
        $events = $this->eventRepository->getAllRegistered($eventId);
        return $events;
    }


    public function deleteRegisteredUser($id)
    {
        $deleted = $this->eventRepository->deleteRegisteredUser($id);
        return $deleted;
    }


    public function getUserRegistered($id)
    {
        $event = $this->eventRepository->getUserRegistered($id);
        return $event;
    }


    public function CountUserGuests($userId, $eventId)
    {
        $events = $this->eventRepository->CountUserGuests($userId, $eventId);
        return $events;
    }



    public function getUserGuests($userId, $eventId)
    {
        $event = $this->eventRepository->getUserGuests($userId, $eventId);
        return $event;
    }





}
