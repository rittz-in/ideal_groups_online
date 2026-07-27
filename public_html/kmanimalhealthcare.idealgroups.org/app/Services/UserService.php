<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($UserData)
    {
        $user = $this->userRepository->create($UserData);
        return $user;
    }

    public function getAllUser()
    {
        $user = $this->userRepository->getAll();
        return $user;
    }

    public function getUser($id)
    {
        $User = $this->userRepository->find($id);
        return $User;
    }

    public function deleteUser($id)
    {
        $deleted = $this->userRepository->delete($id);
        return $deleted;
    }

    public function updateUser($id, $UserData)
    {
        $updated = $this->userRepository->update($id, $UserData);
        return $updated;
    }

}
