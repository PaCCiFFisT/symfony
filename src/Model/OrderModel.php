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
     *     * Returns data in format orderId => [
     *                          'name' => 'name'
     *                          'email' =>'example@mail.com',
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
            if (!array_key_exists($row['order_id'], $result)) {
                $result[$row['order_id']] =
                    [
                        'email' => $row['email'],
                        'name' => $row['name'],
                        'order' => [$row['product']],
                        'price'=> $row['price']
                    ];
            } else {
                $result[$row['order_id']]['order'][] = $row['product'];
                $result[$row['order_id']]['price'] += $row['price'];
            }
        }
        return $result;
    }

    /**
     * Returns data in format orderId => [
     *                          'name' => $name,
     *                          'email'=>$email,
     *                          ''
     *                          ]
     * @param int $id
     * @return array
     */
    public function getById(int $id) : array
    {
    }
}