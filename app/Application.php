<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{   
    const STATUS_NEW = 1;
    const STATUS_REJECTED = 2;
    const STATUS_RESOLVED = 3;
    
    protected $fillable = [
        'name', 'description', 'problem_img', 'user_id', 'category_id'
    ];

    public function status() {
        return $this->belongsTo('App\Status');
    }

    public function isResolved() {
        return $this->status_id == self::STATUS_RESOLVED;
    }

    public function isRejected() {
        return $this->status_id == self::STATUS_REJECTED;
    }

    public function isNew() {
        return $this->status_id == self::STATUS_NEW;
    }


    public function scopeResolved($query) {
        return $query->where('status_id', self::STATUS_RESOLVED);
    }

    public function scopeNew($query) {
        return $query->where('status_id', self::STATUS_NEW);
    }

    public function scopeRejected($query) {
        return $query->where('status_id', self::STATUS_REJECTED);
    }
}
