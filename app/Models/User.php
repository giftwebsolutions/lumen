<?php
namespace App\Models;

use \stdClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;
    
    public $name = 'DummyBoy';
    public $email = 'dummy@example.com';
    public $role = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'token'
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
        $user = collect(DB::select('select * from user where token = :t', ['t' => $token]))->first();
        
        if(!empty($user)) {        
            // Validate user token here in database or session
            if($user->id > 0) {            
                // User
                $o = new User();
                // Add
                $o->name = $user->name;
                $o->email = $user->email;
                $o->role = $user->role;
                $o->token = $user->token;    
                
                // return user
                return $o;                
            }            
        }
        
        // Error send null
        return null;
    }
}
