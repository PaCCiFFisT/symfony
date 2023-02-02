<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user_create')]
    public function index(): Response
    {
      $reqType = $_SERVER['REQUEST_METHOD'];


       if ($reqType == "POST"){
//         $this->createUser();
       }

       $twigPath = isset($path)? 'user'.$path.'/index.html.twig' : 'user/index.html.twig';
      return $this->render($twigPath, [
        'controller_name' => 'UserController',
        'reqType'=>$reqType
      ]);
    }

  private function createUser() {
      $user = new User();
      if (isset($_POST['avatar'])){
        $user->setAvatar($_POST['avatar']);
      }
    $user->setName($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setRole($_POST['role']);
  }

}
