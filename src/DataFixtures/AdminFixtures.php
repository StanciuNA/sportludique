<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AdminFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
   

    public function load(ObjectManager $manager): void
    {
        
        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setName('admin');
        $admin->setFirstname('super');
        $admin->setPhone('0584596528');
        $AdminPassword = $this->hasher->hashPassword($admin, 'admin1234');
        $admin->setPassword($AdminPassword);
    

        $manager->persist($admin);
        

        $user = new User();
        $user->setEmail('user@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setName('user');
        $user->setFirstname('toto');
        $user->setPhone('0552654855');
        $userPassword = $this->hasher->hashPassword($admin, 'user1234');
        $user->setPassword($userPassword);
    

        $manager->persist($admin);
        $manager->persist($user);
        $manager->flush();
    }


}  