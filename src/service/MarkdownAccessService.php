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

    public function getArticleAll()
    {
        return $this->enumerable->toArray();
    }

    //获取所有的分类
    public function getCategoryAll()
    {
        $cateArray = $this->enumerable->aggregate(function ($a, Article $v) {
            return array_merge($a, $v->getCategories());
        }, []);

        return array_unique($cateArray);
    }

    //查询已发布的文章总数
    public function getCount()
    {

    }

    //获取分类下的文章
    public function getArticleByCategory($category, $start = 0, $count = 2)
    {
        $start = $start <= 0 ? 0 : $start;

        return $this->enumerable->where(function (Article $item) use ($category) {
            return in_array($category, $item->getCategories());
        })->orderByDescending(function (Article $item) {
            return $item->getCreated();
        })->skip($start)->take($count)->toArray();
    }

    function getArticleByDate()
    {

    }
}