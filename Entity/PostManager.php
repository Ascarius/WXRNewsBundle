<?php

namespace WXR\NewsBundle\Entity;

use Doctrine\ORM\QueryBuilder;

use WXR\CommonBundle\Entity\BaseManager;
use WXR\NewsBundle\Model\CategoryInterface;
use WXR\NewsBundle\Model\PostInterface;
use WXR\NewsBundle\Model\PostManagerInterface;
use WXR\NewsBundle\Model\TagInterface;

class PostManager extends BaseManager implements PostManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function findOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => $slug));
    }

    /**
     * {@inheritDoc}
     */
    public function findPublished($limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s')),
                'sticky' => false
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countPublished()
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s')),
                'sticky' => false
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findStickies($limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s')),
                'sticky' => true
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countStickies($limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s')),
                'sticky' => true
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findByCategory(CategoryInterface $category, $limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'cat.id' => $category->getId(),
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s'))
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countByCategory(CategoryInterface $category)
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'cat.id' => $category->getId(),
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findByTag(TagInterface $tag, $limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'tag.id' => $tag->getId(),
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s'))
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countByTag(TagInterface $tag)
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'tag.id' => $tag->getId(),
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findLast()
    {
        $now = new \DateTime();

        $post = $this->findBy(
            array(
                'enabled' => true,
                'publishedAt' => array('<', $now->format('Y-m-d H:i:s'))
            ),
            null,
            1
        );

        if ($post) {
            return $post[0];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function findPreviousOf(PostInterface $post)
    {
        $now = new \DateTime();

        $posts = $this->findBy(
            array(
                'enabled' => true,
                'publishedAt' => array('<=', $post->getPublishedAt()->format('Y-m-d H:i:s')),
                'id' => array('!=', $post->getId())
            ),
            array('publishedAt' => 'DESC'),
            1
        );

        if ($posts && $posts[0]->getPublishedAt() < $now) {
            return $posts[0];

        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function findNextOf(PostInterface $post)
    {
        $now = new \DateTime();

        $posts = $this->findBy(
            array(
                'enabled' => true,
                'publishedAt' => array('>=', $post->getPublishedAt()->format('Y-m-d H:i:s')),
                'id' => array('!=', $post->getId())
            ),
            array('publishedAt' => 'ASC'),
            1
        );

        if ($posts && $posts[0]->getPublishedAt() < $now) {
            return $posts[0];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getSearchableProperties()
    {
        return array(
            $this->alias.'.title',
            'cat.name',
            'tag.name'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function buildFromClause(QueryBuilder $qb, array $criteria)
    {
        parent::buildFromClause($qb, $criteria);

        $needJoins = false;

        foreach (array('_search', 'cat', 'tag') as $needle) {
            foreach ($criteria as $criterium => $value) {
                if (false !== strpos($criterium, $needle)) {
                    $needJoins = true;
                    break 2;
                }
            }
        }

        if ($needJoins) {
            $qb
                ->leftJoin($this->alias.'.categories', 'cat')
                ->leftJoin($this->alias.'.tags', 'tag')
            ;
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function buildWhereClause(QueryBuilder $qb, array $criteria)
    {
        if (!array_key_exists('enabled', $criteria)) {
            $criteria['enabled'] = true;
        }

        return parent::buildWhereClause($qb, $criteria);
    }

    /**
     * {@inheritDoc}
     */
    protected function buildOrderClause(QueryBuilder $qb, array $orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = array('publishedAt' => 'DESC');
        }

        parent::buildOrderClause($qb, $orderBy);
    }
}
