<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Article;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Service\Slugify;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $slugify = new Slugify();

        for ($i =0; $i<50; $i++){

            $article = new Article();
            $article->setTitle(($faker->sentence($nbWords = 4, $variableNbWords = true)) );
            $article->setSlug($slugify->generate($article->getTitle()));
            $article->setContent(mb_strtolower($faker->text));
            $article->setCategory($this->getReference('categorie_' . $faker->numberBetween($min = 0, $max = 4)));

            $manager->persist($article);
        }
        $manager->flush();
    }
}