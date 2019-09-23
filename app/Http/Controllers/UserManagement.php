<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserManagement\DeleteUserManagement;
use App\Http\Requests\UserManagement\ReadUserManagement;
use App\Http\Requests\UserManagement\StoreUserManagement;
use App\Http\Requests\UserManagement\UpdateUserManagement;
use App\Http\Resources\UserCollection;
use App\Permission;
use App\Repositories\UserRepository;
use App\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Role as RoleResource;
use App\Http\Resources\Permission as PermissionResource;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserManagement extends Controller
{
    /**
     * Get all users
     *
     * @param ReadUserManagement $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ReadUserManagement $request)
    {

        $query = $request->get('query');

        if ($query != '') {
            $data = User::userSearch($query);
        } else {
            $data = User::getUsers();

        }

        $totalRows = $data->count();
        if ($totalRows > 0) {

            return UserResource::collection($data, $totalRows);
        }
    }


    /**
     * Store new user
     *
     * @param StoreUserManagement $request
     * @param UserRepository $userRepository
     * @return UserResource
     */
    public function store(StoreUserManagement $request, UserRepository $userRepository)
    {
        $user = $userRepository->store($request);

        return new UserResource($user);
    }


    /**
     * @param $id
     * @return UserResource
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return new UserResource($user);

        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }

    }


    /**
     * Update the specified resource in storage
     *
     * @param UpdateUserManagement $request
     * @param UserRepository $userRepository
     * @param $id
     * @return UserResource
     */
    public function update(UpdateUserManagement $request, UserRepository $userRepository, $id)
    {
        try {
            $user = $userRepository->update($request, $id);

            return new UserResource($user);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }

    }

    /**
     * Get Roles
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getRoles() {
        $roles = Role::all();

        return RoleResource::collection($roles);
    }

    public function getPermissions() {
        $permissions = Permission::all();

        return PermissionResource::collection($permissions);
    }

    /**
     * Soft delete a user
     *
     * @param DeleteUserManagement $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteUserManagement $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['success' => ['message' => "User deleted successfully"]]);
        }catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }
}
