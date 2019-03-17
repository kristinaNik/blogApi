<?php

namespace App;


trait HasRoles
{

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignRole($role)
    {

        if (is_string($role)) {
            return app(Role::class)->findByName($role['id']);
        }

        return $role;

    }



    protected function getStoredRole($role): Role
    {

        if (is_string($role)) {
            return app(Role::class)->findByName($role)->id;
        }

        return $role;
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasRole($permission->roles);
    }


    public function syncRoles(array $roles)
    {
        $this->roles()->sync($this->getStoredRoleIds($roles));
    }

    protected function getStoredRoleIds($roles)
    {
        $ids = [];
        foreach ($roles as $role) {
            $ids[] = $this->assignRole($role);
        }
        collect($roles)->each(function ($role) {
            return $this->assignRole($role);
        });
    }


}
