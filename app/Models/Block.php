<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }
}
