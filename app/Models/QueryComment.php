<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class QueryComment extends Model
{
    use HasFactory;

    protected $fillable=['report_id','report_uuid','uuid','user_id','type','comment','created_at'];


    protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}
}
