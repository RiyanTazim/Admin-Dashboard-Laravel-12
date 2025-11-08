<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
        protected $fillable = [
        'system_title',
        'system_short_title',
        'logo',
        'minilogo',
        'favicon',
        'company_name',
        'tag_line',
        'phone_code',
        'phone_number',
        'whatsapp',
        'email',
        'time_zone',
        'language',
        'copyright_text',

        'admin_title',
        'admin_short_title',
        // 'googlemap',
        'admin_logo',
        'admin_mini_logo',
        'admin_favicon',
        'admin_copyright_text',
    ];

    // cast
    protected $casts = [
        'system_title'         => 'string',
        'system_short_title'   => 'string',
        'logo'                 => 'string',
        'minilogo'             => 'string',
        'favicon'              => 'string',
        'company_name'         => 'string',
        'tag_line'             => 'string',
        'phone_number'         => 'string',
        'whatsapp'             => 'string',
        'email'                => 'string',
        'time_zone'            => 'string',
        'language'             => 'string',
        'copyright_text'       => 'string',

        'admin_title'          => 'string',
        'admin_short_title'    => 'string',
        // 'googlemap'         => 'string',
        'admin_logo'           => 'string',
        'admin_mini_logo'      => 'string',
        'admin_favicon'        => 'string',
        'admin_copyright_text' => 'string',
        'phone_code'           => 'string',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getLogoAttribute($value): string | null
    {
        if (request()->is('api/*') && ! empty($value)) {
            return url($value);
        }
        return $value;
    }
    public function getMinilogoAttribute($value): string | null
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
