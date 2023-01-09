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
        'titulo',
        'cuerpo',
    ];

    protected $appends = [
        'cuerpo_format'
    ];

    public static function getNotes() {
        return Note::simplePaginate(6);
    }

    public function getCuerpoFormatAttribute()
    {
        $cuerpo = $this->cuerpo;

        if (strlen($this->cuerpo) > 150) {
            $cuerpo = substr($this->cuerpo, 0, 150) . '...';
        }

        return $cuerpo;
    }
}
