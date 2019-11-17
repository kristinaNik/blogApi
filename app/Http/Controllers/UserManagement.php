<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserManagement\ReadUserManagement;
use App\Http\Requests\UserManagement\StoreUserManagement;
use App\Http\Requests\UserManagement\UpdateUserManagement;
use App\Permission;
use App\Repositories\UserRepository;
use App\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Role as RoleResource;
use App\Http\Resources\Permission as PermissionResource;

class UserManagement extends Controller
{
    /**
     * @param ReadUserManagement $request
     * @param UserRepository $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ReadUserManagement $request, UserRepository $user)
    {

        $query = $request->get('query');

        if ($query != '') {
            $data = $user->searchUsers($query);
        } else {
            $data = $user->getUsers();

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
     * @param UserRepository $userRepository
     * @param $id
     * @return UserResource
     */
    public function show(UserRepository $userRepository, $id)
    {
        try {
            $user = $userRepository->show($id);
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
    public function update(UpdateUserManagement $request, $id, UserRepository $userRepository)
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

    /**
     * Get Permissions
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getPermissions() {
        $permissions = Permission::all();

        return PermissionResource::collection($permissions);
    }

    /**
     * @param UserRepository $userRepository
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(UserRepository $userRepository, $id)
    {
        try {
            $user = $userRepository->destroy($id);
            return response()->json(['success' => ['message' => "User deleted successfully", 'user' => $user]]);
        }catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }

    public function edit(UserRepository $userRepository, $id)
    {
        try {
            $user = $userRepository->show($id);

            $roles = Role::all();
            $permissions = Permission::all();
            $roleName = $user->roles->pluck('name')[0];
            $roleNameId = $user->roles->pluck('id')[0];
            $allRoles = $roles->where('name', '!=', $roleName)->pluck('name', 'id');
            $permissionNames = $permissions->pluck('name', 'id');

            return view('edit_users')->with(['user'=> $user, 'roleNameId' => $roleNameId, 'roleName' => $roleName, 'allRoles' => $allRoles, 'permissionNames'=> $permissionNames]);

        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }
    }
}
