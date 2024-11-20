<?php

namespace App\DTO;

/**
 * @OA\Schema(
 *     schema="UserDTO",
 *     required={"email"},
 *     @OA\Property(property="name", type="string", description="Имя пользователя"),
 *     @OA\Property(property="email", type="string", format="email", description="Email пользователя"),
 *     @OA\Property(property="age", type="integer", description="Возраст пользователя")
 * )
 */
class UserDTO
{
    public ?string $name;
    public ?string $email;
    public ?int $age;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->age = $data['age'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
        ]);
    }
}
