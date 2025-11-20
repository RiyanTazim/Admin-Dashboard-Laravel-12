<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getLogoAttribute($value): string | null
    {
        if (request()->is('api/*') && ! empty($value)) {
            return url($value);
        }
        return $value;
    }

    public function getFaviconAttribute($value): string | null
    {
        if (request()->is('api/*') && ! empty($value)) {
            return url($value);
        }
        return $value;
    }
}
