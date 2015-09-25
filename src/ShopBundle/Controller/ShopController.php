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
        return $this->render('ShopBundle:Shop:index.html.twig');
    }

    public function aboutUsAction()
    {
        return $this->render('ShopBundle:Shop:about_us.html.twig');
    }

    public function categoryAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ShopBundle:Category')->findAll();

        return $this->render('ShopBundle:Shop:category.html.twig', array('categories' => $categories));
    }

    public function oneCategoryAction(Request $request)
    {
        $transName = $request->get('transName');
        $em = $this->getDoctrine()->getManager();
        /** @var Category $category */
        $category = $em->getRepository('ShopBundle:Category')->findOneBy(array('transName'=> $transName));
        $categoryId = $category->getId();
        $goods = $em->getRepository('ShopBundle:Good')->findBy(array('category'=> $categoryId));


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
