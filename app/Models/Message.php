<?php

namespace App\Models;
use Ramsey\Uuid\Uuid;
use DateTimeInterface;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'uuid',
        'body',
    ];

    public function setuuidAttribute($value)
    {
        $this->attributes['uuid'] = Uuid::uuid4();
    }
    
        protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}

    
}
