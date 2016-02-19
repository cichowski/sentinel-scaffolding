<?php

/**
 *  Extension of Cartalyst Sentinel model
 */

namespace App\Models\Sentinel;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'users';
    
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];  

    /**
     * Array of login column names.
     *
     * @var array
     */
    protected $loginNames = ['email', 'username'];    
    
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
    public function __construct() 
    {        
        $this->table = strval(config('cartalyst.sentinel.prefix')) . $this->table;

        parent::__construct();
    }
}