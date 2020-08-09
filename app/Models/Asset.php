<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * Class Asset
 *
 * @package App\Models
 * @property int $id
 * @property string $company_name
 * @property string|null $company_logo
 * @property string $asset_slug
 * @property string $start_date
 * @property string $end_date
 * @property string $url
 * @property int $program_status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read AppUrl|null $AppUrls
 * @property-read OptionalUrl|null $OptionalUrls
 * @property-read Collection|Info[] $infos
 * @property-read int|null $infos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset slug($arg)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset validInfo()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereAssetSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereCompanyLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereProgramStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereUrl($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereInfoISValid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Asset whereTriageValid()
 */
class Asset extends Model
{
    use Sluggable;

    //protected $fillable = ['companyName', 'asset_slug'];
    protected $guarded = [];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'asset_slug' => [
                'source' => 'companyName',
            ],
            /*'report_slug' => [
                'source' => 'companyName'
            ]*/
        ];
    }

    /**
     * @return HasMany
     */
    public function infos(){
        return $this->hasMany(Info::class);
    }

    /**
     * @return HasOne
     */
    public function OptionalUrls(){
        return $this->hasOne(OptionalUrl::class, 'asset_id');
    }

    /**
     * @return HasOne
     */
    public function AppUrls(){
        return $this->hasOne(AppUrl::class, 'asset_id');
    }


    /**
     * Local Query Scopes
     */

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWhereInfoISValid($query){
        return $query->withCount(['infos', 'infos as valid_infos' => function(Builder $query){
            $query->where('triage_status', '=', 1);
        }]);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWhereTriageValid($query){
        return $query->with(['infos' => function($query){
            $query->where('triage_status', 1);
        }]);
    }

    /**
     * @param $query
     * @param $arg
     * @return mixed
     */
    public function scopeSlug($query, $arg){
        return $query->where('asset_slug', $arg);
    }

}
