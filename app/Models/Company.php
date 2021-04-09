<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Company extends Model
{
    //attributes id, name, contact_info, is_active, created_at, updated_at
    protected $fillable = ['name', 'contact_info'];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getContactInfo()
    {
        return $this->attributes['contact_info'];
    }

    public function setContactInfo($contact_info)
    {
        $this->attributes['contact_info'] = $contact_info;
    }

    public function getIsActive(){
        return $this->attributes['is_active'];
    }

    public function setIsActive($is_active)
    {
        $this->attributes['is_active'] = $is_active;
    }

    public function adminUsers(){
        return $this->hasMany(User::class);
    }

    public function warehouses(){
        return $this->hasMany(Warehouse::class);
    }

    public static function validate(Request $request)
    {
        $request->validate([
            "name" => ['required', 'string', 'min:1', 'max:255'],
            "contact_info" => ['required', 'string', 'min:1', 'max:255'],
        ]);
    }
}
