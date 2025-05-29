<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(Schedule::class, 'collection_run_id');
    }

    /**
     * Get the drop-off location associated with the log.
     */
    public function location()
    {
        return $this->belongsTo(DropOffLocation::class, 'location_id');
    }
}
