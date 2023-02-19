<?php

namespace App\Controller;

use App\Form\CreateUserType;
use App\Form\GetUserByFieldType;
use App\Form\UpdateUserType;
use App\Model\UserModel;
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
    private object $userModel;
    private EntityManagerInterface $em;
    private ManagerRegistry $registry;
    private UserRepository $userRepo;

    public function __construct(
        EntityManagerInterface $em,
        ManagerRegistry        $registry,
        UserModel              $userModel,
        UserRepository         $userRepo
    )
    {
        $this->userModel = $userModel;
        $this->em = $em;
        $this->registry = $registry;
        $this->userRepo = $userRepo;
    }

    /**
     * Shows user menu
     * @return Response
     */
    public function userAction(): Response
    {
        return $this->render('user/index.html.twig',
            ['encore_entry_link_tags' => 'app/css/user-styles.css']);
    }

    /**
     * Renders form for creating new user
     * @param Request $request
     * @return Response
     */
    #[Route('user/create', name: 'create_user', methods: ['GET', 'POST'])]
    public function createUser(Request $request): Response
    {
        $form = $this->createForm(CreateUserType::class, null, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $result = $this->userModel->createNewUser($user);

            if ($result != null) {
                return $this->json($result);
            } else {

                $route = $this->generateUrl($request->attributes->get('_route'));

                return $this->render('user/error/error.html.twig', [
                    'title_text' => "Can't create user",
                    'back_url' => $route,
                    'error' => "User already exist"
                ]);
            }
        }

        return $this->render('user/create/create.html.twig',
            ['user__create' => $form->createView()]);
    }

    /**
     * Returns list of all users in json format
     * @return Response
     */
    #[Route('user/get-all', name: 'app_user_get_all', methods: ['GET'])]
    public function getAll(): Response
    {

        $res = $this->userRepo->findAll();
        return $this->json($res);

    }

    /**
     * Render search user by field/s form
     * @param Request $request
     * @return Response json of founded users
     */
    #[Route('user/get-by-field', name: 'app_user_get_by_field', methods: [
        'GET',
        'POST',
    ])]
    public function getByField(Request $request): Response
    {
        $form = $this->createForm(GetUserByFieldType::class, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = array_slice($form->getData(), 1);
            $fields = array_filter($data, function ($key, $value) {
                if ($value != null) {
                    return $key;
                }
            }, ARRAY_FILTER_USE_BOTH);

            if (count($fields) > 0) {
                $result = $this->userModel->getUserByField($fields);

                if (count($result)>0){
                    return $this->json($result);
                }else{
                    $route = $this->generateUrl($request->attributes->get('_route'));

                    return $this->render('user/error/error.html.twig', [
                        'title_text' => 'Can\'t found user!' ,
                        'error' =>"User not found, try to change criteria",
                        'back_url'=>$route
                    ]);
                }

            } else {

                $route = $this->generateUrl($request->attributes->get('_route'));

                return $this->render('user/error/error.html.twig', [
                    'title_text' => 'Can\'t found user!',
                    'error' => 'You need to fill at least one field!',
                    'back_url' => $route
                ]);
            }

        }

        return $this->render('user/get/byField/get.html.twig', [
            'get_by_field' => $form->createView(),
        ]);

    }

    /**
     * Renders update user form
     * @param Request $req
     * @return Response json of updated user
     */
    #[Route('user/update', name: 'app_user_update', methods: ["GET", "POST", "PUT"])]
    public function updateUser(Request $req): Response
    {

        $indexes = $this->userModel->getUsersIds();

        $form = $this->createForm(UpdateUserType::class, [
            'method' => "POST",
        ],
            [
                'id_options' => array_flip($indexes),
                'btn_text' => 'Update user',
                'action' => $this->generateUrl($req->attributes->get('_route'))
            ]);

        /**
         * TODO implement getting user by ID, create User object and show it in inputs
         * TODO maybe need send ajax to other route
         */


        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
            if (isset($data['id'])) {
                return $this->json($this->userModel->getUserById($data['id']));
            }
        }
        if (isset($_GET['id'])) {
            return $this->json($this->userModel->getUserById($_GET['id']));
        }
        return $this->render('user/update/update.html.twig', [
            'form' => $form->createView(),
            'btn_text' => 'Update user!',
            'message' => 'Update user',
            'explain_text' => 'Use id to choose user to modify'
        ]);
    }

}
