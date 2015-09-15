<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function contactUsAction()
    {
        return $this->render('ShopBundle:Contacts:contact_us.html.twig');
    }

    public function privacyPolicyAction()
    {
        return $this->render('ShopBundle:Contacts:privacy_policy.html.twig');
    }

    public function registerAction(Request $request)
    {
        $this->processContact($request);

        return $this->render('ShopBundle:Contacts:register.html.twig');
    }

    public function servicesAction()
    {
        return $this->render('ShopBundle:Contacts:services.html.twig');
    }

    public function processContact(Request $request)
    {

    }
}