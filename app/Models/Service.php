<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_title',
        'service_description',
        'service_price',
        'length_of_service_minutes',
        'max_participants',
        'exclusions',
        'user_id',
    ];

    /**
     * Get the user that owns the service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}