<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appartment extends Model
{
    use HasFactory;

    public function placements(): BelongsToMany
    {
        return $this->belongsToMany(Placement::class);
    }
    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(Photo::class);
    }
    public function comforts(): BelongsToMany
    {
        return $this->belongsToMany(Comfort::class);
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
