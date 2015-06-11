<?php

namespace Epsi\PageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AdminInterface;

class PageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('slug', 'text', array('label' => 'Slug'))
            ->add('title', 'text', array('label' => 'Titre'))
            ->add('content', 'text', array('label' => 'Contenu'))
            ->add('is_in_menu', 'checkbox', array('label' => 'Dans le menu'))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('slug')
            ->add('title')
            ->add('isInMenu')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->addIdentifier('slug')
            ->add('isInMenu')
        ;
    }
}