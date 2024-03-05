<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function customerInitialDue()
    {
        return $this->hasOne(InitialDue::class, "customer_id");
    }

    public function customerInitialDues()
    {
        return $this->hasMany(InitialDue::class, "customer_id");
    }
}
