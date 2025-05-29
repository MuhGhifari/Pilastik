<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'collector_id',
        'trash_bin_id',
        'schedule_time',
    ];

    /**
     * Get the collector assigned to the schedule.
     */
    public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }

    /**
     * Get the trash bin associated with the schedule.
     */
    public function trashBin()
    {
        return $this->belongsTo(TrashBin::class, 'trash_bin_id');
    }
}
