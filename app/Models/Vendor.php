<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vendor extends Model
{
    //attributes id, is_active, name, contact_number, 
    //company_id, created_at, updated_at
    protected $fillable = ['name', 'contact_info', 'company_id'];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getIsActive()
    {
        return $this->attributes['is_active'];
    }

    public function setIsActive($is_active)
    {
        $this->attributes['is_active'] = $is_active;
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

    public function getCompanyId()
    {
        return $this->attributes['company_id'];
    }

    public function setCompanyId($company_id)
    {
        $this->attributes['company_id'] = $company_id;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function validate(Request $request)
    {
        $request->validate([
            "name" => ['required', 'string'],
            "contact_info" => ['required', 'string'],
        ]);
    }
}
