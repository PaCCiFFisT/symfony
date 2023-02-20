<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Saves new user into db
     * @param User $entity
     * @param bool $flush
     * @return void
     */
    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Deletes user from db
     * @param User $entity
     * @param bool $flush
     * @return void
     */
    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Returns all founded entries depend on field data
     * @param $value
     * @return array
     */
    public function findByField($value): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.field = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * Returns one entry depend on field data
     * @param $value
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Gets all user-ids from db
     * @return array
     */
    public function getIds() : array
    {
        return $this->createQueryBuilder('user')
            ->select('user.id')
            ->distinct()
            ->from('App\Entity\User', 'u')
            ->orderBy('user.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Updates one entry
     * @param $data
     * @return void
     */
    public function updateOne($data) : void
    {

        $this->createQueryBuilder('u')
            ->update('App:User', 'u')
            ->setParameter('userName', $data['name'])
            ->setParameter('userEmail', $data['email'])
            ->setParameter('userPassword', $data['password'])
            ->setParameter('id', $data['id'])
            ->set('u.name', ':userName')
            ->set('u.email', ':userEmail')
            ->set('u.password', ':userPassword')
            ->where('u.id = :id')
            ->getQuery()
            ->execute();
    }
}
