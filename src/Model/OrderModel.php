<?php

namespace App\Model;

use App\Repository\OrderRepository;

/**
 * Processes changes of Order entity
 */
class OrderModel
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Returns data in format userEmail => [
     *                          'name' =>'example@mail.com',
     *                          'order' => [product1,product2,...],
     *                          'price' => *sum of products price*
     *                          ]
     * @return array
     */
    public function getAll(): array
    {
        $orders = $this->orderRepository->findAllOrders();
        $result = [];
        foreach ($orders as $row) {
            if (!array_key_exists($row['email'], $result)) {
                $result[$row['email']] =
                    [
                        'name' => $row['name'],
                        'order' => [$row['product']],
                        'price'=> $row['price']
                    ];
            } else {
                $result[$row['email']]['order'][] = $row['product'];
                $result[$row['email']]['price'] += $row['price'];
            }
        }
        return $result;
    }
}