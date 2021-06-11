<?php
// Created by: Juan Sebastián Pérez Salazar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Bill extends Model
{
    //attributes id, status, lower_time_window, upper_time_window, latitude, longitude,
    //route_order, delivery_route_id, created_at, updated_at
    protected $fillable = ['observations', 'amount_to_be_paid', 'paid_in_advance', 'amount_paid',
                            'payment_type', 'customer_id', 'service_id', 'vendor_id'];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getObservations()
    {
        return $this->attributes['observations'];
    }

    public function setObservations($observations)
    {
        $this->attributes['observations'] = $observations;
    }

    public function getAmountToBePaid()
    {
        return $this->attributes['amount_to_be_paid'];
    }

    public function setAmountToBePaid($amount_to_be_paid)
    {
        $this->attributes['amount_to_be_paid'] = $amount_to_be_paid;
    }

    public function getPaidInAdvance()
    {
        return $this->attributes['paid_in_advance'];
    }

    public function setPaidInAdvance($paid_in_advance)
    {
        $this->attributes['paid_in_advance'] = $paid_in_advance;
    }

    public function getAmountPaid()
    {
        return $this->attributes['amount_paid'];
    }

    public function setAmountPaid($amount_paid)
    {
        $this->attributes['amount_paid'] = $amount_paid;
    }

    public function getPaymentType()
    {
        return $this->attributes['payment_type'];
    }

    public function setPaymentType($payment_type)
    {
        $this->attributes['payment_type'] = $payment_type;
    }

    public function getCustomerId()
    {
        return $this->attributes['customer_id'];
    }

    public function setCustomerId($customer_id)
    {
        $this->attributes['customer_id'] = $customer_id;
    }

    public function getServiceId()
    {
        return $this->attributes['service_id'];
    }

    public function setServiceId($service_id)
    {
        $this->attributes['service_id'] = $service_id;
    }

    public function getVendorId()
    {
        return $this->attributes['vendor_id'];
    }

    public function setVendorId($vendor_id)
    {
        $this->attributes['vendor_id'] = $vendor_id;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public static function validate(Request $request)
    {
        $request->validate([
            "observations" => ['required', 'string'],
            "amount_to_be_paid" => ['required', 'numeric'],
            "paid_in_advance" => ['required', 'numeric'],
            "amount_paid" => ['required', 'numeric'],
            "payment_type" => ['required'],
        ]);
    }
}
