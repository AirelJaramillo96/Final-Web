<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'master_code'
    ];

    public function branch() {
        return $this->hasOne(Branch::class);
    }
}
