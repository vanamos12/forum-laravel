<?php

namespace App\Exceptions;

use Exception;

class CannotLikeItem extends Exception{
    public static function alreadyLiked(string $item){
        return new self("The {$item} cannot be liked multiple times");
    }
}