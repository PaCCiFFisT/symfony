<?php

namespace App\Controller;

use App\Form\CreateUserType;
use App\Form\GetUserByFieldType;
use App\Form\UpdateUserType;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
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
        Request         $req,
        ManagerRegistry $registry
    ): Response
    {
        $form = $this->createForm(CreateUserType::class, null, [
            'method' => 'POST',
        ]);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $userRepo = new UserRepository($registry);

            /**
             * check for existing user with that mail in db
             * and save if not
             */
            if (!$userRepo->findBy(array("email" => $user->getEmail()))) {
                try {
                    $userRepo->save($user, true);

                    return $this->render('user/success/success.html.twig', ['message' => 'User has been created!']);
                } catch (Exception $e) {
                    return $this->render('user/error/error.html.twig');
                }
            } else {
                $route = $this->generateUrl($req->attributes->get('_route'));

                return $this->render('user/error/error.html.twig', [
                    'error' => 'User with this mail is already exist!',
                    'title_text' => 'Can\'t create user!',
                    'back_url' => $route
                ]);
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
    public function getByField(ManagerRegistry $registry, Request $req)
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

            if (count($fields) > 0) {
                $userRepo = new UserRepository($registry);

                try {
                    $user = $userRepo->findBy($fields);
                    return $this->json($user);
                } catch (Exception $e) {
                    return $this->render('user/error/error.html.twig', [
                        'title__text' => 'Can\'t foun user!'
                    ]);
                }
            } else {
                $route = $this->generateUrl($req->attributes->get('_route'));
                return $this->render('user/error/error.html.twig', [
                    'error' => 'You need to fill at least one field!',
                    'title_text' => 'Can\'t found user!',
                    'back_url' => $route
                ]);
            }


        }


        return $this->render('user/get/byField/get.html.twig', [
            'get_by_field' => $form->createView(),
        ]);

    }

    #[Route('user/update', name: 'app_user_update', methods: ["GET", "PATCH"])]
    public function updateUser(ManagerRegistry $registry, EntityManagerInterface $em, Request $req): Response
    {

        /**
         * prepare indexes to show in options fields
         */
        $queryBuilder = $em->createQueryBuilder();

        $query = $queryBuilder->select('u.id')
            ->from('App\Entity\User', 'u')
            ->orderBy('u.id', 'ASC')
            ->getQuery();

        $result = $query->getArrayResult();

        $indexes = array_map(function ($el) {
            $el = array_values($el);
            return $el[0];
        }, $result);

        array_unshift($indexes, '');

        /**
         * create form with ID
         */
        $form = $this->createForm(UpdateUserType::class, [
            'method' => "PATCH"
        ],
            [
                'id_options' => array_flip($indexes),
                'btn_text' => 'Update user'
            ]);

        $form->handleRequest($req);

        /**
         * TODO implement getting user by ID, create User object and show it in inputs
         * TODO maybe need send ajax to other route
        */

        if (isset($_GET['id'])) {
            echo 'abracadabra';
        }
        return $this->render('user/update/update.html.twig', [
            'form' => $form->createView(),
            'btn_text' => 'Update user!',
            'message' => 'Update user',
            'explain_text' => 'Use id to choose user to modify'
        ]);
    }

}
