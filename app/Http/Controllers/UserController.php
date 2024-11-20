<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\DTO\UserDTO;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *     title="User API",
 *     version="1.0.0",
 *     description="API для управления пользователями"
 * )
 * @OA\Tag(
 *     name="Users",
 *     description="Операции с пользователями"
 * )
 */
class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Получить список пользователей",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Номер страницы",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список пользователей",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
    public function index()
    {
        $users = $this->userService->get();
        return UserResource::collection($users);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Получить пользователя по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация о пользователе",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пользователь не найден"
     *     )
     * )
     */
    public function show(int $id): UserResource
    {
        $user = $this->userService->getById($id);
        return new UserResource($user);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Создать пользователя",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserDTO")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Пользователь создан",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации"
     *     )
     * )
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $userDTO = new UserDTO($request->validated());
        $user = $this->userService->create($userDTO);

        return new UserResource($user);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Обновить информацию о пользователе",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserDTO")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Обновленный пользователь",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пользователь не найден"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации"
     *     )
     * )
     */
    public function update(UpdateUserRequest $request, int $id): UserResource
    {
        $userDTO = new UserDTO($request->validated());
        $user = $this->userService->update($id, $userDTO);

        return new UserResource($user);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     summary="Удалить пользователя",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Пользователь удален"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пользователь не найден"
     *     )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $this->userService->delete($id);
        return response()->json(['message' => 'User deleted successfully.'], 204);
    }
}
