<?php

namespace WXR\NewsBundle\Model;

use WXR\CategoryBundle\Model\CategoryManagerInterface as BaseCategoryManagerInterface;

interface CategoryManagerInterface extends BaseCategoryManagerInterface
{
    /**
     * Find categories used in posts
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @return CategoryInterface[]
     */
    public function findWithPosts($limit = null, $offset = null);

    /**
     * Count categories used in posts
     *
     * @return integer
     */
    public function countWithPosts();
}
