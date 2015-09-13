<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShopBundle:Shop:index.html.twig');
    }

    public function aboutUsAction($name)
    {
        return $this->render('ShopBundle:Shop:about_us.html.twig', array('name' => $name));
    }

    public function categoryAction($name)
    {
        return $this->render('ShopBundle:Shop:category.html.twig', array('name' => $name));
    }

    public function detailsAction($name)
    {
        return $this->render('ShopBundle:Shop:details.html.twig', array('name' => $name));
    }

    public function specialGiftsAction($name)
    {
        return $this->render('ShopBundle:Shop:special_gifts.html.twig', array('name' => $name));
    }
}
