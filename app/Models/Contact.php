<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
   

      public $fillable = ['name', 'email', 'subject', 'message'];

    //      public static function boot() {
  
    //     parent::boot();
  
    //     static::created(function ($item) {
                
    //         $adminEmail = "info@leleventures.com";
    //         Mail::to($adminEmail)->send(new ContactMail($item));
    //     });
    // }
}
