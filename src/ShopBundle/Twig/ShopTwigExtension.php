<?php

namespace ShopBundle\Twig;

use Doctrine\ORM\EntityManager;
use Twig_Extension;

class ShopTwigExtension extends Twig_Extension
{
    private $em;

    /**
     * @return mixed
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param mixed $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }

    public function __construct(EntityManager $em)
    {
        $this->setEm($em);
    }
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_categories', array($this, 'getCategories')),
            new \Twig_SimpleFunction('get_promotions', array($this, 'getPromotions')),
        );
    }

    public function getName()
    {
        return 'shop_twig_extension';
    }

    public function getCategories()
    {
        return $this->getEm()->getRepository('ShopBundle:Category')->findAll();
    }

    public function getPromotions()
    {
        return $this->getEm()->getRepository('ShopBundle:Good')->findBy(array('promotion' => 1), array(), 2, null);
    }
}
