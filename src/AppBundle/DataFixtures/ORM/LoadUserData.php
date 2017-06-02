<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;


class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;
    public function load(ObjectManager $manager)
    {
            $user = (new User())
                ->setUsername('admin')
                ->setPassword('$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC');
            $manager->persist($user);

        $manager->flush();
    }
}