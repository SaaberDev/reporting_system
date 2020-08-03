<?php

namespace App\Http\Controllers\user_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportFormValidation;
use App\Models\Asset;
use App\Models\Info;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $assets = Asset::orderBy('created_at', 'desc')->where('program_status', 1)->get();
        return view('user_panel.pages.reporting_area.index', compact('assets'));
    }

    /**
     * Display the specified resource.
     *
     * @param $asset_slug
     * @return Application|Factory|View
     */
    public function show($asset_slug)
    {
        $assets = Asset::slug($asset_slug)->first();
        $app_urls = $assets->AppUrls()->where('asset_id', $assets->id)->first();
        return view('user_panel.pages.reporting_area.show', compact('assets', 'app_urls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $asset_slug
     * @return Application|Factory|View
     */

    public function create($asset_slug)
    {
        $assets = Asset::slug($asset_slug)->first();
        $inScopeUrls = json_decode($assets->OptionalUrls->inScope_Url);
        $weakness = Config::get('staticData.weaknessData.value');
        $vulnerabilityDefaultData = Config::get('staticData.vulnerabilityDefaultData');

        return view('user_panel.pages.reporting_area.create', compact('assets', 'inScopeUrls', 'weakness', 'vulnerabilityDefaultData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReportFormValidation $request
     * @param Info $info
     * @param $asset_slug
     * @return RedirectResponse
     */
    public function store(ReportFormValidation $request, Info $info, $asset_slug)
    {
        $asset = Asset::where('asset_slug', $asset_slug)->first();
        $info->asset_id = $asset->id;
        $info->triage_status = 1;
        $info->report_slug = SlugService::createSlug(Info::class, 'report_slug', $request->input('title'));

        $info->reporter_name = $request->input('reporterName');
        $info->assetURL = $request->input('asset');

        // Condition for one input field submission
        if ($request->filled('weakness')){
            $info->weakness = $request->input('weakness');
        } elseif ($request->filled('otherWeakness')){
            $info->otherWeakness = $request->input('otherWeakness');
        }

        // Condition for one input field submission
        if ($request->filled('cvssStatic')){
            $info->severity = $request->input('cvssStatic');
        } elseif ($request->filled('cvssOptional')){
            $info->severity_calc = $request->input('cvssOptional');
        }

        $info->bug_name = $request->input('title');
        $info->desc = $request->input('desc');
        $info->impact = $request->input('impact');
        $info->steps_of_reproduce = $request->input('reproduce');
        $info->exploitation = $request->input('exploitation');
        $info->fixation = $request->input('fixation');

        $info->save();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
