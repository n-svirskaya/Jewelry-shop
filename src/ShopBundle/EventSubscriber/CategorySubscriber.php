<?php

namespace ShopBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use ShopBundle\Entity\Category;
use Symfony\Component\DependencyInjection\Container;

class CategorySubscriber implements EventSubscriber
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->processCategory($args);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->processCategory($args);
    }

    /**
     * @param mixed $args
     */
    private function processCategory($args)
    {
        $category = $args->getEntity();
        if ($category instanceof Category) {
            $name = $category->getName();
            $helper = $this->container->get('shop.service.helper');
            $transName = $helper->transliterate($name);
            $category->setTransName($transName);
        }
    }
}