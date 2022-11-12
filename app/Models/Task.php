<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'next_iteration',
        'phase',
        'board_id',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public $timestamps = false;
}
