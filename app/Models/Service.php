<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Service extends Model
{
    //attributes id, status, lower_time_window, upper_time_window, latitude, longitude,
    //route_order, delivery_route_id, created_at, updated_at
    protected $fillable = ['lower_time_window', 'upper_time_window',
                            'latitude', 'longitude', 'route_order', 'delivery_route_id'];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getLowerTimeWindow()
    {
        return $this->attributes['lower_time_window'];
    }

    public function setLowerTimeWindow($lower_time_window)
    {
        $this->attributes['lower_time_window'] = $lower_time_window;
    }

    public function getUpperTimeWindow()
    {
        return $this->attributes['upper_time_window'];
    }

    public function setUpperTimeWindow($upper_time_window)
    {
        $this->attributes['upper_time_window'] = $upper_time_window;
    }

    public function getRouteOrder()
    {
        return $this->attributes['route_order'];
    }

    public function setRouteOrder($route_order)
    {
        $this->attributes['route_order'] = $route_order;
    }

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function setStatus($status)
    {
        $this->attributes['status'] = $status;
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

    public function getDeliveryRouteId()
    {
        return $this->attributes['delivery_route_id'];
    }

    public function setDeliveryRouteId($delivery_route_id)
    {
        $this->attributes['delivery_route_id'] = $delivery_route_id;
    }

    public function deliveryRoute()
    {
        return $this->belongsTo(DeliveryRoute::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public static function validate(Request $request)
    {
        $request->validate([
            "lower_time_window" => ['required', 'regex:/([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            "upper_time_window" => ['required', 'regex:/([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            "route_order" => ['required', 'numeric'],
            "latitude" => ['required', 'numeric'],
            "longitude" => ['required', 'numeric'],
        ]);
    }

    public function validateModel(){
        $validator = Validator::make($this->toArray(), [
            "lower_time_window" => ['required', 'regex:/([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            "upper_time_window" => ['required', 'regex:/([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            "route_order" => ['required', 'numeric'],
            "latitude" => ['required', 'numeric'],
            "longitude" => ['required', 'numeric'],
            'delivery_route_id' => 'exists:delivery_routes,id',
        ])->validate();
    }
}
