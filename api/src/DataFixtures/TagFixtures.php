<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\Throwable\LoadingThrowable;

class TagFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $fakerEn = Factory::create('en_US');
        $fakerRu = Factory::create('ru_RU');
        for ($i = 0; $i < 40; $i++) {
            $tag = new Tag();
            $tag->translate('en')->setName($fakerEn->word());
            $tag->translate('ru')->setName($fakerRu->word());
            $tag->setUrl($fakerEn->url());

            $manager->persist($tag);

            $tag->mergeNewTranslations();
        }

        $manager->flush();
    }
}
