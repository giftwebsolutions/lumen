<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, HasFactory, CanResetPassword;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID
     * if $incrementing == false.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'api_token', 'pass',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'pass',
    ];

    /**
     * Indicates if the model should be timestamped.
     * Set false for disable Eloquent created_at, updated_at timestamps
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'name' => '',
        'role' => 'user',
        'active' => 1
    ];

    /**
     * If user role in array
     *
     * @return bool true|false
     */
    public function hasRole(array $role)
    {
        if(in_array($this->role, $role)) {
            return true;
        }

        return false;
    }

    /**
     * Create  unique token min. 32 characters
     *
     * @return string Token
     */
    static public function uniqueToken() {
        $size = env('AUTH_TOKEN_LENGTH', 32);
        if($size <= 16) { $size = 16; }
		return bin2hex(random_bytes($size));
    }
}
