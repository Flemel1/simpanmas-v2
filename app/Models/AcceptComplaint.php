<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcceptComplaint extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'complaint_id',
        'description',
        'attachment',
        'doned_at'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // This static function is called when the model is booted.
        // We are listening for the "deleting" event.
        static::deleting(function (AcceptComplaint $accepted_complaint) {
            // Before the accepted_complaint is deleted, this code will run.

            // We check if a related user exists to avoid errors.
            if ($accepted_complaint->complaint) {
                // Delete the related user.
                // This will trigger any events on the User model as well.
                $accepted_complaint->complaint->delete();
            }
        });
    }
}
