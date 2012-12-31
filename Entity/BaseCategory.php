<?php

namespace WXR\NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use WXR\CategoryBundle\Entity\BaseCategory as BaseBaseCategory;
use WXR\NewsBundle\Model\CategoryInterface;
use WXR\NewsBundle\Model\PostInterface;

class BaseCategory extends BaseBaseCategory implements CategoryInterface
{
    /**
     * @var PostInterface[]
     */
    protected $posts;


    public function __construct()
    {
        parent::__construct();
        $this->posts = new ArrayCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function addPost(PostInterface $post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removePost(PostInterface $post)
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPosts()
    {
        return $this->posts->toArray();
    }
}
