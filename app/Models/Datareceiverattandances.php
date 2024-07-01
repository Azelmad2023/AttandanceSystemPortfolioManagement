<?php

namespace App\Models;

use App\Models\AttendanceResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Datareceiverattandances extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_id',
        'start_date',
        'end_date',
        'day_date',
        'day_of_week',
        'teacher_name',
        'class_time_from',
        'class_time_to',
        'class_group',
    ];

    public function attendanceResults()
    {
        return $this->hasMany(AttendanceResult::class, 'attendance_id');
    }
}
