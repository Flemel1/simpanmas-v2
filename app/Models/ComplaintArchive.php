<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintArchive extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'name',
        'identity_photo',
        'description',
        'report_category',
        'phone_number',
        'attachment',
        'agency_id',
        'is_archived',
        'is_canceled'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_archived' => 'boolean',
        'is_canceled' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // This static function is called when the model is booted.
        // We are listening for the "deleting" event.
        static::deleting(function (ComplaintArchive $archive) {
            // Before the archive is deleted, this code will run.

            // We check if a related user exists to avoid errors.
            if ($archive->complaint) {
                // Delete the related user.
                // This will trigger any events on the User model as well.
                $archive->complaint->delete();
            }
        });
    }

    public function complaint(): HasOne
    {
        return $this->hasOne(Complaint::class, 'complaint_id', 'id');
    }
}
