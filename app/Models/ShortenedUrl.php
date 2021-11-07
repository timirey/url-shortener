<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortenedUrl extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shortened_urls';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['code', 'url'];

    /**
     * Get all redirects regarding this shortened url object
     */
    public function getRedirects()
    {
        return $this->hasMany(ShortenedUrlRedirect::class);
    }
}
