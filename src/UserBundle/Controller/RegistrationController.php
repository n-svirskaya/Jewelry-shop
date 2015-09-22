<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends BaseController
{
    public function registerAction(Request $request)
    {
        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('ROLE_USER')) {
            return new RedirectResponse($this->generateUrl('personal_info'), 302);
        }

        if ($securityContext->isGranted('ROLE_ADMIN')) {
            return new RedirectResponse($this->generateUrl('personal_info'), 302);
        }
        $response = parent::registerAction($request);

        return $response;
    }
}
