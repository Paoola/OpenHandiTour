<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = (new User())
            ->setEmail('paola.mauceri7@gmail.com')
            ->setFirstName('Paola')
            ->setLastName('MAUCERI');

        $manager->persist($user);
        $manager->flush();

        $this->addReference('paola', $user);

        $user = (new User())
            ->setEmail('xavier@e-zic.com')
            ->setFirstName('Xavier')
            ->setLastName('HAUSHERR');

        $manager->persist($user);
        $manager->flush();

        $this->addReference('xavier', $user);
    }
}
