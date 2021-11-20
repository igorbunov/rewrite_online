<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synonim extends Model
{
    use HasFactory;

    protected $primaryKey = ['name'];
    protected $fillable = ['name', 'synonims'];

    public $incrementing = false;
    public $timestamps = false;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }
}
