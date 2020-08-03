<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Info
 *
 * @package App\Models
 * @property int $id
 * @property int $asset_id
 * @property int $triage_status
 * @property string $report_slug
 * @property string|null $reporter_name
 * @property string $assetURL
 * @property string|null $weakness
 * @property string|null $otherWeakness
 * @property string|null $severity
 * @property string|null $severity_calc
 * @property string $bug_name
 * @property string $desc
 * @property string $impact
 * @property string $steps_of_reproduce
 * @property string $exploitation
 * @property string $fixation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Asset $assets
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info report($arg)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info slug($report_slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereAssetURL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereBugName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereExploitation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereFixation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereImpact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereOtherWeakness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereReportSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereReporterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereSeverity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereSeverityCalc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereStepsOfReproduce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereTriageStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info whereWeakness($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Info orderByTriage($arg)
 */


class Info extends Model
{
    use Sluggable;

    /**
     * Mass Assignments
     */

    /**
     * @var string[]
     */
    protected $fillable = ['bug_name', 'report_slug'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'report_slug' => [
                'source' => 'bug_name'
            ]
        ];
    }

    /**
     * Model Relationship
     */

    /**
     * @return BelongsTo
     */
    public function assets(){
        return $this->belongsTo(Asset::class);
    }

    /**
     * Local Query Scopes
     */

    /**
     * @param $query
     * @param $arg
     * @return mixed
     */
    public function scopeSlug($query, $arg){
        return $query->where('report_slug', $arg);
    }

    /**
     * @param $query
     * @param $arg
     * @return mixed
     */
    public function scopeOrderByTriage($query, $arg){
        return $query->where('asset_id', $arg)->orderBy('triage_status', 'desc');
    }
}
