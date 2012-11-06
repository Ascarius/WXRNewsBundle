<?php

namespace WXR\NewsBundle\Model;

use WXR\CommonBundle\Model\BaseManagerInterface;

interface PostManagerInterface extends BaseManagerInterface
{
    /**
     * Find one by slug
     *
     * @param string
     * @return PostInterface|null
     */
    public function findOneBySlug($slug);

    /**
     * Find published
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @return PostInterface[]
     */
    public function findPublished($limit = null, $offset = null);

    /**
     * Count published
     *
     * @return integer
     */
    public function countPublished();

    /**
     * Find sticky
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @return PostInterface[]
     */
    public function findStickies($limit = null, $offset = null);

    /**
     * Count sticky
     *
     * @return integer
     */
    public function countStickies();

    /**
     * Find by category
     *
     * @param CategoryInterface $category
     * @param integer|null $limit
     * @param integer|null $offset
     * @return PostInterface[]
     */
    public function findByCategory(CategoryInterface $category, $limit = null, $offset = null);

    /**
     * Count by category
     *
     * @param CategoryInterface $category
     * @return integer
     */
    public function countByCategory(CategoryInterface $category);

    /**
     * Find by tag
     *
     * @param TagInterface $tag
     * @param integer|null $limit
     * @param integer|null $offset
     * @return PostInterface[]
     */
    public function findByTag(TagInterface $tag, $limit = null, $offset = null);

    /**
     * Count by tag
     *
     * @param TagInterface $tag
     * @return integer
     */
    public function countByTag(TagInterface $tag);

    /**
     * Find previous/older post
     *
     * @param PostInterface $post
     * @return PostInterface|null
     */
    public function findPrevious(PostInterface $post);

    /**
     * Find next/newer post
     *
     * @param PostInterface $post
     * @return PostInterface|null
     */
    public function findNext(PostInterface $post);
}
