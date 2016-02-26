<?php
/**
 *  Extension of Cartalyst Sentinel model
 */
namespace App\Models\Sentinel;

use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends EloquentRole
{
    use SoftDeletes;

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
    
    /**
     * {@inheritDoc}
     */ 
    public function users()
    {
        $pivotTable = strval(config('cartalyst.sentinel.prefix')) . 'role_users';
        
        return $this->belongsToMany(static::$usersModel, $pivotTable, 'role_id', 'user_id')->withTimestamps();
    }        
}