<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Category;
use ShopBundle\Entity\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShopController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $goodFeatured = $em->getRepository('ShopBundle:Good')->findBy(array('featured' => 1), array('id' => 'DESC'), 2, null);
        $goodNew = $em->getRepository('ShopBundle:Good')->findBy(array('new' => 1), array('id' => 'DESC'), 6, null);

        return $this->render('ShopBundle:Shop:index.html.twig', array('goodFeatured' => $goodFeatured, 'goodNew' => $goodNew));
    }

    public function aboutUsAction()
    {
        return $this->render('ShopBundle:Shop:about_us.html.twig');
    }

    public function categoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paginator  = $this->get('knp_paginator');
        $category = $em->getRepository('ShopBundle:Category')->findAll();

        $categories = $paginator->paginate(
            $category,
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        return $this->render('ShopBundle:Shop:category.html.twig', array('categories' => $categories));
    }

    public function oneCategoryAction(Request $request)
    {
        $transName = $request->get('transName');
        $em = $this->getDoctrine()->getManager();
        /** @var Category $category */
        $category = $em->getRepository('ShopBundle:Category')->findOneBy(array('transName'=> $transName));
        $categoryId = $category->getId();
        $good = $em->getRepository('ShopBundle:Good')->findBy(array('category'=> $categoryId));

        $paginator  = $this->get('knp_paginator');
        $goods = $paginator->paginate(
            $good,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );


        return $this->render('ShopBundle:Shop:one_of_category.html.twig', array('category' => $category, 'goods' => $goods));

    }
    


    public function detailsAction(Request $request)
    {
        $goodId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $good = $em->getRepository('ShopBundle:Good')->findOneBy(array('id'=> $goodId));

        return $this->render('ShopBundle:Shop:details.html.twig', array('good' => $good));
    }

    public function specialGiftsAction()
    {
        return $this->render('ShopBundle:Shop:special_gifts.html.twig');
    }
}
