<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="User",
 *     required={"id", "email"},
 *     @OA\Property(property="id", type="integer", description="ID пользователя"),
 *     @OA\Property(property="name", type="string", description="Имя пользователя"),
 *     @OA\Property(property="email", type="string", format="email", description="Email пользователя"),
 *     @OA\Property(property="age", type="integer", description="Возраст пользователя")
 * )
 */
class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'age'
    ];
}
