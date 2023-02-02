<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'app_user_controller')]
class UserController extends AbstractController
{
    #[Route('', name: 'app_user_create', methods: ['GET'])]
    public function get(ManagerRegistry $registry) : Response
    {
        $userRepo = new UserRepository($registry);
        $res = $userRepo->findAll();
        return $this->json($res);
   }

    #[Route('/create', name: 'app_user_create', methods: ['POST'])]
    public function crate(ManagerRegistry $registry) : Response
    {
        $userRepo = new UserRepository($registry);
        $res = $userRepo->findAll();
        return $this->json($res);
    }

}
