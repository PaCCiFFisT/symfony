<?php

namespace App\Controller;

use App\Model\OrderModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Processes requests of orders data
 */
class OrderController extends AbstractController
{

    private OrderModel $orderModel;

    public function __construct(
        OrderModel $orderModel,
    )
    {
        $this->orderModel = $orderModel;
    }

    /**
     * Returns all orders
     * @param Request $request
     * @return Response
     */
    #[Route('orders', name: 'app_orders_all', methods: ["GET"])]
    public function orders(Request $request): Response
    {
        return $this->json($this->orderModel->getAll());
    }

    /**
     * Returns single order
     * @param int $id - id of user
     * @return Response
     */
    #[Route('orders/{id}', name: 'app_orders_by_id', methods: ["GET"])]
    public function orderById(int $id): Response
    {
        $order = $this->orderModel->getById($id);

        return empty($order) ? new Response('Order not found', 404) : $this->json($order);
    }
}