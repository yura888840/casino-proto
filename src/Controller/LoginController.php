<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    private const SMTHNG_WRONG = 'Something went wrong';

    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils, PageRepository $repository): Response
    {

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

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

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'page' => $page,
        ]);
    }
}
