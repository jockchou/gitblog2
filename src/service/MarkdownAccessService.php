<?php
/**
 * Created by PhpStorm.
 * User: jockchou
 * Date: 2016/4/26
 * Time: 20:33
 */

namespace service;

use article\Article;
use Fabricius\Repository\Repository;
use YaLinqo\Enumerable;


class MarkdownAccessService
{
    private $repository;
    private $enumerable;

    function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->enumerable = $this->repository->query();
    }

    public function getTagGroupAll($tagName = 'category')
    {
        $retArray = $this->enumerable->aggregate(function ($aggArray, Article $article) use ($tagName) {

            if ($article->getPublished()) {
                if ($tagName == 'category') {
                    $aggArray = array_merge($aggArray, $article->getTags());
                } else {
                    $aggArray = array_merge($aggArray, $article->getTags());
                }
            }

            return $aggArray;
        }, []);

        return array_unique($retArray);

    }

    //获取所有的时间归档
    public function getTimeGroupAll($format = 'Y-m')
    {
        $retArray = $this->enumerable->aggregate(function ($aggArray, Article $article) use ($format) {
            if ($article->getPublished()) {
                $aggArray[] = $article->getCreated()->format($format);
            }

            return $aggArray;
        }, []);

        return array_unique($retArray);

    }

    //查询已发布的文章总数
    public function getCount(
        $category = null,
        $tag = null,
        $date = null,
        $published = true
    ) {
        return $this->enumerable->count(function (Article $article) use ($category, $tag, $date, $published) {
            $ispub = $article->getPublished();
            $iscat = in_array($category, $article->getCategories());
            $istag = in_array($tag, $article->getTags());
            $created = $article->getCreated()->format($date['format']);

            return ($published ? $ispub : !$ispub) &&
            ($category === null ? true : $iscat) &&
            ($tag === null ? true : $istag) &&
            ($date === null ? true : $date['time'] == $created);
        });
    }

    //获取文章列表
    public function getArticleList(
        $category = null,
        $tag = null,
        $date = null,
        $published = true,
        $start = 0,
        $count = 6
    ) {
        $start = $start <= 0 ? 0 : $start;

        return $this->enumerable->where(function (Article $article) use ($category, $tag, $date, $published) {
            $ispub = $article->getPublished();
            $iscat = in_array($category, $article->getCategories());
            $istag = in_array($tag, $article->getTags());
            $created = $article->getCreated()->format($date['format']);

            return ($published ? $ispub : !$ispub) &&
            ($category === null ? true : $iscat) &&
            ($tag === null ? true : $istag) &&
            ($date === null ? true : $date['time'] == $created);

        })->orderByDescending(function (Article $article) {
            return $article->getCreated();
        })->skip($start)->take($count)->toArray();

    }
}