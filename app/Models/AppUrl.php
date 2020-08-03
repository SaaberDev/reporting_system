<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AppUrl
 *
 * @property int $id
 * @property int $asset_id
 * @property string $ios
 * @property string $android
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Asset $assets
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl whereAndroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl whereIos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppUrl whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AppUrl extends Model
{
    public function assets(){
        return $this->belongsTo(Asset::class);
    }
}
