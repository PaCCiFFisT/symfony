<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'app_user_create')]
class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user_create')]
    public function index(ManagerRegistry $registry): Response
    {
        $reqType = $_SERVER['REQUEST_METHOD'];

        if ($reqType == "GET") {
            $data = [];
            foreach ($_GET as $key => $value) {
                $data[$key] = htmlspecialchars($value);
            }
            $entityManager = $registry->getManager();
            $this->createUser($entityManager, $data);
            $path='/'.$reqType;
        }


        $twigPath = isset($path) ? 'user' . $path . '/index.html.twig' : 'user/index.html.twig';
        return $this->render($twigPath, [
            'controller_name' => 'UserController',
            'reqType' => $reqType
        ]);

    }

    private function createUser(ObjectManager  $entityManager, $data)
    {

        $user = new User();
        if (isset($data['avatar'])) {
            $user->setAvatar($data['avatar']);
        }
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword(sha1($data['password']));
        $user->setRole($data['role']);

        $entityManager->persist($user);
        $entityManager->flush();

    }

}
