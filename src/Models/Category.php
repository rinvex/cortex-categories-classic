<?php

declare(strict_types=1);

namespace Cortex\Categories\Models;

use Spatie\Activitylog\LogOptions;
use Rinvex\Support\Traits\Macroable;
use Cortex\Foundation\Traits\Auditable;
use Rinvex\Support\Traits\HashidsTrait;
use Rinvex\Support\Traits\HasTimezones;
use Spatie\Activitylog\Traits\LogsActivity;
use Cortex\Categories\Events\CategoryCreated;
use Cortex\Categories\Events\CategoryDeleted;
use Cortex\Categories\Events\CategoryUpdated;
use Cortex\Categories\Events\CategoryRestored;
use Rinvex\Categories\Models\Category as BaseCategory;

/**
 * Cortex\Categories\Models\Category.
 *
 * @property int                 $id
 * @property string              $slug
 * @property array               $name
 * @property array               $description
 * @property int                 $_lft
 * @property int                 $_rgt
 * @property int                 $parent_id
 * @property string              $style
 * @property string              $icon
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cortex\Foundation\Models\Log[] $activity
 * @property-read \Kalnoy\Nestedset\Collection|\Cortex\Categories\Models\Category[]        $children
 * @property-read \Cortex\Categories\Models\Category|null                                  $parent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categories\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends BaseCategory
{
    use Auditable;
    use Macroable;
    use HashidsTrait;
    use HasTimezones;
    use LogsActivity;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CategoryCreated::class,
        'updated' => CategoryUpdated::class,
        'deleted' => CategoryDeleted::class,
        'restored' => CategoryRestored::class,
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->mergeFillable(['style', 'icon']);

        $this->mergeCasts(['style' => 'string', 'icon' => 'string']);

        $this->mergeRules(['style' => 'nullable|string|strip_tags|max:150', 'icon' => 'nullable|string|strip_tags|max:150']);

        parent::__construct($attributes);
    }

    /**
     * Set sensible Activity Log Options.
     *
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                         ->logFillable()
                         ->logOnlyDirty()
                         ->dontSubmitEmptyLogs();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
