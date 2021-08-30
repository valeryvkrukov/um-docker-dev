<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\Throwable\LoadingThrowable;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     * @throws LoadingThrowable
     */
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@mail.com');
        $user->setLogin('admin');
        $user->setRoles(['ROLE_SUPER_ADMIN', 'ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setIsActive(true);
        $user->setRegisteredAt(new \DateTime('now'));
        $user->setLastLogin(new \DateTime('now'));
        $manager->persist($user);

        $manager->flush();

        $loader = new NativeLoader();
        $objectSet = $loader->loadData([
            User::class => [
                'user_{1..50}' => [
                    'email' => '<email()>',
                    'login' => '<username()>',
                    'password' => '<password()>',
                    'birthday' => '<dateTimeThisCentury("-40 years")>',
                    'gender' => '50%? M: W',
                    'firstName' => '<firstName()>',
                    'lastName' => '<lastName()>',
                    'roles' => '<randomElements(["ROLE_USER", "ROLE_CONTENT_EDITOR", "ROLE_BUILDINGS_EDITOR", "ROLE_MUSEUMS_EDITOR"], 2)>',
                    'isActive' => '50%? true: false',
                    'language' => '<locale()>',
                    'www' => '<url()>',
                    'description' => '<realText()>',
                    'registeredAt' => '<dateTimeThisYear("-3 months")>',
                    'lastLogin' => '<dateTimeThisYear("-2 months")>',
                ]
            ]
        ]);
        foreach ($objectSet->getObjects() as $user) {
            $passwd = $user->getPassword();
            $user->setPassword($this->passwordHasher->hashPassword($user, $passwd));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
