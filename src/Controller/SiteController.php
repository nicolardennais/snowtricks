<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->findAll();

        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'article' => $article
        ]);
    }

    /**
     * @Route("/", name = "home")
     */
    public function home(){
        return $this->render('site/home.html.twig');
    }
    /**
     * @Route("/site/{id}", name="site_show")
     */
    public function show($id){
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);
        return $this->render('site/show.html.twig', [
            'article' => $article
        ]);
    }
}
