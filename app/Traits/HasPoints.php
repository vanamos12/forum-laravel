<?php

namespace App\Traits;

use App\Models\Point;

trait HasPoints{
    public function awards($amount = null){
        return $this->morphMany(Point::class, 'pointable')
                    ->orderBy('created_at', 'desc')
                    ->take($amount);
    }

    public function countAwards(){
        return $this->awards()->count();
    }

    public function currentPoints(){
        return (new Point())->getCurrentPoints($this);
    }

    public function addPoints($amount, $message){
        return (new Point())->addAwards($this, $amount, $message);
    }

    public function rank(){
        $currentPoints = $this->currentPoints();

        if ($currentPoints <= 100){
            return 'Recruit';
        }

        if ($currentPoints <= 500){
            return 'Corporal';
        }
        if ($currentPoints <= 1000){
            return 'Sergent';
        }
        if ($currentPoints <= 4000){
            return 'First Sergent';
        }
        if ($currentPoints <= 10000){
            return 'Master Sergent';
        }

    }
}