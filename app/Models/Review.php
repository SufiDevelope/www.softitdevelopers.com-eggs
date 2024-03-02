<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'review_message',
        'image', // add this line
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
