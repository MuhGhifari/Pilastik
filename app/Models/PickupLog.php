<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CollectionRun;
use App\Models\TrashBin;
use App\Models\Rating;

class PickupLog extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'trash_bin_id',
        'collection_run_id',
        'pickup_time',
    ];

    /**
     * Get the trash bin associated with the pickup log.
     */
    public function trashBin()
    {
        return $this->belongsTo(TrashBin::class, 'trash_bin_id');
    }

    /**
     * Get the collection run associated with the pickup log.
     */
    public function collectionRun()
    {
        return $this->belongsTo(CollectionRun::class, 'collection_run_id');
    }

    public function rating() {
        return $this->hasOne(Rating::class, 'pickup_log_id');
    }
}
