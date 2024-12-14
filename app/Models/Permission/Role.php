<?php

namespace App\Models\Permission;

use Spatie\Translatable\HasTranslations;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    use HasTranslations;
    public $translatable = ['title'];

    protected $fillable = ['name', 'guard_name','title'];
    protected $appends = ['permissions_ids', 'users_ids','main_permissions', 'date'];

    protected $attributes = [
        'guard_name' => 'admin',
    ];

    public function getPermissionsIdsAttribute()
    {
        return $this->permissions->pluck('id')->toArray();
    }

    //main_permissions
    public function getMainPermissionsAttribute()
    {
        $ids = $this->permissions->pluck('permission_id')->toArray();
        $permissions = Permission::whereIn('id', $ids)->get();
        foreach ($permissions as $permission) {
            $permission->sub = $this->permissions->where('permission_id', $permission->id);
        }
        return $permissions;
    }

    public function getUsersIdsAttribute()
    {
        return !empty($this->users) && count($this->users) > 0
            ? $this->users()
                ->where('active', 1)
                ->pluck('id')
                ->toArray()
            : [];
    }


}