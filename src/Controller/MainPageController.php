<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller of main page behavior
 */
class MainPageController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * Main page render
     * @return Response
     */
    #[Route(path: '/', name: 'app_main_page', methods: ["GET"])]
    public function mainPage(Request $request):Response
    {
        return $this->render('main/main.html.twig');
    }
}