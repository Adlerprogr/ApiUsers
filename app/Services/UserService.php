<?php

namespace App\Services;

use App\Models\User;
use App\DTO\UserDTO;

class UserService
{
    public function get(int $paginate = 10)
    {
        return User::paginate($paginate);
    }

    public function getById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function create(UserDTO $userDTO): User
    {
        return User::create([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'age' => $userDTO->age,
        ]);
    }

    public function update(int $id, UserDTO $userDTO): User
    {
        $user = User::findOrFail($id);

        $user->update($userDTO->toArray());

        return $user;
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
