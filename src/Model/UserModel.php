<?php

namespace App\Model;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class UserModel
{
    private ManagerRegistry $registry;
    private EntityManagerInterface $em;
    private UserRepository $userRepo;

    public function __construct(
        EntityManagerInterface $em,
        ManagerRegistry        $registry,
        UserRepository         $userRepo
    )
    {
        $this->registry = $registry;
        $this->em = $em;
        $this->userRepo = $userRepo;
    }

    /**
     * Gets user data and save it using Repository
     * @param $user
     * @return array | null
     */
    public function createNewUser($user): array|null
    {

        /**
         * check for existing user with that email in db
         * and save if not
         */
        if (!$this->userRepo->findBy(["email" => $user->getEmail()])) {
            $this->userRepo->save($user, true);
            return $this->userRepo->findBy(["email" => $user->getEmail()]);
        } else {
            return null;
        }

    }

    /**
     * Returns all entries depend on fields data
     * @param $fields
     * @return array
     */
    public function getUserByField($fields): array
    {
        return $this->userRepo->findBy($fields);
    }

    /**
     * Prepares users ids for show in select field
     * @return array
     */
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

    /**
     * Returns founded user data as array;
     * @param $id
     * @return array
     */
    public function getUserById($id): array
    {
        return $this->userRepo->findBy(['id' => $id]);
    }

    public function updateUser(array $data): bool
    {
        $qb = $this->em->createQueryBuilder();

//        $qb->update('App:User', 'u')
//            ->set('')
    }
}