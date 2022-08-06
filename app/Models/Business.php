<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'currency_id',
        'owner_id',
        'currency_symbol',
        'currency_symbol_placement',
        'tax_number',
        'logo',
        'email_settings',
        'sms_settings'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_settings' => 'array',
    ];

    public function getLogoPathAttribute()
    {
        return !is_null($this->logo) ? asset('images/' . $this->logo) : null;
    }

    public function getBusinessCurrencyAttribute()
    {
        return [
            'currency'  => $this->currency->currency,
            'code'      => $this->currency->code,
            'symbol'    => $this->currency->symbol
        ];
    }

    /**
     * Get the owner details
     */
    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the Business currency.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the location details
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
