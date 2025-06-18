<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Schedule;
use App\Models\Notification;
use App\Models\TrashBin;
use App\Models\CollectionRun;
use App\Models\DropOffLocation;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    const ROLES = ['admin', 'collector', 'resident'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    // public function getAuthIdentifierName() {
    //     return 'username';
    // }

    public function schedules() {
        return $this->hasMany(Schedule::class, 'user_id');
    }

    public function notifications() {
        return $this->has(Notification::class, 'user_id');
    }

    public function trashBins() {
        return $this->hasMany(TrashBin::class, 'resident_id');
    }

    public function collectionRuns() {
        return $this->hasMany(CollectionRun::class, 'collector_id');
    }

    public function dropOffLocations() {
        return $this->hasMany(DropOffLocation::class, 'created_by');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
