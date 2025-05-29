<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrashBin extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'last_collected_at',
        'next_collection_due',
    ];

    /**
     * Get the resident that owns the trash bin.
     */
    public function resident()
    {
        return $this->belongsTo(User::class, foreignKey: 'resident_id');
    }
}
