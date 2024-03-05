<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function supplierInitialDue()
    {
        return $this->hasOne(InitialDue::class, "supplier_id");
    }

    public function supplierInitialDues()
    {
        return $this->hasMany(InitialDue::class, "supplier_id");
    }
}
