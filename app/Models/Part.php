<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'theoretical_weight', 'real_weight', 
        'status', 'block_id', 'registration_date', 'registered_by'
    ];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function project()
    {
        return $this->hasOneThrough(
            Project::class,
            Block::class,
            'id',       // Foreign key on blocks table
            'id',       // Foreign key on projects table
            'block_id', // Local key on parts table
            'project_id' // Local key on blocks table
        );
    }

}
