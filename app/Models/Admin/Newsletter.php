<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Newsletter extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'email',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Check user news letter info
     *
     * @return void
     */
    public function checkUserNewsInfo()
    {
        if (Auth::check()) {
            return $this->where('user_id', Auth::user()->id)->exists();
        }

        return false;
    }

    /**
     * Get user news letter info at trashed
     *
     * @return void
     */
    public function getUserNewsInfoAtTrashed()
    {
        return $this->onlyTrashed()->where('user_id', Auth::user()->id)->get();
    }
}
