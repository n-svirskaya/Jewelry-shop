<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController
{

    public function loginAction(Request $request)
    {

        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('ROLE_USER')) {
            return new RedirectResponse($this->generateUrl('user_account'), 302);
        }

        $response = parent::loginAction($request);

        // ... do custom stuff
        return $response;
    }
}
