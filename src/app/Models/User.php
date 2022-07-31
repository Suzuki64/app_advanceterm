<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites()
    {
        return $this->belongsToMany('App\Models\Shop','favorites','user_id','shop_id');
    }

    public function favo($shop_id)
    {
        $this->favorites()->attach($shop_id);
    }

    public function unfavo($shop_id)
    {
        $this->favorites()->detach($shop_id);
    }

    public function isFavorite($shop_id)
    {
        return $this->favorites()->where('shop_id',$shop_id)->exists();
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function getRoleItem($id)
    {
        return $this->find($id)->role()->first();
    }

    public function reserves()
    {
        return $this->belongsToMany('App\Models\Shop','favorites','user_id','shop_id');
    }

    public function editors()
    {
        return $this->belongsToMany('App\Models\Shop','editors','user_id','shop_id');
    }
   
    public function getEditorItem($id)
    {
        return $this->find($id)->Editors()->first();
    }

}
