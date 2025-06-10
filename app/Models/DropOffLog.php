<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DropOffLocation;
use App\Models\CollectionRuns;

class DropOffLog extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'drop_off_location_id',
        'collection_run_id',
        'weight',
        'drop_off_time',
        'notes',
    ];

    /**
     * Get the collection run associated with the drop-off log.
     */
    public function collectionRun()
    {
        return $this->belongsTo(CollectionRun::class, 'collection_run_id');
    }

    /**
     * Get the drop-off location associated with the log.
     */
    public function dropOffLocation()
    {
        return $this->belongsTo(DropOffLocation::class, 'drop_off_location_id');
    }
}
