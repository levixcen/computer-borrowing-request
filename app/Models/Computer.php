<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Computer extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'hostname',
        'ip_address',
    ];

    /**
     * Local scope for get available computer on current schedule.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Carbon\CarbonImmutable $start_datetime
     * @param \Carbon\CarbonImmutable $end_datetime
     * @param \App\Models\Room|null $room
     * @param \App\Models\Computer|null $computer
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query, $start_datetime, $end_datetime, $room = null, $computer = null)
    {
        if (! empty($room)) {
            $query->where('room_id', $room->id);
        }

        if (! empty($computer)) {
            $query->where('id', $computer->id);
        }

        return $query->whereDoesntHave('schedules', function (Builder $query) use ($start_datetime, $end_datetime) {
            $query->where([
                ['start_datetime', '<', $end_datetime],
                ['end_datetime', '>', $start_datetime],
            ]);
        });
    }

    /**
     * Relationship to Room model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Relationship to Schedule model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
