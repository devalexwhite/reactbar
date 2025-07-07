<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteReaction extends Model
{
    protected $fillable = [
        'site_id',
        'reaction_type_id',
        'ip_date_hash',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function reactionType()
    {
        return $this->belongsTo(ReactionType::class);
    }

    public static function hashUserIP($ip)
    {
        // Hash the user IP with the current day
        $date = now()->format('Y-m-d');
        return hash('sha256', $ip . $date);
    }
}
