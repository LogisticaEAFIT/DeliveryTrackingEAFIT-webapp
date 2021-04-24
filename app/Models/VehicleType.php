<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VehicleType extends Model
{
    //attributes id, capacity, description, volume, is_active, created_at, updated_at
    protected $fillable = ['capacity', 'description', 'volume'];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getCapacity()
    {
        return $this->attributes['capacity'];
    }

    public function setCapacity($capacity)
    {
        $this->attributes['capacity'] = $capacity;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getVolume()
    {
        return $this->attributes['volume'];
    }

    public function setVolume($volume)
    {
        $this->attributes['volume'] = $volume;
    }

    public function getIsActive()
    {
        return $this->attributes['is_active'];
    }

    public function setIsActive($is_active)
    {
        $this->attributes['is_active'] = $is_active;
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public static function validate(Request $request)
    {
        $request->validate([
            "capacity" => ['required', 'numeric', 'gte:0'],
            "description" => ['required', 'string'],
            "volume" => ['required', 'numeric', 'gt:0'],
        ]);
    }
}
