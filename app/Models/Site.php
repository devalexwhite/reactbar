<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'url',
        'active',
        'slug',
        'admin_slug',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function reactions()
    {
        return $this->hasMany(SiteReaction::class);
    }

    public function reactionTypes()
    {
        return $this->belongsToMany(ReactionType::class, 'site_reaction_type');
    }

    public function getReactionCounts()
    {
        return $this->reactions()
            ->selectRaw('reaction_type_id, COUNT(*) as count')
            ->groupBy('reaction_type_id')
            ->get()
            ->pluck('count', 'reaction_type_id');
    }
}
