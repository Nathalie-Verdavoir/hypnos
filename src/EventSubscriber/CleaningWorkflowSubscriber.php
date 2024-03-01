<?php

//to_clean guard
namespace App\EventSubscriber;

use App\Repository\ReservationRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\GuardEvent;

class CleaningWorkflowSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'workflow.your_workflow.guard.to_clean' => 'onTransitionToClean',
        ];
    }

    public function onTransitionToClean(GuardEvent $event, ReservationRepository $reservationRepository)
    {
        $chambre = $event->getSubject();
        //if no reservation, then we can clean
        $resa = $reservationRepository->getResa(new \DateTime('now'), $chambre);
        // Add your conditions here
        if ($chambre->isConditionNotMet()) {
            // Block the transition
            $event->setBlocked(true);
        }
    }

    public function onTransitionToDirty(GuardEvent $event)
    {
        $chambre = $event->getSubject();

        // Add your conditions here
        if ($chambre->isConditionNotMet()) {
            // Block the transition
            $event->setBlocked(true);
        }
    }
}