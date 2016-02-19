<?php

/**
 *  Extension of Cartalyst Sentinel model
 */

namespace App\Models\Sentinel;

use Cartalyst\Sentinel\Activations\EloquentActivation;
use Cartalyst\Sentinel\Users\UserInterface;
use Activation as ActivationFacade;

class Activation extends EloquentActivation
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'activations';    
    
    /**
     * Create a new activation record or returns existing one
     * if a valid activation for the given user exists.
     *
     * @param  \Cartalyst\Sentinel\Users\UserInterface  $user
     * @return \Cartalyst\Sentinel\Activations\ActivationInterface
     */    
    public static function createIfNotExists(UserInterface $user)
    {        
        $activation = ActivationFacade::exists($user);                
        
        return $activation ? $activation : ActivationFacade::create($user);
    }
    
    /**
     * {@inheritDoc}
     */    
    public function __construct() 
    {        
        $this->table = strval(config('cartalyst.sentinel.prefix')) . $this->table;

        parent::__construct();
    }    
}