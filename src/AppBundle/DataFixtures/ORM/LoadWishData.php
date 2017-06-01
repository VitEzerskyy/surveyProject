<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Wish;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;


class LoadWishData implements FixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;
    public function load(ObjectManager $manager)
    {
        $jsonFile =  $this->container->getParameter('kernel.root_dir')."/../var/data/wishes.json";
        $json = json_decode(file_get_contents($jsonFile));

        foreach ($json as $value) {
            $wish = (new Wish())
                ->setTitle($value->title)
                ->setWish($value->wish)
                ->setCreated(\DateTime::createFromFormat('Y-m-d H:i:s', $value->created))
                ->setStatus($value->status);

            $manager->persist($wish);
        }
        $manager->flush();
    }
}