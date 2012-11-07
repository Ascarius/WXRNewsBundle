<?php

namespace WXR\NewsBundle\Model;

use WXR\CategoryBundle\Model\CategoryInterface as BaseCategoryInterface;

interface CategoryInterface extends BaseCategoryInterface
{
    /**
     * Add post
     *
     * @param PostInterface $post
     * @return CategoryInterface
     */
    public function addPost(PostInterface $post);

    /**
     * Remove post
     *
     * @param PostInterface $post
     * @return CategoryInterface
     */
    public function removePost(PostInterface $post);

    /**
     * Get posts
     *
     * @return PostInterface[]
     */
    public function getPosts();
}
