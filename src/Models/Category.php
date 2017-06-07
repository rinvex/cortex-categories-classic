<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Models;

use Rinvex\Categorizable\Category as BaseCategory;

/**
 * Cortex\Categorizable\Models\Category
 *
 * @property int                                                                       $id
 * @property string                                                                    $slug
 * @property array                                                                     $name
 * @property array                                                                     $description
 * @property int                                                                       $_lft
 * @property int                                                                       $_rgt
 * @property int                                                                       $parent_id
 * @property \Carbon\Carbon                                                            $created_at
 * @property \Carbon\Carbon                                                            $updated_at
 * @property string                                                                    $deleted_at
 * @property-read \Kalnoy\Nestedset\Collection|\Cortex\Categorizable\Models\Category[] $children
 * @property-read \Cortex\Categorizable\Models\Category                                $parent
 * @method static \Illuminate\Database\Query\Builder|\Rinvex\Categorizable\Category d()
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Cortex\Categorizable\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends BaseCategory
{
    //
}
