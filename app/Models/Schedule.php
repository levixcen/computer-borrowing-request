<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'start_datetime',
        'end_datetime',
        'username',
        'password',
    ];

    /**
     * Relationship to BorrowingRequest model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrowingRequest()
    {
        return $this->belongsTo(BorrowingRequest::class);
    }

    /**
     * Relationship to User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
     * Relationship to Computer model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
