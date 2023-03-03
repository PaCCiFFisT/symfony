<?php

namespace App\Model;

use App\Repository\OrderRepository;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Processes changes of Order entity
 */
class OrderModel
{
    private OrderRepository $orderRepository;
    private NormalizerInterface $normalizer;

    public function __construct(OrderRepository $orderRepository, NormalizerInterface $normalizer)
    {
        $this->orderRepository = $orderRepository;
        $this->normalizer = $normalizer;
    }

    /**
     * Returns data with all orders
     * @return array
     */
    public function getAll(): array
    {
        $orders = $this->orderRepository->findAllOrders();
        return $this->ordersToArray($orders);
    }

    /**
     * Returns data in format orderId => [
     *                          'name' => $name,
     *                          'email'=>$email,
     *                          'order' => [product1,product2,...],
     *                          'price' => *sum of products price*
     *                          ]
     * @param array $data
     * @return array
     */
    private function ordersToArray(array $data): array
    {
        $result = [];
        foreach ($data as $row) {
            if (!array_key_exists($row['order_id'], $result)) {
                $result[$row['order_id']] =
                    [
                        'email' => $row['email'],
                        'name' => $row['name'],
                        'order' => [$row['product']],
                        'price' => $row['price']
                    ];
            } else {
                $result[$row['order_id']]['order'][] = $row['product'];
                $result[$row['order_id']]['price'] += $row['price'];
            }
        }
        return $result;
    }

    /**
     * Returns one order got by ID
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        $data = $this->orderRepository->findOneOrder($id);
        return count($data) < 1 ? [] : $this->ordersToArray($data);
    }
}