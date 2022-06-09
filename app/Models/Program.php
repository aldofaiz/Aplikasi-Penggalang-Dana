<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function setStatusWithdrawSubmission()
    {
        $this->attributes['program_withdraw_status'] = 'submission';
        self::save();
    }
    public function setStatusWithdrawApproved()
    {
        $this->attributes['program_withdraw_status'] = 'approved';
        self::save();
    }
    public function setStatusWithdrawFinished()
    {
        $this->attributes['program_withdraw_status'] = 'finished';
        self::save();
    }
}
