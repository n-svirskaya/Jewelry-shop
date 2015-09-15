<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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


}