<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReactionType extends Model
{
    protected $fillalbe = [
        'name',
        'icon',
    ];

    public function sites()
    {
        return $this->belongsToMany(Site::class, 'site_reaction_type');
    }
}
