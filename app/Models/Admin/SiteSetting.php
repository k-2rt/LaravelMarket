<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_setting';

    protected $fillable = [
        'phone_one',
        'phone_two',
        'email',
        'company_name',
        'company_address',
        'facebook',
        'youtube',
        'instagram',
        'twitter',
    ];
}
