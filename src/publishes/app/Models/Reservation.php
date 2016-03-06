<?php

namespace App\Models;

use App\Models\Model;

class Reservation extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'reservations';
    
    protected static $statuses = [
        0 => 'error',
        1 => 'new',
        2 => 'confirmed',
        3 => 'rejected',
        4 => 'settled',
    ];
    
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'user_id',
        'no_people',
        'place',
        'starts_at',
        'description',
        'confirmed_at',
        'confirmed_no_people',
        'rejected_at',
        'rejected_because',
        'settled_at'
    ];
    
    /**
     * {@inheritDoc}
     */
    public $timestamps = [
        'starts_at',
        'confirmed_at',
        'rejected_at',
        'settled_at'
    ];
    
    /*********************************************
     *  RELATIONS
     *********************************************/
    #public function user()
    #{
    #    return $this->belongsTo(\App\Models\Sentinel\User);
    #}
    
    /*********************************************
     *  ADDITIONAL ATTRIBUTES
     *********************************************/
    public function getStatusAttribute()
    {
        if ($this->settled_at) {
            
            return $this->statuses[4];
        }
        if ($this->rejected_at) {
            
            return $this->statuses[3];
        }
        if ($this->confirmed_at) {
            
            return $this->statuses[2];
        }
        if ( ! $this->settled_at and ! $this->rejected_at and ! $this->confirmed_at) {
            
            return $this->statuses[1];
        }
        
        return $this->statuses[0];
    }
    
    /*********************************************
     *  SCOPES
     *********************************************/
    
    /**
     * Filter result to status: NEW
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeNew($query)
    {
        $query->whereNull('confirmed_at')
              ->whereNull('rejected_at')
              ->whereNull('settled_at');
    }
    
    /**
     * Filter result to status: CONFIRMED
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeConfirmed($query)
    {
        $query->whereNotNull('confirmed_at')
              ->whereNull('settled_at');
    } 
    
    /**
     * Filter result to status: REJECTED
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeRejected($query)
    {
        $query->whereNotNull('rejected_at');
    } 
    
    /**
     * Filter result to status: SETTLED
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeSettled($query)
    {
        $query->whereNotNull('settled_at');
    }     
}