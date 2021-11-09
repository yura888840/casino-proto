<?php

namespace App\Controller;

use App\Entity\Casino;
use App\Entity\Page;
use App\Repository\CasinoRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    private const SMTHNG_WRONG = 'Something went wrong';

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
            ]
        );
    }

    /**
     * @Route("/rating/{ratingName}")
     * @param Request $request
     */
    public function ratingPage(Request $request, string $ratingName): Response
    {
        return $this->redirect($this->generateUrl('main'));
    }
}
