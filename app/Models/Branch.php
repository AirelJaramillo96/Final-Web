<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'open', 'close', 'organization_id', 'device_id'
    ];

    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function device() {
        return $this->belongsTo(Device::class);
    }
}
