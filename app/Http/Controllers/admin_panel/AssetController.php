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
    public function store(AssetFormValidation $request, Asset $assets, AppUrl $AppUrls, OptionalUrl $optionalUrls)
    {
        $assets->program_status = 1;
        $assets->company_name = ucfirst($request->input('companyName'));

        // Company Logo Upload
        if ($request->hasFile('companyLogo')){
            //Get original file from input request
            $file = $request->file('companyLogo');
            //Get file name with extension
            $fileWithExt = $file->getClientOriginalName();
            //Get file name only
            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
            //Get Extension only
            $ext = $request->file('companyLogo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = strtoupper($filename . '-' . md5(time())) . '.' . $ext;
            $location = 'public/admin_panel/img/';
            //Save file
            $file->storeAs($location, $fileNameToStore);
        } else {
            //Default Image
            $companyName = $assets->company_name;
            $getCompanyFirstLetter = substr($companyName, 0, 1);
            $ext = 'png';
            $fileNameToStore = strtoupper($companyName . '-' . md5(time())) . '.' . $ext;
            $img = GenerateAlphaAvatar($getCompanyFirstLetter);

            $img->save(storage_path() . '/app/public/admin_panel/img/' . $fileNameToStore, '90');
        }
        $assets->company_logo = $fileNameToStore;

        // Slug
        $assets->asset_slug = SlugService::createSlug(Asset::class, 'asset_slug', $request->input('companyName'));

        $assets->url = $request->input('url');
        $assets->start_date = $request->input('startDate');
        $assets->end_date = $request->input('endDate');
        $assets->save();

        $AppUrls->ios = $request->input('ios');
        $AppUrls->android = $request->input('android');
        $AppUrls->asset_id = $assets->id;
        $AppUrls->save();

        $optionalUrls->inScope_Url = $request->input('inScopeUrl');
        $optionalUrls->outScope_Url = $request->input('inScopeUrl');
        $optionalUrls->asset_id = $assets->id;
        $optionalUrls->save();

        return redirect()->back();
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
        return response()->json(['message' => 'Program status updated successfully.']);
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
        $reports->triage_status = $request->triage_status;

        $reports->update();
        return \response()->json(['message' => 'Report status updated successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $assets = Asset::find($id);
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

        return redirect()->back()->with('success', 'Report deleted successfully');
    }
}
