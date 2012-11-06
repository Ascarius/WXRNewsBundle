<?php

namespace WXR\NewsBundle\Model;

use WXR\CategoryBundle\Model\TagInterface as BaseTagInterface;

interface TagInterface extends BaseTagInterface
{
    /**
     * Add post
     *
     * @param PostInterface $post
     * @return GroupInterface
     */
    public function addPost(PostInterface $post);

    /**
     * Remove post
     *
     * @param PostInterface $post
     * @return GroupInterface
     */
    public function removePost(PostInterface $post);

    /**
     * Get posts
     *
     * @return PostInterface[]
     */
    public function getPosts();
}
