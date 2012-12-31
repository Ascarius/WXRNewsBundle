<?php

namespace WXR\NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use WXR\CategoryBundle\Entity\BaseTag as BaseBaseTag;
use WXR\NewsBundle\Model\PostInterface;
use WXR\NewsBundle\Model\TagInterface;

class BaseTag extends BaseBaseTag implements TagInterface
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
