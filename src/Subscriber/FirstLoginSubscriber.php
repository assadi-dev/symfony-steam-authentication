<?php

namespace App\Subscriber;

use App\Entity\User;
use App\Services\SteamApiServices;
use Doctrine\ORM\EntityManagerInterface;
use Knojector\SteamAuthenticationBundle\Event\FirstLoginEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Knojector\SteamAuthenticationBundle\Event\AuthenticateUserEvent;

class FirstLoginSubscriber implements EventSubscriberInterface
{
    private $eventDispatcher;
    private $entityManager;
    private $steamServices;


    public function __construct(EventDispatcherInterface $eventDispatcher, EntityManagerInterface $entityManager, SteamApiServices $steamServices)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->entityManager = $entityManager;
        $this->steamServices = $steamServices;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FirstLoginEvent::NAME => 'onFirstLogin'
        ];
    }

    public function onFirstLogin(FirstLoginEvent $event)
    {
        $communityId = $event->getCommunityId();



        // e.g. call the Steam API to fetch more profile information
        // e.g. create user entity and persist it

        $steamProfile =  $this->steamServices->GetPlayerSummariesV2($communityId);


        $profile = $steamProfile["profileurl"];



        $user = new User();
        $user->setUsername($communityId)->setProfileLink($profile);


        $this->entityManager->persist($user);
        $this->entityManager->flush();


        // dispatch the authenticate event in order to sign in the new created user.
        $this->eventDispatcher->dispatch(new AuthenticateUserEvent($user), AuthenticateUserEvent::NAME);

    }
}
