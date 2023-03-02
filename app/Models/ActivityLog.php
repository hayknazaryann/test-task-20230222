<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
    protected $table = "activity_log";

    public function getOldValueAttribute()
    {
        $changes = $this->changes();
        return isset($changes['old']) ? json_encode($changes['old']) : '';
    }

    public function getNewValueAttribute()
    {
        $changes = $this->changes();
        return isset($changes['attributes']) ? json_encode($changes['attributes']) : '';
    }
}
