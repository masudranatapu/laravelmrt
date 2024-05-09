<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function proper_name()
    {
        switch ($this->type) {
            case 'Cash':
                return 'Cash';
                break;

            case 'Mobile Banking':
                return $this->mobile_bank_name . '  *****' . substr($this->mobile_number, -4);
                break;

            case 'Card':
                return $this->card_type . ' *****' . substr($this->card_number, -4);
                break;

            case 'Bank Account':
                return $this->bank->bank_name . ' *****' . substr($this->bank_account_name, -4);
                break;
            default:
                return 'Other';
                break;
        }

        return $this->type;
    }

    public function ledger()
    {
        return $this->hasMany(AccountLedger::class, 'account_id');
    }
}
