<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\BrowserKit\Request;

class RegistrationController extends BaseController
{
    public function registerAction(Request $request)
    {

        $response = parent::registerAction($request);

        // ... do custom stuff
        return $response;
    }
}