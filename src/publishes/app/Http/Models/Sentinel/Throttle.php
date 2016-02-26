<?php
/**
 *  Extension of Cartalyst Sentinel model
 */
namespace App\Models\Sentinel;;

use Cartalyst\Sentinel\Throttling\EloquentThrottle;

class Throttle extends EloquentThrottle
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'throttle';
    
    /**
     * {@inheritDoc}
     */    
    public function __construct() 
    {        
        $this->table = strval(config('cartalyst.sentinel.prefix')) . $this->table;

        parent::__construct();
    }    
}