<?php

namespace WXR\NewsBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_by' => 'publishedAt',
        '_sort_order' => 'DESC'
    );

    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_general')
                ->add('publishedAt')
                ->add('title')
                ->add('content', null, array(
                    'attr' => array('class' => 'wysiwyg', 'rows' => 8)
                ))
                ->add('excerpt', null, array(
                    'required' => false
                ))
            ->end()
            ->with('form.group_categories')
                ->add('categories', 'sonata_type_model', array(
                    'class' => 'WXR\\NewsBundle\\Entity\\Category',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ))
                ->add('tags', 'sonata_type_model', array(
                    'class' => 'WXR\\NewsBundle\\Entity\\Tag',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ))
            ->end()
            ->with('form.group_options')
                ->add('sticky', null, array(
                    'required' => false
                ))
                ->add('enabled', null, array(
                    'required' => false
                ))
            ->end()
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('content')
            ->add('categories')
            ->add('tags')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('enabled')
            ->add('sticky')
            ->add('categories')
            ->add('tags')
            ->add('publishedAt')
        ;
    }

}
