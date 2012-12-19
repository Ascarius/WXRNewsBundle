<?php

namespace WXR\NewsBundle\Entity;

use Doctrine\ORM\EntityManager;

use WXR\CategoryBundle\Entity\CategoryManager as BaseCategoryManager;
use WXR\NewsBundle\Model\CategoryManagerInterface;

class CategoryManager extends BaseCategoryManager implements CategoryManagerInterface
{
    /**
     * Post FQCN
     *
     * @var string
     */
    protected $postClass;

    public function __construct(EntityManager $em, $class, $postClass)
    {
        parent::__construct($em, $class);
        $this->postClass = $postClass;
    }

    /**
     * {@inheritDoc}
     */
    public function findWithPosts($limit = null, $offset = null)
    {
        $qb = $this->getQueryBuilder(false, array(), null, $limit, $offset);

        $qb->andWhere(
            'EXISTS ('
               . 'SELECT post.id '
               . 'FROM '.$this->postClass.' post '
               . 'INNER JOIN post.categories cat '
               . 'WHERE cat.id = '.$this->alias.'.id '
          . ')'
        );

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function countWithPosts($limit = null, $offset = null)
    {
        $qb = $this->getQueryBuilder(true, array(), null, $limit, $offset);

        $qb->andWhere(
            'EXISTS ('
               . 'SELECT post.id '
               . 'FROM '.$this->postClass.' post '
               . 'INNER JOIN post.categories cat '
               . 'WHERE cat.id = '.$this->alias.'.id '
          . ')'
        );

        return $qb->getQuery()->getSingleScalarResult();
    }
}
