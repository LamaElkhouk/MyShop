<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\User;
use App\Form\AvatarType;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    /**
     * @Route("/mon compte", name="monCompte")
     */
    public function compte(): Response
    {
        $avatar = $this->getDoctrine()->getRepository(Avatar::class)->findAll();

        return $this->render('security/compte.html.twig',['avatar'=>$avatar]);
    }
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request,UserPasswordEncoderInterface $encoder): Response
    {

        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $user->setRoles(["ROLE_USER"]);
            $em->persist($user );
            $em->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/inscription.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/avatar", name="avatar")
     */
    public function changerAvatar(Request $request): Response
    {
        $image = new Avatar();
        $form = $this->createForm(AvatarType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
            return $this->redirectToRoute('monCompte');
        }
        return $this->render('security/avatar.html.twig',['form' => $form->createView()]);
    }
}
