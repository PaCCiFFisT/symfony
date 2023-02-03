<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class UserController extends AbstractController
{
    #[Route( '/create', name: 'form_create_user', methods: ['GET','POST'])]
    public function formCreateUser(Request $request, ManagerRegistry $registry): Response
    {
        $form = $this->createForm(CreateUserType::class, null,[
            'method'=>'POST'
//            'action'=>'/create/send'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = new User();
            $user = $form->getData();

            $userRepo = new UserRepository($registry);

            try {
                $userRepo->save($user, true);
                return $this->render('user/create/success.html.twig');
            }catch (Exception $e){
                return $this->render('user/create/error.html.twig');
            }


        }

        return $this->render('user/create/create.html.twig', ['user__create' => $form->createView()]);
    }

    #[Route('/create/send', 'create_user', methods: ['POST'])]
    public function actionCreateUser(ManagerRegistry $registry)
    {
        $userRepo = new UserRepository($registry);


    }



    #[Route('/get-all', name: 'app_user_get_all', methods: ['GET'])]
    public function get(ManagerRegistry $registry) : Response
    {
        $userRepo = new UserRepository($registry);
        $res = $userRepo->findAll();
        return $this->json($res);
   }


}
