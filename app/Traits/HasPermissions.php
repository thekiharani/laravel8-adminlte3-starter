<?php


namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasPermissions
{
    /**
     * @param mixed ...$permissions
     * @return  mixed
     */
    public function givePermissions(... $permissions) {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * @param mixed ...$roles
     * @return  mixed
     */
    public function giveRoles(... $roles) {
        $roles = $this->getAllRoles($roles);
        if($roles === null) {
            return $this;
        }
        $this->roles()->saveMany($roles);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return  mixed
     */
    public function withdrawPermissions( ... $permissions) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * @param mixed ...$roles
     * @return  mixed
     */
    public function withdrawRoles( ... $roles) {
        $roles = $this->getAllRoles($roles);
        $this->roles()->detach($roles);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return  mixed
     */
    public function refreshPermissions( ... $permissions) {
        $this->permissions()->detach();
        return $this->givePermissions($permissions);
    }

    /**
     * @param mixed ...$roles
     * @return  mixed
     */
    public function refreshRoles( ... $roles) {
        $this->roles()->detach();
        return $this->giveRoles($roles);
    }

    /**
     * @param $permission
     * @return  bool
     */
    public function hasPermission($permission): bool
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasDirectPermission($permission);
    }

    /**
     * @param $permission
     * @return  boolean
     */
    public function hasPermissionThroughRole($permission): bool
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param mixed ...$roles
     * @return  boolean
     */
    public function hasRole( ... $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return  mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    /**
     * @return  mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    /**
     * @param $permission
     * @return  boolean
     */
    protected function hasDirectPermission($permission): bool
    {
        return (bool) $this->permissions()->where('slug', $permission->slug)->count();
    }

    /**
     * @param mixed ...$permissions
     * @return  mixed
     */
    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug',$permissions)->get();
    }

    /**
     * @param array $roles
     * @return  mixed
     */
    protected function getAllRoles(array $roles)
    {
        return Role::whereIn('slug',$roles)->get();
    }
}
