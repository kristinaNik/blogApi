<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserManagement\ReadUserManagement;
use App\Http\Requests\UserManagement\StoreUserManagement;
use App\Http\Resources\UserCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;

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
        $users =  User::all();
        return new UserCollection($users);
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
     * @param $id
     * @return UserResource
     * @throws \Exception
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
