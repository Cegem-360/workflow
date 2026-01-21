<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Settings extends Model
{
    protected $fillable = [
        'team_id',
        'default_schedule_cron',
        'notifications_enabled',
        'notification_email',
        'auto_activate_workflows',
        'execution_timeout',
    ];

    protected function casts(): array
    {
        return [
            'notifications_enabled' => 'boolean',
            'auto_activate_workflows' => 'boolean',
            'execution_timeout' => 'integer',
        ];
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
