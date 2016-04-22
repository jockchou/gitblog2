<?php
/**
 * Created by PhpStorm.
 * User: jockchou
 * Date: 2016/4/22
 * Time: 19:19
 */

namespace services;

class MarkdownService
{
    private $mdText;
    private $markdown;

    function __construct($mdText)
    {
        $this->mdText = $mdText;
    }

    public function toHtml()
    {

    }
}