<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PickupLog;
use App\Models\Schedule;
use App\Models\User;

class TrashBin extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    const BIN_TYPES = ['organic', 'inorganic'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'resident_id',
        'bin_type',
        'status',
        'latitude',
        'longitude',
        'capacity',
    ];

    /**
     * Get the resident that owns the trash bin.
     */
    public function resident()
    {
        return $this->belongsTo(User::class, foreignKey: 'resident_id');
    }

    public function schedules() {
        return $this->hasMany(Schedule::class, foreignKey: 'trash_bin_id');
    }

    public function pickupLogs() {
        return $this->hasMany(PickupLog::class, foreignKey: 'trash_bin_id');
    }
}
