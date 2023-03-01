<?php

namespace App\Controller;

use App\Model\OrderModel;
use App\Model\UserModel;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Processes requests of orders data
 */
class OrderController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    private OrderModel $orderModel;
    private OrderRepository $orderRepo;

    public function __construct(
        OrderModel              $orderModel,
        OrderRepository         $orderRepo
    )
    {
        $this->orderModel = $orderModel;
        $this->orderRepo = $orderRepo;
    }

    /**
     * Returns all orders
     * @param Request $request
     * @return Response
     */
    #[Route('orders', name: 'app_orders_all', methods: ["GET"])]
    public function getAllOrders(Request $request) : Response
    {
        return $this->json($this->orderModel->getAll());
    }

}