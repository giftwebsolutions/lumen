<?php
namespace App\Models;

use \stdClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, HasFactory, CanResetPassword;

    public $id = 0;
    public $name = 'DummyBoy';
    public $email = 'dummy@example.com';
    public $role = 'user';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'api_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
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
     * If user authenticated
     *
     * @return mixed User object or null
     */
    static public function auth($token)
    {
        // Default
        $user = null;

        // Check user token
        $user = collect(DB::select('select * from user where api_token = :t', ['t' => $token]))->first();

        if(!empty($user)) {
            // Validate user token here in database or session
            if($user->id > 0) {
                // User
                $o = new User();
                // Add
                $o->id = $user->id;
                $o->name = $user->name;
                $o->email = $user->email;
                $o->role = $user->role;
                $o->token = $user->api_token;

                // return user
                return $o;
            }
        }

        // Error send null
        return null;
    }

    /**
     * Update user token
     *
     * @return mixed User object or null
     */
    static public function attempt($email, $pass)
    {
        // Default
        $user = null;

        // Check user token
        $user = collect(DB::select('select * from user where email = :e', ['e' => $email]))->first();
        if($user->pass == md5($pass)) {
            $new_token = bin2hex(random_bytes(32));
            $ok = collect(DB::update('update user SET api_token = :t where email = :e', ['e' => $email, 't' => $new_token]))->first();
            if($ok > 0) {
                return $new_token;
            }
        }

        // Error send null
        return null;
    }
}
