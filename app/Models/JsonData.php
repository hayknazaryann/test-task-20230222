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
        'user_id', 'uuid', 'data'
    ];
    protected $appends = ['title', 'type'];
    protected $casts = [
        'user_id' => 'integer',
        'uuid' => 'string',
        'data' => 'object',
    ];

    protected static $logFillable = true;
    protected static $logName = 'json_data';

    public function getTitleAttribute()
    {
        return $this->data && property_exists($this->data, 'title') ? $this->data->title : '';
    }

    public function getTypeAttribute()
    {
        return $this->data && property_exists($this->data, 'type') ? $this->data->type : '';
    }

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
