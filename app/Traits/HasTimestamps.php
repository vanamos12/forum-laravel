<?php 


namespace App\Traits;

use Carbon\Carbon;

trait HasTimestamps
{
    public function diffForHumansCreatedAt():string{
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans();
    }
    
    public function createdAt(): String {
        return $this->created_at->format('d-m-Y');
    }

    public function updatedAt(): String {
        return $this->updated_at->format('d-m-Y');
    }
}