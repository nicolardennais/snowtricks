<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for($i = 1; $i <=10; $i++){
           $article = new Articles();
           $article->setTitle("Trick n°$i")
                   ->setContent("<p>Description du Trick n°$i</p>")
                   ->setImage("http://placehold.it/350x150")
                   ->getCreatedAt (new \DateTime());

           $manager->persist($article);
       }

        $manager->flush();
    }
}
