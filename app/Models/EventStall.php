<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStall extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'event_stall';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'stall_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Define the data type of the primary key
    protected $keyType = 'int';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'stall_id',
        'event_id',
        'time_slot_id',
        'price',
        'category',
        'stall_type',
        'stall_count',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'stall_owner_id',
        'status',
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'price' => 'decimal:2',
        'date_from' => 'date',
        'date_to' => 'date',
        'time_from' => 'datetime:H:i',
        'time_to' => 'datetime:H:i',
        'created_date' => 'datetime',
        'modified_date' => 'datetime',
    ];

    // Define the attributes that should be hidden for arrays
    protected $hidden = [
        'created_date',
        'modified_date',
    ];

    // Define relationships with other models, if any
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function timeSlot()
    {
        return $this->belongsTo(EventTimeSlot::class, 'time_slot_id');
    }

    public function stallOwner()
    {
        return $this->belongsTo(User::class, 'stall_owner_id');
    }
}
