<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PickupLog;

class Rating extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'pickup_log_id',
        'score',
        'comments',
    ];

    /**
     * Get the pickup log associated with the rating.
     */
    public function pickupLog()
    {
        return $this->belongsTo(PickupLog::class, 'pickup_log_id');
    }
}
