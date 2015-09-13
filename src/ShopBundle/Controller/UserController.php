<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function cartAction($name)
    {
        return $this->render('ShopBundle:Users:cart.html.twig', array('name' => $name));
    }

    public function myAccountAction($name)
    {
        return $this->render('ShopBundle:Users:my_account.html.twig', array('name' => $name));
    }


}