<?php
namespace App\Eloquent\Relations;

use App\Eloquent\Media;
use App\Eloquent\MedicalHistory;
use App\Eloquent\User;

trait MedicalHistoryRelation
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'medical_history_id');
    }
}
