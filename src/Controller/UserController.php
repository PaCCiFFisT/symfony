<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;
use App\Form\GetUserByFieldType;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    public function userAction(): Response
    {
        return $this->render('user/index.html.twig',
            ['encore_entry_link_tags' => 'app/css/user-styles.css']);
    }

    #[Route('user/create', name: 'form_create_user', methods: ['GET', 'POST'])]
    public function formCreateUser(
        Request         $request,
        ManagerRegistry $registry
    ): Response
    {
        $form = $this->createForm(CreateUserType::class, null, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $userRepo = new UserRepository($registry);

            /**
             * check for existing user with that mail in db
             */
            dump(array("email"=>$user->getEmail()));
            if (!$userRepo->findBy(array("email"=>$user->getEmail()))){
                try {
                    $userRepo->save($user, true);

                    return $this->render('user/create/success/success.html.twig');
                } catch (Exception $e) {
                    return $this->render('user/create/error/error.html.twig');
                }
            }else{
                return $this->render('user/create/error/error.html.twig', ['error'=>'User with this mail is already exist!']);
            }




        }

        return $this->render('user/create/create.html.twig',
            ['user__create' => $form->createView()]);
    }

    #[Route('user/get-all', name: 'app_user_get_all', methods: ['GET'])]
    public function get(ManagerRegistry $registry): Response
    {
        $userRepo = new UserRepository($registry);
        $res = $userRepo->findAll();

        return $this->json($res);
    }

    #[Route('user/get-by-field', name: 'app_user_get_by_field', methods: [
        'GET',
        'POST',
    ])]
    public function getByField(ManagerRegistry $registry, EntityManagerInterface $em, Request $req)
    {
        $form = $this->createForm(GetUserByFieldType::class, [
            'method' => 'POST',
        ]);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = array_slice($form->getData(), 1);
            $fields = array_filter($data, function ($key, $value) {
                if ($value != null) {
                    return $key;
                }
            }, ARRAY_FILTER_USE_BOTH);
//
            $userRepo = new UserRepository($registry);

            $qb = $em->createQueryBuilder();

            try {
                $user = $userRepo->findBy($fields);
                return $this->json($user);
            } catch (Exception $e) {
                return $this->render('user/create/error/error.html.twig');
            }

        }


        return $this->render('user/get/byField/get.html.twig', [
            'get_by_field' => $form->createView(),
        ]);

    }

    private function isExist(mixed $user): bool
    {
        $em = new EntityManager();

    }

}
