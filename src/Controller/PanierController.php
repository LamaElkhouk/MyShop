<?php

namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session,ArticleRepository $articleRepository): Response
    {
        $panier= $session->get('panier',[]);
        $panierNew=[];  // ce Tableau va chercher dans $panier les données
        foreach ($panier as $id=>$quantite){
            $panierNew[]=[
                'article'=>$articleRepository->find($id), //trouver l'article dont l'identifiant est $id
                'quantite'=>$quantite
            ];
        }
        //dd($panierNew);
        $total=0;
        foreach ($panierNew as $element){

            $totalDesElements=$element['article']->getPrix()*$element['quantite'];
            $total+=$totalDesElements;

        }

        return $this->render('panier/index.html.twig',['listeArticles'=>$panierNew, 'total'=>$total]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier2")
     */
    public function add($id, SessionInterface $session): Response
    {
        //$session= $request->getSession();
        $panier= $session->get('panier',[]); //sinon nous renvoit un tableau vide

        if(!empty($panier[$id])){ //si le produit est deja présent dans le panier
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }


        //on remet le panier dans la session
        $session->set('panier',$panier);

        //dd($session->get('panier'));

        return $this->redirectToRoute("panier");

    }


    /**
     * @Route("/panier/remove/{id}", name="panierRemove")
     */
    public function remove($id,SessionInterface $session)
    {

        $panier=$session->get('panier',[]);
        if(!empty($panier[$id]) and $panier[$id]!=1){
            //unset($panier[$id]);
            $panier[$id]--;
        }else{
            unset($panier[$id]);
        }

        $session->set('panier',$panier);

        return $this->redirectToRoute("panier");
    }
}
