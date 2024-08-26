<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name','title','person_in_charge','sponsor','file_path','detail', 'status', 'location', 'image', 'start_time', 'end_time', 'start_date', 'end_date',];
}
