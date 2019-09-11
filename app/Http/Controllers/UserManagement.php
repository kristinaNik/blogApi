<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserManagement\DeleteUserManagement;
use App\Http\Requests\UserManagement\ReadUserManagement;
use App\Http\Requests\UserManagement\StoreUserManagement;
use App\Http\Requests\UserManagement\UpdateUserManagement;
use App\Http\Resources\UserCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserManagement extends Controller
{

    /**
     * Get all users
     *
     * @param ReadUserManagement $request
     * @return UserCollection
     */
    public function index(ReadUserManagement $request)
    {
        if ($request->ajax()) {
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
    }

    /**
     * @param StoreUserManagement $request
     * @return UserResource
     */
    public function store(StoreUserManagement $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $password =  $request->password;
        if (!empty($password)) {
            $user->password = Hash::make($password);
        }
        $user->remember_token = null;
        $save = $user->save();

        if ($save) {
            $role = $request->input('role', []);
            $permissions = $request->input('permissions', []);

            $user->roles()->attach($role);
            $user->attachPermissions($permissions);
            $user->save();
        }

        return new UserResource($user);
    }



    /**
     * Display user
     *
     * @param ReadUserManagement $request
     * @param $id
     * @return UserResource
     */
    public function show(ReadUserManagement $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            return new UserResource($user);

        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return UserResource
     */
    public function update(UpdateUserManagement $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if (!empty($request->input('password'))) {
                $user->password = Hash::make($request->input('password'));
            }
            $save = $user->save();

            if ($save) {
                $role = $request->input('role');
                $permissions = $request->input('permissions', []);

                $user->roles()->sync($role);
                $user->permissions()->sync($permissions);
                $user->save();
            }

            return new UserResource($user);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        }

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
