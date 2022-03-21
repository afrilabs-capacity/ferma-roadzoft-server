<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Photo extends Model
{
    use HasFactory;
    protected $fillable =[
        'photo',
        'user_id',
    ];

    public function setPhotoAttribute($value)
    {
        $this->attributes['photo'] = $this->base64ToTimestamps($value);
    }

    public function base64ToTimestamps($base64){
        if($base64==null){
            return null;
        }
        $image = $base64;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(8). '.png';
        Storage::disk('avatar')->put($imageName,base64_decode($image));
       return  $imageName;

    }
}
