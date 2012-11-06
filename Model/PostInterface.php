<?php

namespace WXR\NewsBundle\Model;

interface PostInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set category
     *
     * @param CategoryInterface[] $categories
     * @return PostInterface
     */
    public function setCategories($categories);

    /**
     * Add category
     *
     * @param CategoryInterface $category
     * @return PostInterface
     */
    public function addCategory(CategoryInterface $category);

    /**
     * Remove category
     *
     * @param CategoryInterface $category
     * @return PostInterface
     */
    public function removeCategory(CategoryInterface $category);

    /**
     * Clear categories
     *
     * @return PostInterface
     */
    public function clearCategories();

    /**
     * Get category
     *
     * @return CategoryInterface[]
     */
    public function getCategories();

    /**
     * Has category
     *
     * @param CategoryInterface $category
     * @return boolean
     */
    public function hasCategory(CategoryInterface $category);

    /**
     * Set tag
     *
     * @param TagInterface[] $tags
     * @return PostInterface
     */
    public function setTags($tags);

    /**
     * Add tag
     *
     * @param TagInterface $tag
     * @return PostInterface
     */
    public function addTag(TagInterface $tag);

    /**
     * Remove tag
     *
     * @param TagInterface $tag
     * @return PostInterface
     */
    public function removeTag(TagInterface $tag);

    /**
     * Clear tags
     *
     * @return PostInterface
     */
    public function clearTags();

    /**
     * Get tag
     *
     * @return TagInterface[]
     */
    public function getTags();

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return PostInterface
     */
    public function setEnabled($enabled);

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled();

    /**
     * Set slug
     *
     * @param string $slug
     * @return PostInterface
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set title
     *
     * @param string $title
     * @return PostInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set content
     *
     * @param string $content
     * @return PostInterface
     */
    public function setContent($content);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set excerpt
     *
     * @param string $excerpt
     * @return PostInterface
     */
    public function setExcerpt($excerpt);

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt();

    /**
     * Set publishedAt
     *
     * @param string $publishedAt
     * @return PostInterface
     */
    public function setPublishedAt(\DateTime $publishedAt);

    /**
     * Get publishedAt
     *
     * @return string
     */
    public function getPublishedAt();

    /**
     * Is published
     *
     * @return boolean
     */
    public function isPublished();

    /**
     * Set sticky
     *
     * @param boolean $sticky
     * @return PostInterface
     */
    public function setSticky($sticky);

    /**
     * Get sticky
     *
     * @return boolean
     */
    public function getSticky();

    /**
     * Is sticky
     *
     * @return boolean
     */
    public function isSticky();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PostInterface
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return PostInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @return string
     */
    public function __toString();
}
