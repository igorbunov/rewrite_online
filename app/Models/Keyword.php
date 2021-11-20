<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keyword extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'needed', 'applied'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
