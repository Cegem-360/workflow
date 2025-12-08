<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workflow extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'description',
        'is_active',
        'metadata',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'metadata' => 'array',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function nodes(): HasMany
    {
        return $this->hasMany(WorkflowNode::class);
    }

    public function connections(): HasMany
    {
        return $this->hasMany(WorkflowConnection::class);
    }
}
