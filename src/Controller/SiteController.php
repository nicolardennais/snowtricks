<?php

namespace App\Controller;



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
     */
    public function create() {

        $article = new Article();

        $form = $this->createFormBuilder($article)
                     ->add('title', TextType::class, [
                         'attr' => [
                             'placeholder' => "Nom du trick"
                         ]
                     ])
                     ->add('content', TextareaType::class, [
                         'attr' => [

                          'placeholder' => "Expliques le trick"
                             ]
                         ])
                     ->add('image', TextType::class, [
                         'attr' => [
                             'placeholder' => "photos du trick"
                         ]
                     ])
                     ->add('save', SubmitType::class, [
                         'label' => 'Enregistrer'
                     ])
                     ->getForm();

        return $this->render('site/create.html.twig', [
            'formArticle' => $form->createView()
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
