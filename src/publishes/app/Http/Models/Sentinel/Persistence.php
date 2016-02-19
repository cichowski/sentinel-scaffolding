<?php

/**
 *  Extension of Cartalyst Sentinel model
 */

namespace App\Models\Sentinel;

use Cartalyst\Sentinel\Persistences\EloquentPersistence;

class Persistence extends EloquentPersistence
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'persistences' . '_support';
    
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