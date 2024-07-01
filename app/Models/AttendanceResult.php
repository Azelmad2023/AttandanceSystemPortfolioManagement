<?php

namespace App\Models;

use App\Models\Datareceiverattandances;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendance_id',
        'attendance_state', // Corrected column name
        'justification',
        'justification_type', // Added missing column
        'justification_document', // Added missing column
    ];

    // Define the relationship with the teacher attendance
    public function teacherAttendance()
    {
        return $this->belongsTo(Datareceiverattandances::class, 'attendance_id');
    }
}
