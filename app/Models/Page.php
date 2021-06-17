<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'can_have_posts',
        'content',
        'menu_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getPermissionsAttribute()
    {
        $permissions = new Collection();
        $roles = $this->roles->load('permissions');
        foreach ($roles as $role) {
            $permissions = $permissions->mergeRecursive($role->permissions);
        }
        return $permissions->filter(function ($permission) {
            return str_contains($permission->title, $this->title);
        });
    }

    public function menu_items()
    {
        return $this->morphMany(MenuItem::class, 'menu_itemable');
    }
}
