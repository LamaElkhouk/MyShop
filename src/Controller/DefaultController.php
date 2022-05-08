<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Genre;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTime;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {


        $randomArticle = $this->getDoctrine()->getRepository(Article::class)->randomArticle();

        $currentTime= (new DateTime)->format('d/m/Y  H:i:s');
        return $this->render('default/index.html.twig',['currentTime'=>$currentTime,'randomArticle'=>$randomArticle]);
    }




    /**
     * @Route("/Femme", name="Femme")
     */
    public function PageFemme()
    {

        $article = $this->getDoctrine()->getRepository(Article::class)->findBy(array('genre'=>2));

        $nbArticle=count($article);
        return $this->render('default/femme.html.twig',['Article'=>$article,'nbArticle'=>$nbArticle]);
    }

    /**
     * @Route("/femme/{genre}/{categorie}", name="femme")
     */
    public function PageFemmeArticle($genre=2,$categorie=1): Response
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findBy(array("genre"=>$genre,"categorie"=>$categorie));
        $nbArticle=count($article);
        return $this->render('default/femme.html.twig',['Article' => $article,'nbArticle'=>$nbArticle]);
    }


    /**
     * @Route("/Homme", name="Homme")
     */
    public function PageHomme(): Response
    {
       // $article = $this->getDoctrine()->getRepository(Article::class)->findBy(array('genre'=>1));
        $article = $this->getDoctrine()->getRepository(Article::class)->findBy(array('genre'=>1));

        $nbArticle=count($article);
        return $this->render('default/homme.html.twig',['Article' => $article,'nbArticle'=>$nbArticle]);
    }

    /**
     * @Route("/homme/{genre}/{categorie}", name="homme")
     */
    public function PageHommeArticle($genre=1,$categorie=1): Response
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findBy(array("genre"=>$genre,"categorie"=>$categorie));
        $nbArticle=count($article);
        return $this->render('default/homme.html.twig',['Article' => $article,'nbArticle'=>$nbArticle]);
    }

    /**
     * @Route("/Enfant", name="Enfant")
     */
    public function PageEnfant(): Response
    {
        return $this->render('default/enfant.html.twig');
    }

    /**
     * @Route("/enfant/Garçon", name="Garçon")
     */
    public function PageGarcon(): Response
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findBy(array("genre"=>3));
        $nbArticle=count($article);
        return $this->render('default/garçon.html.twig',['Article' => $article,'nbArticle'=>$nbArticle]);
    }

    /**
     * @Route("/enfant/garçon/{genre}/{categorie}", name="garçon")
     */
    public function pageEnfantGarcon($genre=3,$categorie=1): Response
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findBy(array("genre"=>$genre,"categorie"=>$categorie));
        $nbArticle=count($article);
        return $this->render('default/garçon.html.twig',['Article' => $article,'nbArticle'=>$nbArticle]);
    }

    /**
     * @Route("/enfant/Fille", name="Fille")
     */
    public function PageFille(): Response
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findBy(array("genre"=>4));
        $nbArticle=count($article);
        return $this->render('default/fille.html.twig',['Article' => $article,'nbArticle'=>$nbArticle]);
    }
    /**
     * @Route("/enfant/fille/{genre}/{categorie}", name="fille")
     */
    public function pageEnfantFille($genre=4,$categorie=1)

    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->findBy(array("genre"=>$genre,"categorie"=>$categorie));
        $nbArticle=count($article);
        return $this->render('default/fille.html.twig',['Article'=>$article,'nbArticle'=>$nbArticle]);
    }

}
