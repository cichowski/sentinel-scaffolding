<?php
/**
 *  Extension of Cartalyst Sentinel model
 */
namespace App\Models\Sentinel;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends EloquentUser
{
    use SoftDeletes;
    
    /**
     * {@inheritDoc}
     */
    protected $table = 'users';
    
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'last_name',
        'first_name',
        'permissions',
    ];  

    /**
     * Array of login column names.
     *
     * @var array
     */
    protected $loginNames = ['email'];    
    
    /**
     * The Eloquent roles model name.
     *
     * @var string
     */
    protected static $rolesModel = 'App\Models\Sentinel\EloquentRole';

    /**
     * The Eloquent persistences model name.
     *
     * @var string
     */
    protected static $persistencesModel = 'App\Models\Sentinel\EloquentPersistence';

    /**
     * The Eloquent activations model name.
     *
     * @var string
     */
    protected static $activationsModel = 'App\Models\Sentinel\EloquentActivation';

    /**
     * The Eloquent reminders model name.
     *
     * @var string
     */
    protected static $remindersModel = 'App\Models\Sentinel\EloquentReminder';

    /**
     * The Eloquent throttling model name.
     *
     * @var string
     */
    protected static $throttlingModel = 'App\Models\Sentinel\EloquentThrottle';   
    
    
    /**
     * {@inheritDoc}
     */    
    public function __construct(array $attributes = []) 
    {        
        $this->table = strval(config('cartalyst.sentinel.prefix')) . $this->table;

        parent::__construct($attributes);
    }
    
    /**
     * {@inheritDoc}
     */ 
    public function roles()
    {
        $pivotTable = strval(config('cartalyst.sentinel.prefix')) . 'role_users';
        
        return $this->belongsToMany(static::$rolesModel, $pivotTable, 'user_id', 'role_id')->withTimestamps();
    }     
}