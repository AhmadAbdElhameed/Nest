<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\EmailVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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
        'phone',
        'verification_token',
        'verification_token_till'
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
        'password' => 'hashed',
    ];

    public function sendEmailVerificationNotification(){
        if(config('verification.mode') == 'email') {
            $url = URL::temporarySignedRoute(
                'verification.verify', now()->addMinutes(30), [
                    'id' => $this->getKey(),
                    'hash' => sha1($this->getEmailForVerification())
                ]
            );

            $this->notify(new EmailVerification($url));
        }

        if(config('verification.mode') == 'cvt') {
            $this->generateVerificationToken();
            $url = route('verification.verify',[
                'id' => $this->getKey(),
                'token' => $this->verification_token,
            ]);
            $this->notify(new EmailVerification($url));
        }

    }


    public function generateVerificationToken(){
        if(config('verification.mode') == 'cvt'){
            $this->verification_token = Str::random(60);
            $this->verification_token_till = now()->addMinutes(30);
            $this->save();
        }
    }
    public function verifyUsingVerificationToken(){
        if(config('verification.mode') == 'cvt'){
            $this->email_verified_at = now();
            $this->verification_token = null;
            $this->verification_token_till = null;
            $this->save();
        }
    }

    public function generateOTP(){
        if(config('verification.mode') == 'otp'){
            $this->otp = rand(111111,999999);
            $this->otp_till = now()->addMinutes(1);
            $this->save();
        }
    }
    public function resetOTP(){
        if(config('verification.mode') == 'otp'){
            $this->otp = null;
            $this->otp_till = null;
            $this->save();
        }
    }

}
