<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortenedUrl extends Model
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::retrieved(function ($shortenedUrl) {
            $shortenedUrl->redirects()->create();
        });
    }

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
    public function redirects()
    {
        return $this->hasMany(ShortenedUrlRedirect::class);
    }

    public function getShortenedUrl()
    {
        return url()->to($this->code);
    }
}
