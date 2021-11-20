<?php

namespace App\Controller;

use App\Entity\Casino;
use App\Entity\CasinoRating;
use App\Entity\Page;
use App\Repository\CasinoRatingRepository;
use App\Repository\CasinoRepository;
use App\Repository\PageRepository;
use App\Service\MenuService;
use Doctrine\Common\Collections\Collection;
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
     * @Route("/", name="main")
     * @param Request $request
     */
    public function mainPage(Request $request, PageRepository $repository): Response
    {
        $page = $repository->findOneBy(['main' => true]);
        if (!$page) {
            //fallback
            $page = (new Page())
                ->setDescription(self::SMTHNG_WRONG)
                ->setTitle(self::SMTHNG_WRONG)
                ->setAddition(self::SMTHNG_WRONG)
                ->setContent1(self::SMTHNG_WRONG)
                ->setContent2(self::SMTHNG_WRONG)
                ->setContentTable(self::SMTHNG_WRONG)
                ->setKeywords(self::SMTHNG_WRONG);
        }

        return $this->render(
            'pages/main.html.twig',
            [
                'page' => $page,
                'menu' => $this->menuService->fetchDataForMenu(),
                'casinos_by_rates' => $this->menuService->fetchCasinosByRate(),
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
}
