<?php

namespace App\Http\Controllers\admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetFormValidation;
use App\Models\AppUrl;
use App\Models\Asset;
use App\Models\Info;
use App\Models\OptionalUrl;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $assets = Asset::whereInfoISValid()->orderBy('created_at', 'desc')->get();
        return view('admin_panel.pages.assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin_panel.pages.assets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AssetFormValidation $request
     * @param Asset $assets
     * @param AppUrl $AppUrls
     * @param OptionalUrl $optionalUrls
     * @return RedirectResponse
     */
    public function store(AssetFormValidation $request)
    {
        $notification = [
            'message' => 'You need to login with your credentials!',
            'alert-type' => 'success',
        ];
        $assets = Asset::Create([
            'company_name' => ucfirst($request->input('companyName')),
            'company_logo' => imageUpload_handler($request),
            'asset_slug' => SlugService::createSlug(Asset::class, 'asset_slug', $request->input('companyName')),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
            'url' => $request->input('url'),
            'program_status' => 1
        ]);
        AppUrl::Create([
            'asset_id' => $assets->id,
            'ios' => $request->input('ios'),
            'android' => $request->input('android'),
        ]);
        OptionalUrl::Create([
            'asset_id' => $assets->id,
            'inScope_Url' => $request->input('inScopeUrl'),
            'outScope_Url' => $request->input('outScopeUrl'),
        ]);

        return redirect()->back()->with($notification);
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
        $reports = Info::orderByTriage($assets->id)->get();

        return view('admin_panel.pages.assets.show', compact('assets', 'reports'));
    }

    /**
     * @param Request $request
     * @param $asset_slug
     * @return JsonResponse
     */
    public function updateStatus(Request $request, $asset_slug){
        $assets = Asset::slug($asset_slug)->first();
        $assets->program_status = $request->program_status;

        $assets->update();
        return response()->json(['message' => 'Program status updated successfully!']);
    }

    /**
     * @param $report_slug
     * @return Application|Factory|View
     */
    public function showReport($report_slug){
        $reports = Info::slug($report_slug)->first();
        $data = parseInfo($reports);

        return \view('admin_panel.pages.bugs.index', compact('reports', 'data'));
    }

    /**
     * @param Request $request
     * @param $report_slug
     * @return JsonResponse
     */
    public function updateValidStatus(Request $request, $report_slug){
        $reports = Info::slug($report_slug)->first();
        $reports->triage_status = $request->__get('triage_status');

        $reports->update();
        return \response()->json(['message' => 'Report status updated successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $assets = Asset::with(['OptionalUrls', 'AppUrls'])->findOrFail($id);
        $OptionalUrls = [
            'inScope' => $assets['OptionalUrls']->inScope_Url,
            'outScope' => $assets['OptionalUrls']->outScope_Url,
        ];
        $AppUrls = [
            'ios' => $assets['AppUrls']->ios,
            'android' => $assets['AppUrls']->android,
        ];

        return \view('admin_panel.pages.assets.edit', compact('assets', 'OptionalUrls', 'AppUrls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AssetFormValidation $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(AssetFormValidation $request, $id)
    {
        $assets = Asset::with('AppUrls', 'OptionalUrls')->findOrFail($id);
        $assets->update([
            'company_name' => ucfirst($request->input('companyName')),
            'company_logo' => imageUpdate_handler($assets, $request),
            'asset_slug' => SlugService::createSlug(Asset::class, 'asset_slug', $request->input('companyName')),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
            'url' => $request->input('url'),
        ]);
        $assets['AppUrls']->update([
            'ios' => $request->input('ios'),
            'android' => $request->input('android'),
        ]);
        $assets['OptionalUrls']->update([
            'inScope_Url' => $request->input('inScopeUrl'),
            'outScope_Url' => $request->input('outScopeUrl'),
        ]);

        return redirect()->route('admin.index', compact('assets'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy_asset($id)
    {
        $assets = Asset::findOrFail($id);
        $assets->delete();
        if (\File::exists(storage_path() . '/app/public/admin_panel/img/' . $assets->company_logo)){
            \File::delete(storage_path() . '/app/public/admin_panel/img/' . $assets->company_logo);
        }

        return redirect()->route('admin.index')->with('success', 'Post deleted successfully');
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy_report($id){
        $reports = Info::find($id);
        $reports->delete();

        return redirect()->back()->with('success_toast', 'Report deleted successfully');
    }
}
