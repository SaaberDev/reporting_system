<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OptionalUrl
 *
 * @property int $id
 * @property int $asset_id
 * @property string $inScope_Url
 * @property string $outScope_Url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Asset $assets
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl whereInScopeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl whereOutScopeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionalUrl whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OptionalUrl extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function assets(){
        return $this->belongsTo(Asset::class);
    }
}
