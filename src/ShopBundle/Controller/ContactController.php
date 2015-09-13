<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function contactUsAction($name)
    {
        return $this->render('ShopBundle:Contacts:contact_us.html.twig', array('name' => $name));
    }

    public function privacyPolicyAction($name)
    {
        return $this->render('ShopBundle:Contacts:privacy_policy.html.twig', array('name' => $name));
    }

    public function registerAction($name)
    {
        return $this->render('ShopBundle:Contacts:register.html.twig', array('name' => $name));
    }

    public function servicesAction($name)
    {
        return $this->render('ShopBundle:Contacts:services.html.twig', array('name' => $name));
    }


}