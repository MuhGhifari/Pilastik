<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\DropOffLog;

class CollectionRun extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'collector_id',
        'vehicle_id',
        'start_time',
        'end_time',
    ];

    /**
     * Get the vehicle associated with the collection run.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    /**
     * Get the collector assigned to the collection run.
     */
    public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }

    public function dropOffLogs() {
        return $this->hasMany(DropOffLog::class, 'collection_run_id');
    }
}
