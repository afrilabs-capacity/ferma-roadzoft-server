<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'message',
        'photo_1',
        'photo_2',
        'photo_3',
        'photo_4',
        'cordinate',
        'longitude',
        'latitude',
        'status',
        'posted',
        'project_id',
        'user_id',
        'geo_zone',
        'rsc',
        'sos',
        'nfsos',
        'nwos',
        'now',
        'rating',
        'npw',
        'gtw',
        'eqw',
        'wgatm',
        'envsor',
        'review',
        'stateroad'
    ];

    protected $casts = [
        'sos' => 'boolean',
        'gtw' => 'boolean',
        'eqw' => 'boolean',
    ];


    protected $dates = ['deleted_at'];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setPhoto1Attribute($value)
    {
        $this->attributes['photo_1'] = $this->base64ToTimestamps($value);
    }

    public function setPhoto2Attribute($value)
    {
        $this->attributes['photo_2'] = $this->base64ToTimestamps($value);
    }

    public function setPhoto3Attribute($value)
    {
        $this->attributes['photo_3'] = $this->base64ToTimestamps($value);
    }

    public function setPhoto4Attribute($value)
    {
        $this->attributes['photo_4'] = $this->base64ToTimestamps($value);
    }

    private function base64ToTimestamps($base64)
    {
        if ($base64 == null) {
            return null;
        }
        $image = $base64;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(8) . '.png';
        Storage::disk('uploads')->put($imageName, base64_decode($image));
        return  $imageName;
    }
}
