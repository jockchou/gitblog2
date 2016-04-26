<?php

namespace article;

use Fabricius\Annotation as Fabricius;

/**
 * @Fabricius\ContentItem(repositoryClass="Fabricius\Repository\Repository")
 */
class Article
{
    /**
     * @var string
     *
     * @Fabricius\Body
     */
    private $body;

    /**
     * @var array
     *
     * @Fabricius\Parameter
     */
    private $categories;

    /**
     * @var \DateTime
     *
     * @Fabricius\Created
     */
    private $created;

    /**
     * @var string
     *
     * @Fabricius\Excerpt
     */
    private $excerpt;

    /**
     * @var string
     *
     * @Fabricius\Format
     */
    private $format;

    /**
     * @var bool
     *
     * @Fabricius\Parameter
     */
    private $published;

    /**
     * @var string
     *
     * @Fabricius\Slug
     */
    private $slug;

    /**
     * @var array
     *
     * @Fabricius\Parameter
     */
    private $tags;

    /**
     * @var string
     *
     * @Fabricius\Title
     */
    private $title;

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set body
     *
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get categories
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set categories
     *
     * @param array $categories
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set excerpt
     *
     * @param string $excerpt
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set format
     *
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Get published
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set published
     *
     * @param bool $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set tags
     *
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
