<?php

namespace WXR\NewsBundle\Model;

abstract class Post implements PostInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var CategoryInterface[]
     */
    protected $categories;

    /**
     * @var TagInterface[]
     */
    protected $tags;

    /**
     * @var boolean
     */
    protected $enabled;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $excerpt;

    /**
     * @var \DateTime
     */
    protected $publishedAt;

    /**
     * @var boolean
     */
    protected $sticky;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;


    public function __construct()
    {
        $this->enabled = true;
        $this->categories = array();
        $this->tags = array();
        $this->publishedAt = new \DateTime();
        $this->sticky = false;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setCategories($categories)
    {
        $this->clearCategories();

        foreach ($categories as $category) {
            $this->addCategory($category);
        }

        return $this;
    }


    /**
     * {@inheritDoc}
     */
    public function addCategory(CategoryInterface $category)
    {
        if (! $this->hasCategory($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeCategory(CategoryInterface $category)
    {
        if (false !== ($key = array_search($category, $this->categories, true))) {
            unset($this->categories[$key]);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function clearCategories()
    {
        $this->categories = array();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * {@inheritDoc}
     */
    public function hasCategory(CategoryInterface $category)
    {
        return false !== array_search($category, $this->categories, true);
    }

    /**
     * {@inheritDoc}
     */
    public function setTags($tags)
    {
        $this->clearTags();

        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }


    /**
     * {@inheritDoc}
     */
    public function addTag(TagInterface $tag)
    {
        if (! $this->hasTag($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeTag(TagInterface $tag)
    {
        if (false !== ($key = array_search($tag, $this->tags, true))) {
            unset($this->tags[$key]);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function clearTags()
    {
        $this->tags = array();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * {@inheritDoc}
     */
    public function hasTag(TagInterface $tag)
    {
        return false !== array_search($tag, $this->tags, true);
    }

    /**
     * {@inheritDoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritDoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritDoc}
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublishedAt(\DateTime $publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * {@inheritDoc}
     */
    public function isPublished()
    {
        return $this->publishedAt < new \DateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function getPublished()
    {
        return $this->isPublished();
    }

    /**
     * {@inheritDoc}
     */
    public function setSticky($sticky)
    {
        $this->sticky = $sticky;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSticky()
    {
        return $this->sticky;
    }

    /**
     * {@inheritDoc}
     */
    public function isSticky()
    {
        return $this->getSticky();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
