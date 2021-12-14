<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsStatus extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'message_sid', 'to_number', 'from_number', 'error_code'];
}
