<?php

namespace App\Model;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class UpdateUserModel
{
    private ManagerRegistry $registry;
    private EntityManagerInterface $em;
    private UserRepository $userRepo;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry, UserRepository $userRepo)
    {
        $this->registry = $registry;
        $this->em = $em;
        $this->userRepo = $userRepo;
    }

    public function getUsersIds(): array
    {

        $queryBuilder = $this->em->createQueryBuilder();

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

        return $indexes;
    }

    public function getUserById($id) : array
    {
        return $this->userRepo->findBy(['id'=>$id]);
    }

}