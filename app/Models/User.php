<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'joining_date',
        'manager_name',
        'manager_email',
        'two_days_interview_forms_status',
        'two_days_recruitment_forms_status',
        'checkin_form_member_status',
        'checkin_form_manager_status',
        'confirmation_initaition_email_member_status',
        'fresh_eye_journal_form_status',
        'confirmation_feedback_form_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company_name(){
        return $this->belongsTo(CompanyName::class,'company_id');
    }


    public function department_count(){
        return $this->belongsTo('App\Models\Department','department','id');
    }

}
