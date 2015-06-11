<?php

namespace Epsi\PageBundle\Menu;

use Knp\Menu\FactoryInterface;
use Doctrine\ORM\Entitymanager;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    /**
     * @var \Knp\Menu\FactoryInterface
     */
    private $factory;

    /**
     * @var \Doctrine\ORM\Entitymanager
     */
    private $em;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, EntityManager $em)
    {
        $this->factory = $factory;
        $this->em = $em;
    }

    /**
     * @param RequestStack $requestStack
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $pageRepository = $this->em->getRepository('EpsiPageBundle:Page');
        $pages = $pageRepository->findBy(array('isInMenu' => true));

        $menu->addChild('Home', array('route' => 'homepage'));

        foreach ($pages as $page) {
            /** @var \Epsi\PageBundle\Entity\Page $page */
            $menu->addChild($page->getTitle(), array(
                'route' => 'page',
                'routeParameters' => array('slug' => $page->getSlug())
            ));
        }

        return $menu;
    }
}