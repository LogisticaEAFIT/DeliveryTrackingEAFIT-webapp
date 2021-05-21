<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Customer extends Model
{
    //attributes id, name, phone_number, address, latitude, longitude, 
    //observations, company_id, state, created_at, updated_at
    protected $fillable = ['name', 'phone_number', 'address',
                            'latitude', 'longitude', 'observations', 'company_id'];

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

    public function getPhoneNumber()
    {
        return $this->attributes['phone_number'];
    }

    public function setPhoneNumber($phone_number)
    {
        $this->attributes['phone_number'] = $phone_number;
    }

    public function getAddress()
    {
        return $this->attributes['address'];
    }

    public function setAddress($address)
    {
        $this->attributes['address'] = $address;
    }

    public function getState()
    {
        return $this->attributes['state'];
    }

    public function setState($state)
    {
        $this->attributes['state'] = $state;
    }

    public function getLatitude()
    {
        return $this->attributes['latitude'];
    }

    public function setLatitude($latitude)
    {
        $this->attributes['latitude'] = $latitude;
    }

    public function getLongitude()
    {
        return $this->attributes['longitude'];
    }

    public function setLongitude($longitude)
    {
        $this->attributes['longitude'] = $longitude;
    }

    public function getObservations()
    {
        return $this->attributes['observations'];
    }

    public function setObservations($observations)
    {
        $this->attributes['observations'] = $observations;
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
            "phone_number" => ['required', 'string'],
            "address" => ['required', 'string'],
            "latitude" => ['required', 'numeric'],
            "longitude" => ['required', 'numeric'],
            "observations" => ['required', 'string'],
        ]);
    }
}
