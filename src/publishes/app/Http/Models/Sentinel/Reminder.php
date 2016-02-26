<?php
/**
 *  Extension of Cartalyst Sentinel model
 */
namespace App\Models\Sentinel;

use Cartalyst\Sentinel\Reminders\EloquentReminder;
use Cartalyst\Sentinel\Users\UserInterface;
use Reminder as ReminderFacade;

class Reminder extends EloquentReminder
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'reminders';
    
    /**
     * Create a new reminder record or returns existing one
     * if a valid reminder for the given user exists.
     *
     * @param  \Cartalyst\Sentinel\Users\UserInterface  $user
     * @return \Cartalyst\Sentinel\Reminders\ReminderRepositoryInterface
     */      
    public static function createIfNotExists(UserInterface $user)
    {        
        $reminder = ReminderFacade::exists($user);                
        
        return $reminder ? $reminder : ReminderFacade::create($user);
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