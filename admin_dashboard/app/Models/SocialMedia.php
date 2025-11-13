<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'image',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    //for api image with url retrieve
    public function getImageAttribute($value): string | null
    {
        if (request()->is('api/*') && ! empty($value)) {
            return url($value);
        }
        return $value;
    }
}
