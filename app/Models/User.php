<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'fname',
        'lname',
        'phone',
        'address',
        'occupation',
        'nrc',
        'nrc_no',
        'dob',
        'gender',
        'loan_status',
        'basic_pay',
        'profile_photo_path',
        'net_pay',
        'id_type',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'borrowed_total'
        // 'create_token'
    ];

    public function getCreateTokenAttribute()
    {
        $token = $this->tokens()->create([
            'name' => $this->fname.'btf_token'.$this->email,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => ['*'],
        ]);
        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }


    public function getBorrowedTotalAttribute()
    {
        $loans = Application::where('user_id', $this->id)
            ->where('complete', 1)
            ->where('status', 1)->sum('amount');
        return $loans ?? 0;
    }

    public static function totalCustomerBorrowed($user){
        $loans = Application::where('user_id', $user->id)
        ->where('complete', 1)
        ->where('status', 1)->sum('amount');
        return $loans ?? 0;
    }

    public static function totalBorrowers(){
        return User::role('user')->count();
    }

    public static function totalIncompleteKYCBorrowers(){
        return Application::where('complete', 1)->count();
    }

    /**
     * > The posts() function returns all the posts that belong to the user
     *
     * @return A collection of Post objects.
     */
    public function nextkin(){
        return $this->hasMany(NextOfKing::class);
    }
    public function loanpackages(){
        return $this->hasMany(LoanPackage::class);
    }
    public function WithdrawRequest(){
        return $this->hasMany(WithdrawRequest::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function loan_scores()
    {
        return $this->hasMany(LoanScore::class);
    }

    public function blacklist(){
        return $this->hasOne(BlackList::class);
    }

    public function wallet(){
        return $this->hasMany(Wallet::class);
    }

    public function loans(){
        return $this->hasMany(Application::class);
    }

    public function active_loans(){
        return $this->hasOne(Application::class)->where('status', 1)->where('complete', 1);
    }

    public function next_of_king(){
        return $this->hasMany(NextOfKing::class);
    }
}
