<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // attributes id, name, email, password, id_card_number, is_active, role, created_at, updated_at
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_card_number',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getName(){
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getEmail(){
        return $this->attributes['email'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }

    public function getIdCardNumber(){
        return $this->attributes['id_card_number'];
    }

    public function setIdCardNumber($id_card_number)
    {
        $this->attributes['id_card_number'] = $id_card_number;
    }

    public function getIsActive(){
        return $this->attributes['is_active'];
    }

    public function setIsActive($is_active)
    {
        $this->attributes['is_active'] = $is_active;
    }

    public function getRole(){
        return $this->attributes['role'];
    }

    public function setRole($role)
    {
        $this->attributes['role'] = $role;
    }

    // belongsTo - company method
}
