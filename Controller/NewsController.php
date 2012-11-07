<?php

namespace WXR\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function listAction($page = 1)
    {
        $request = $this->getRequest();
        $postManager = $this->getPostManager();

        $postCount = $postManager->countPublished();
        $limit = 10;
        $pageCount = $postCount > 0 ? (int) ceil($postCount / $limit) : 1;

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $limit;

        $posts = $postManager->findPublished($limit, $offset);

        $stickies = $postManager->findStickies();

        return $this->render('WXRNewsBundle:News:list.html.twig', compact(
            'stickies',
            'posts',
            'postCount',
            'page',
            'pageCount'
        ));
    }

    public function showAction($slug)
    {
        $postManager = $this->getPostManager();

        $post = $postManager->findOneBySlug($slug);

        if ($post) {
            $previous = $postManager->findPrevious($post);
            $next = $postManager->findNext($post);
        } else {
            $previous = null;
            $next = null;
        }

        return $this->render('WXRNewsBundle:News:show.html.twig', compact(
            'post',
            'previous',
            'next'
        ));
    }

    public function categoryAction($slug, $page)
    {
        $categoryManager = $this->getCategoryManager();
        $postManager = $this->getPostManager();

        $category = $categoryManager->findOneBySlug($slug);

        if (null === $category) {
            throw $this->createNotFoundException('This category does not exist');
        }

        $postCount = $postManager->countByCategory($category);
        $limit = 10;
        $pageCount = $postCount > 0 ? (int) ceil($postCount / $limit) : 1;

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $limit;

        $posts = $postManager->findByCategory($category, $limit, $offset);

        return $this->render('WXRNewsBundle:News:category.html.twig', compact(
            'category',
            'posts',
            'postCount',
            'page',
            'pageCount'
        ));
    }

    public function tagAction($slug, $page)
    {
        $tagManager = $this->getTagManager();
        $postManager = $this->getPostManager();

        $tag = $tagManager->findOneBySlug($slug);

        if (null === $tag) {
            throw $this->createNotFoundException('This tag does not exist');
        }

        $postCount = $postManager->countByTag($tag);
        $limit = 10;
        $pageCount = $postCount > 0 ? (int) ceil($postCount / $limit) : 1;

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $limit;

        $posts = $postManager->findByTag($tag, $limit, $offset);

        return $this->render('WXRNewsBundle:News:tag.html.twig', compact('tag', 'posts', 'postCount', 'page', 'pageCount'));
    }

    /**
     * @return WXR\NewsBundle\Model\PostManagerInterface
     */
    protected function getPostManager()
    {
        return $this->get('wxr_news.post.manager');
    }

    /**
     * @return WXR\NewsBundle\Model\CategoryManagerInterface
     */
    protected function getCategoryManager()
    {
        return $this->get('wxr_news.category.manager');
    }

    /**
     * @return WXR\NewsBundle\Model\TagManagerInterface
     */
    protected function getTagManager()
    {
        return $this->get('wxr_news.tag.manager');
    }

    /**
     * @return Knp\Component\Pager\Paginator
     */
    protected function getPaginator()
    {
        return $this->get('knp_paginator');
    }
}
