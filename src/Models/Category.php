<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Models;

use Kalnoy\Nestedset\NestedSet;
use Spatie\Activitylog\Traits\LogsActivity;
use Rinvex\Categorizable\Category as BaseCategory;

/**
 * Cortex\Categorizable\Models\Category.
 *
 * @property int                                                                       $id
 * @property string                                                                    $slug
 * @property array                                                                     $name
 * @property array                                                                     $description
 * @property int                                                                       $_lft
 * @property int                                                                       $_rgt
 * @property int|null                                                                  $parent_id
 * @property \Carbon\Carbon|null                                                       $created_at
 * @property \Carbon\Carbon|null                                                       $updated_at
 * @property \Carbon\Carbon|null                                                       $deleted_at
 * @property-read \Kalnoy\Nestedset\Collection|\Cortex\Categorizable\Models\Category[] $children
 * @property-read \Cortex\Categorizable\Models\Category|null                           $parent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Categorizable\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends BaseCategory
{
    use LogsActivity;

    /**
     * Indicates whether to log only dirty attributes or all.
     *
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are logged on change.
     *
     * @var array
     */
    protected static $logAttributes = [
        'slug',
        'name',
        'description',
        NestedSet::LFT,
        NestedSet::RGT,
        NestedSet::PARENT_ID,
    ];

    /**
     * The attributes that are ignored on change.
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
