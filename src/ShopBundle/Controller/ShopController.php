<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShopController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShopBundle:Shop:index.html.twig');
    }

    public function aboutUsAction()
    {
        return $this->render('ShopBundle:Shop:about_us.html.twig');
    }

    public function categoryAction()
    {
        return $this->render('ShopBundle:Shop:category.html.twig');
    }

    public function detailsAction()
    {
        return $this->render('ShopBundle:Shop:details.html.twig');
    }

    public function specialGiftsAction()
    {
        return $this->render('ShopBundle:Shop:special_gifts.html.twig');
    }
}
