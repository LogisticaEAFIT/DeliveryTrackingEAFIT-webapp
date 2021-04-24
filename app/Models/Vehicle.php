<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vehicle extends Model
{
    //attributes id, name, observations, is_active, warehouse_id, type_id,
    //created_at, updated_at
    protected $fillable = ['name', 'observations', 'warehouse_id', 'type_id'];

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

    public function getObservations()
    {
        return $this->attributes['observations'];
    }

    public function setObservations($observations)
    {
        $this->attributes['observations'] = $observations;
    }

    public function getIsActive()
    {
        return $this->attributes['is_active'];
    }

    public function setIsActive($is_active)
    {
        $this->attributes['is_active'] = $is_active;
    }

    public function getWarehouseId()
    {
        return $this->attributes['warehouse_id'];
    }

    public function setWarehouseId($warehouse_id)
    {
        $this->attributes['warehouse_id'] = $warehouse_id;
    }

    public function getTypeId()
    {
        return $this->attributes['type_id'];
    }

    public function setTypeId($type_id)
    {
        $this->attributes['type_id'] = $type_id;
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function type()
    {
        return $this->belongsTo(VehicleType::class, 'type_id');
    }

    public static function validate(Request $request)
    {
        $request->validate([
            "name" => ['required', 'string'],
            "observations" => ['required', 'string'],
        ]);
    }
}
