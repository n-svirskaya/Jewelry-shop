<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ShopBundle:Default:index.html.twig', array('name' => $name));
    }
}
