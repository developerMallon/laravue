<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    protected $fillable = [
        'label', 'is_complete',
    ];

    public function todo()
    {
        return $this->belongsTo(\App\Todo::class);
    }
}
