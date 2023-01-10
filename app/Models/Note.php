<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
    ];

    protected $appends = [
        'body_format'
    ];

    public function getBodyFormatAttribute()
    {
        $body = $this->body;

        if (strlen($this->body) > 150) {
            $body = substr($this->body, 0, 150) . '...';
        }

        return $body;
    }
}
