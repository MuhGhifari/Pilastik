<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DropOffLog;
use App\Models\User;

class DropOffLocation extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    const STATUS = ["active", "closed"];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'location_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'status',
        'description',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the drop-off logs associated with the location.
     */
    public function dropOffLogs()
    {
        return $this->hasMany(DropOffLog::class, 'location_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
