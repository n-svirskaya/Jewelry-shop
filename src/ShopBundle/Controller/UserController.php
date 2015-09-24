<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Category;
use ShopBundle\Entity\Good;
use ShopBundle\Form\CategoryType;
use ShopBundle\Form\GoodType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Form\UserType;


class UserController extends Controller
{
    public function cartAction()
    {
        return $this->render('ShopBundle:Users:cart.html.twig');
    }

    public function myAccountAction(Request $request)
    {
       $securityContext = $this->container->get('security.context');
       if ($securityContext->isGranted('ROLE_USER') || $securityContext->isGranted('ROLE_ADMIN')) {
            return new RedirectResponse($this->generateUrl('personal_info'), 302);
        }

        return $this->render('ShopBundle:Users:my_account.html.twig');
    }

    public function userAccountAction()
    {
       return $this->render('ShopBundle:Users:personal_info.html.twig');
    }

    public function infoUserAccountAction()
    {
        return $this->render('ShopBundle:Users:personal_info.html.twig');
    }

    public function userEditAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->container->get('doctrine.orm.entity_manager')->flush($user);
            return $this->redirect($this->generateUrl('personal_info'));
        }

        return $this->render('@Shop/Users/edit_user_info.html.twig', array('form' => $form->createView()));
    }

    public function userListAction()
    {
        return $this->render('ShopBundle:Users:wish_list.html.twig');
    }

    /**
     *
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function adminAddCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $category->upload();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($category);
            $em->flush($category);

            $this->container->get('session')->getFlashBag()->add('notice', 'Your category has been added successfully!');

            return $this->redirect($this->generateUrl('add_category'));
        }

        return $this->render('ShopBundle:Users:admin_add_category.html.twig', array('form' => $form->createView()));
    }

    public function adminAddGoodAction(Request $request)
    {
        $good = new Good();
        $form = $this->createForm(new GoodType(), $good);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $good->upload();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($good);
            $em->flush($good);

            $this->container->get('session')->getFlashBag()->add('notice', 'Your good has been added successfully!');

            return $this->redirect($this->generateUrl('add_good'));
        }


        return $this->render('ShopBundle:Users:admin_add_good.html.twig', array('form' => $form->createView()));
    }

    public function adminOrderProcessingAction()
    {
        return $this->render('ShopBundle:Users:admin_order_processing.html.twig');
    }


}