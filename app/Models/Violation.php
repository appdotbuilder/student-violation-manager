<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Violation
 *
 * @property int $id
 * @property int $student_id
 * @property int $violation_category_id
 * @property int $violation_type_id
 * @property int $recorded_by
 * @property \Illuminate\Support\Carbon $violation_date
 * @property int $points
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $recordedBy
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\ViolationCategory $violationCategory
 * @property-read \App\Models\ViolationType $violationType
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Violation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Violation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Violation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereRecordedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereViolationCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereViolationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Violation whereViolationTypeId($value)
 * @method static \Database\Factories\ViolationFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Violation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'violation_category_id',
        'violation_type_id',
        'recorded_by',
        'violation_date',
        'points',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'student_id' => 'integer',
        'violation_category_id' => 'integer',
        'violation_type_id' => 'integer',
        'recorded_by' => 'integer',
        'violation_date' => 'date',
        'points' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the student that owns this violation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the violation category that owns this violation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function violationCategory(): BelongsTo
    {
        return $this->belongsTo(ViolationCategory::class);
    }

    /**
     * Get the violation type that owns this violation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function violationType(): BelongsTo
    {
        return $this->belongsTo(ViolationType::class);
    }

    /**
     * Get the user who recorded this violation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}