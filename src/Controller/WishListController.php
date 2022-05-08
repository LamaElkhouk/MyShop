<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class WishListController extends AbstractController
{
    /**
     * @Route("/wishlist", name="wish_list")
     */
    public function index(SessionInterface $session, ArticleRepository $articleRepository): Response
    {
        $list= $session->get('list',[]);
        $listNew=[];  // ce Tableau va chercher dans $panier les données
        foreach ($list as $id=>$quantite){
            $listNew[]=[
                'article'=>$articleRepository->find($id), //trouver l'article dont l'identifiant est $id
                'quantite'=>$quantite
            ];
        }
        //dd($listNew);
        return $this->render('wish_list/index.html.twig', [
            'listeArticles'=>$listNew,
        ]);
    }

    /**
     * @Route("/wishlist/add/{id}", name="wish_list_add")
     */
    public function add($id,SessionInterface $session): Response
    {
        //$session= $request->getSession();
        $list= $session->get('list',[]); //sinon nous renvoit un tableau vide

        if(!empty($list[$id])){ //si le produit est deja présent dans le panier
            $list[$id]++;
        }else{
            $list[$id]=1;
        }


        //on remet le panier dans la session
        $session->set('list',$list);

        //dd($session->get('list'));
        return $this->redirectToRoute("wish_list");


    }

    /**
     * @Route("/wishlist/remove/{id}", name="listRemove")
     */
    public function remove($id,SessionInterface $session)
    {

        $list=$session->get('list',[]);
        if(!empty($list[$id])){
            //unset($list[$id]);
            unset($list[$id]);
        }

        $session->set('list',$list);

        return $this->redirectToRoute("wish_list");
    }
}
