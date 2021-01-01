<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'amount', 'total', 'approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
