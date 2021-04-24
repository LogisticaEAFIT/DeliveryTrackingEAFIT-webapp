<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DeliveryRoute extends Model
{
    //attributes id, date, completed_deliveries, number_of_deliveries, state,
    //warehouse_id, courier_id, vehicle_id, created_at, updated_at
    protected $fillable = ['date', 'completed_deliveries', 'number_of_deliveries', 'state',
                            'warehouse_id', 'courier_id', 'vehicle_id'];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getDate()
    {
        return $this->attributes['date'];
    }

    public function setDate($date)
    {
        $this->attributes['date'] = $date;
    }

    public function getCompletedDeliveries()
    {
        return $this->attributes['completed_deliveries'];
    }

    public function setCompletedDeliveries($completed_deliveries)
    {
        $this->attributes['completed_deliveries'] = $completed_deliveries;
    }

    public function getNumberOfDeliveries()
    {
        return $this->attributes['number_of_deliveries'];
    }

    public function setNumberOfDeliveries($number_of_deliveries)
    {
        $this->attributes['number_of_deliveries'] = $number_of_deliveries;
    }

    public function getState()
    {
        return $this->attributes['state'];
    }

    public function setState($state)
    {
        $this->attributes['state'] = $state;
    }

    public function getWarehouseId()
    {
        return $this->attributes['warehouse_id'];
    }

    public function setWarehouseId($warehouse_id)
    {
        $this->attributes['warehouse_id'] = $warehouse_id;
    }

    public function getCourierId()
    {
        return $this->attributes['courier_id'];
    }

    public function setCourierId($courier_id)
    {
        $this->attributes['courier_id'] = $courier_id;
    }

    public function getVehicleId()
    {
        return $this->attributes['vehicle_id'];
    }

    public function setVehicleId($vehicle_id)
    {
        $this->attributes['vehicle_id'] = $vehicle_id;
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function courier()
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public static function validate(Request $request)
    {
        $request->validate([
            "date" => ['required'],
            "completed_deliveries" => ['required', 'numeric', 'gte:0'],
            "number_of_deliveries" => ['required', 'numeric', 'gt:0', 'gte:completed_deliveries'],
        ]);
    }
}
