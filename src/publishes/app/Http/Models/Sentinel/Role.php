<?php

/**
 *  Extension of Cartalyst Sentinel model
 */

namespace App\Models\Sentinel;

use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'roles';
    
    /**
     * {@inheritDoc}
     */
    protected static $usersModel = 'App\Models\Sentinel\EloquentUser'; 
    
    /**
     * {@inheritDoc}
     */    
    public function __construct() 
    {        
        $this->table = strval(config('cartalyst.sentinel.prefix')) . $this->table;

        parent::__construct();
    }    
}