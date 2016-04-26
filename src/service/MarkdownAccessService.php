<?php
/**
 * Created by PhpStorm.
 * User: jockchou
 * Date: 2016/4/26
 * Time: 20:33
 */

namespace service;


class MarkdownAccessService
{
    private $content;

    function __construct($content)
    {
        $this->content = $content;
    }

    public function getArticleAll()
    {
        return $this->content->toArray();
    }

    public function getArticleByCategory($category)
    {

    }

    public function getArticleByDate()
    {

    }
}