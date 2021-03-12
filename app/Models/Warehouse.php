<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Warehouse extends Model
{
    //attributes id, description, address, latitude, longitude, created_at, updated_at
    protected $fillable = ['description', 'address', 'latitude', 'longitude'];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getAddress()
    {
        return $this->attributes['address'];
    }

    public function setAddress($address)
    {
        $this->attributes['address'] = $address;
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

    // belongsTo - company method

    public static function validate(Request $request)
    {
        $request->validate([
            "description" => ['required', 'string', 'min:1', 'max:255'],
            "address" => ['required', 'string', 'min:1', 'max:255'],
            "latitude" => ['required'],
            "longitude" => ['required'],
        ]);
    }
}
