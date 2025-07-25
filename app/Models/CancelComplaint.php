<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancelComplaint extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'complaint_id',
        'description',
        'attachment'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
