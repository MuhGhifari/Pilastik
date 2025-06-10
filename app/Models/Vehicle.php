<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CollectionRun;

class Vehicle extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'license_plate',
        'vehicle_type',
        'model',
        'status',
        'capacity',
    ];

    public function collectionRun() {
        return $this->hasMany(CollectionRun::class, 'vehicle_id');
    }
}
