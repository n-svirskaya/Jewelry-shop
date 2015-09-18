<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\UserType;


class UserController extends Controller
{
    public function cartAction()
    {
        return $this->render('ShopBundle:Users:cart.html.twig');
    }

    public function myAccountAction()
    {
        return $this->render('ShopBundle:Users:my_account.html.twig');
    }

    public function userAccountAction()
    {
       return $this->render('ShopBundle:Users:user_account.html.twig');
    }

    public function infoUserAccountAction()
    {
        return $this->render('ShopBundle:Users:personal_info.html.twig');
    }

    public function userEditAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->container->get('doctrine.orm.entity_manager')->flush($user);
            return $this->redirect($this->generateUrl('personal_info'));
        }

        return $this->render('@Shop/Users/edit_user_info.html.twig', array('form' => $form->createView()));
    }
}