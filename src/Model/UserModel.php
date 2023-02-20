<?php

namespace App\Model;

use App\Entity\User;
use App\Repository\UserRepository;

/**
 * Processes changes of User entity
 */
class UserModel
{

    private UserRepository $userRepo;

    public function __construct(
        UserRepository         $userRepo
    )
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Gets user data and save it using Repository
     * @param $user
     * @return array | null returns null if not a single user found
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

        $ids = $this->userRepo->getIds();
        $indexes = [];
        $indexes[0] = '';

        foreach ($ids as $value) {
            $indexes[$value['id']] = $value['id'];
        }

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

    /**
     * Gets data from controller, transfers for updating and then returns new user data
     * @param array $data
     * @return User updated User object
     */
    public function updateUser(array $data): User
    {
        $this->userRepo->updateOne($data);
        return $this->userRepo->find($data['id']);
    }
}