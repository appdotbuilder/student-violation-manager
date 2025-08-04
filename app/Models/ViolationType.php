<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ViolationType
 *
 * @property int $id
 * @property int $violation_category_id
 * @property string $name
 * @property string|null $description
 * @property int $points
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ViolationCategory $violationCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Violation> $violations
 * @property-read int|null $violations_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType whereViolationCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationType active()
 * @method static \Database\Factories\ViolationTypeFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ViolationType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'violation_category_id',
        'name',
        'description',
        'points',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'violation_category_id' => 'integer',
        'points' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the violation category that owns this type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function violationCategory(): BelongsTo
    {
        return $this->belongsTo(ViolationCategory::class);
    }

    /**
     * Get the violations for this type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function violations(): HasMany
    {
        return $this->hasMany(Violation::class);
    }

    /**
     * Scope a query to only include active types.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}