<?php

namespace App\Controller;



use App\Form\ArticleType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index(ArticleRepository $repo)
    {

        $article = $repo->findAll();

        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'article' => $article
        ]);
    }

    /**
     * @Route("/", name = "home")
     */
    public function home()
    {
        return $this->render('site/home.html.twig');
    }
    /**
     * @Route("/site/new", name="site_create")
     * @Route("/site/{id}/edit",name="site_edit")
     */
    public function form(Article $article = null, Request $request,
                         ObjectManager $manager) {
        if(!$article) {
            $article = new Article();
        }


        $form = $this->createForm(ArticleType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if ($article->getId()){
                $article->setCreatedAt(new \DateTime());
            }


            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('site_show', ['id' => $article->getId()]);
        }

        return $this->render('site/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);

    }
        /**
         * @Route("/site/{id}", name="site_show", requirements={"id"="\d+"})
         */
        public function show(Article $article)
        {

            return $this->render('site/show.html.twig', [
                'article' => $article
            ]);

    }
}
