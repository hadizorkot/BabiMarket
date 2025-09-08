<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_line_id', 'rating_value', 'comment'];

    // UserReview belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // UserReview belongs to OrderLine
    public function orderLine()
    {
        return $this->belongsTo(OrderLine::class);
    }
}
