<?php

namespace App\Models;

use App\Models\User;
use App\Models\Source;
use App\Models\Keyword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'text', 'highlight_keys', 'highlight_source'];

    /**
     * The "booted" method of the model.
     *s
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('by_user', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }

    public function sources()
    {
        return $this->hasMany(Source::class);
    }
}
