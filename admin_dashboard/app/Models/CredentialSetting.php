<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredentialSetting extends Model
{
    use HasFactory;

    public $fillable = [
        'stripe_key',
        'stripe_secret',
    ];
}
