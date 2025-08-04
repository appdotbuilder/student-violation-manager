<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ViolationCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ViolationType> $violationTypes
 * @property-read int|null $violation_types_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Violation> $violations
 * @property-read int|null $violations_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ViolationCategory active()
 * @method static \Database\Factories\ViolationCategoryFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ViolationCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the violation types for this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function violationTypes(): HasMany
    {
        return $this->hasMany(ViolationType::class);
    }

    /**
     * Get the violations for this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function violations(): HasMany
    {
        return $this->hasMany(Violation::class);
    }

    /**
     * Scope a query to only include active categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}