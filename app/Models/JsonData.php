<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class JsonData extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'json_data';
    protected $fillable = [
        'user_id', 'code', 'data'
    ];
    protected $casts = [
        'user_id' => 'integer',
        'code' => 'string',
        'data' => 'array',
    ];

    protected static $logFillable = true;
    protected static $logName = 'json_data';

    public function getLogNameToUse()
    {
        return 'json_data';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['data']);
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = auth()->id();
        $activity->causer_type = config('auth.providers')['users']['model'];
    }
}
