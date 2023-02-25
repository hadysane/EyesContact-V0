<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $em;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordEncoder)
    {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['addEntity'],
            BeforeEntityUpdatedEvent::class => ['updateEntity'], //surtout utile lors d'un reset de mot passe plutôt qu'un réel update, car l'update va de nouveau encrypter le mot de passe DEJA encrypté ...
        ];
    }

    public function addEntity(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof User) {
            $this->setPassword($entity);
        }
        elseif ($entity instanceof Product){
            $this->setDateAtCreation($entity);
        }
        else{
            return;
        }
    }

    public function updateEntity(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof User) {
            $this->setPassword($entity);
        }
        elseif ($entity instanceof Product){
            $this->setDateAtUpdate($entity);
        }
        else{
            return;
        }
    }

    /**
     * @param User $entity
     */
    public function setPassword(User $entity): void
    {
        $pass = $entity->getPassword();

        $entity->setPassword(
            $this->passwordEncoder->hashPassword(
                $entity,
                $pass
            )
        );
        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * @param Product $entity
     */
    public function setDateAtCreation(Product $entity): void
    {
        $entity->setCreationDate(new \DateTime());
        $entity->setUpdateDate(new \DateTime());
        $this->em->persist($entity);
        $this->em->flush();
    }
    /**
     * @param Product $entity
     */
    public function setDateAtUpdate(Product $entity): void
    {
        $entity->setUpdateDate(new \DateTime());
        $this->em->persist($entity);
        $this->em->flush();
    }
}
