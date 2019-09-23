<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 9/23/19
 * Time: 1:17 PM
 */

namespace App\Repositories;

use App\User;

class UserRepository
{

    public function store($userData)
    {
        $user = new User();
        $user->name = $userData->name;
        $user->email = $userData->email;
        $password =  $userData->password;
        if (!empty($password)) {
            $user->password = bcrypt($userData);
        }
        $user->remember_token = null;
        $save = $user->save();
        if ($save) {
            $role = $userData->role;
            $permissions = $userData->permissions;

            $user->roles()->attach($role);
            $user->attachPermissions($permissions);
            $user->save();
        }

        return $user;

    }


    public function update($userData, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $userData->name;
        $user->email = $userData->email;

        if (!empty($userData->password)) {
            $user->password = bcrypt($userData->password);
        }
        $save = $user->save();

        if ($save) {
            $role = $userData->role;
            $permissions = $userData->permissions;

            $user->roles()->sync($role);
            $user->permissions()->sync($permissions);
            $user->save();
        }

        return $user;
    }
}