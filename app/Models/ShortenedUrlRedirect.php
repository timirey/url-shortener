<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortenedUrlRedirect extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shortened_url_redirects';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['shortened_url_id'];

    /**
     * Get the shortened url it belongs to.
     */
    public function getUrl()
    {
        return $this->belongsTo(ShortenedUrl::class);
    }
}
