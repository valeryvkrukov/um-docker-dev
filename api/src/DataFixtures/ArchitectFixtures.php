<?php

namespace App\DataFixtures;

use App\Entity\Architect;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArchitectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $fakerEn = Factory::create('en_US');
        $fakerRu = Factory::create('ru_RU');
        for ($i = 0; $i < 40; $i++) {
            $arch = new Architect();
            $arch->translate('en')->setName($fakerEn->time('s') . ' - '. $fakerEn->streetName());
            $arch->translate('ru')->setName($fakerEn->time('m') . ' - ' . $fakerRu->streetName());
            $arch->translate('en')->setDescription($fakerEn->text());
            $arch->translate('ru')->setDescription($fakerRu->text());
            $arch->setSlug($fakerEn->slug());

            $manager->persist($arch);

            $arch->mergeNewTranslations();
        }

        $manager->flush();
    }
}
