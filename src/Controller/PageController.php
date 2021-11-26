<?php

namespace App\Controller;

use App\Entity\Casino;
use App\Entity\CasinoRating;
use App\Entity\Page;
use App\Entity\Post;
use App\Repository\CasinoRatingRepository;
use App\Repository\CasinoRepository;
use App\Repository\PageRepository;
use App\Repository\PostRepository;
use App\Service\MenuService;
use Doctrine\Common\Collections\Collection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    private const SMTHNG_WRONG = 'Something went wrong';

    private MenuService $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * @Route("/", defaults={"page": "1", "_format"="html"}, methods="GET", name="main")
     * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods="GET", name="blog_index_paginated")
     * @Cache(smaxage="10")
     * @param Request $request
     */
    public function mainPage(Request $request, PageRepository $repository, int $page, string $_format, PostRepository $posts): Response
    {
        $pageData = $repository->findOneBy(['main' => true]);
        if (!$pageData) {
            //fallback
            $pageData = (new Page())
                ->setDescription(self::SMTHNG_WRONG)
                ->setTitle(self::SMTHNG_WRONG)
                ->setAddition(self::SMTHNG_WRONG)
                ->setContent1(self::SMTHNG_WRONG)
                ->setContent2(self::SMTHNG_WRONG)
                ->setContentTable(self::SMTHNG_WRONG)
                ->setKeywords(self::SMTHNG_WRONG);
        }

        $tag = null;
        $latestPosts = $posts->findLatest($page, $tag);

        return $this->render(
            'pages/main.html.twig',
            [
                'page' => $pageData,
                'menu' => $this->menuService->fetchDataForMenu(),
                'casinos_by_rates' => $this->menuService->fetchCasinosByRate(),
                'paginator' => $latestPosts,
            ]
        );
    }

    /**
     * @Route("/casino/{casinoName}")
     * @param Request $request
     */
    public function casinoPage(Request $request, string $casinoName, CasinoRepository $repository): Response
    {
        /** @var Casino $casino */
        $casino = $repository->findOneBy(['name' => $casinoName]);

        if (!$casino) {
            return $this->redirect($this->generateUrl('main'));
        }

        return $this->render(
            'pages/casino.html.twig',
            [
                'page' => $casino->getPage(),
                'casino' => $casino,
                'menu' => $this->menuService->fetchDataForMenu(),
            ]
        );
    }

    /**
     * @Route("/rating/{ratingName}")
     * @param Request $request
     * @param string $ratingName
     * @param CasinoRatingRepository $repository
     * @return Response
     */
    public function ratingPage(Request $request, string $ratingName, CasinoRatingRepository $repository, PageRepository $pageRepository): Response
    {
        /** @var CasinoRating $rating */
        $rating = $repository->findOneBy(['slug' => $ratingName]);

        if (!$rating) {
            return $this->redirect($this->generateUrl('main'));
        }

        return $this->render(
            'pages/rating.html.twig',
            [
                'page' => $pageRepository->findOneBy(['main' => true]),
                'rating' => $rating,
                'rating_casinos' => $this->sortByRate($rating->getRatingsCasinosRates()),
                'menu' => $this->menuService->fetchDataForMenu(),
            ]
        );
    }

    private function sortByRate(Collection $rates): array
    {
        $ratesArray = $rates->toArray();
        usort($ratesArray, fn($a, $b) => $a->getRate() <=> $b->getRate());

        return $ratesArray;
    }


    /**
     * @Route("/posts/{slug}", methods="GET", name="blog_post")
     * @param Request $request
     */
    public function blogpostPage(Request $request, Post $post): Response
    {
        $pageData = (new Page())
            ->setDescription(self::SMTHNG_WRONG)
            ->setTitle(self::SMTHNG_WRONG)
            ->setAddition(self::SMTHNG_WRONG)
            ->setContent1(self::SMTHNG_WRONG)
            ->setContent2(self::SMTHNG_WRONG)
            ->setContentTable(self::SMTHNG_WRONG)
            ->setKeywords(self::SMTHNG_WRONG);

        return $this->render('blog/post_show.html.twig', [
            'post' => $post,
            'page' => $pageData,
            'menu' => $this->menuService->fetchDataForMenu(),
        ]);
    }
}
