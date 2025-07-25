<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
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
        'accepted_at',
        'canceled_at',
        'archived_at',
        'agency_id',
        'new_agency'
    ];

    public function cancel_complaint(): HasOne
    {
        return $this->hasOne(CancelComplaint::class);
    }

    public function accept_complaint(): HasOne
    {
        return $this->hasOne(AcceptComplaint::class);
    }

    public function agency(): HasOne
    {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }
}
