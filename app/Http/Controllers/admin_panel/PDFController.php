<?php

namespace App\Http\Controllers\admin_panel;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function previewPDF($asset_slug){
        $assets = Asset::slug($asset_slug)->with('OptionalUrls')->WhereTriageValid()->first();
        $inScopeUrls = json_decode($assets->OptionalUrls->inScope_Url);
        $reports = $assets->infos;
        foreach ($reports as $report)
        $data = parseInfo($report);
        $users = User::where('id', '!=', '1')->get(['name']);

        return view('admin_panel.pages.pdf_blades.preview_pdf', compact('assets', 'reports', 'data', 'inScopeUrls', 'users'));
    }

    public function downloadPDF($asset_slug){
        $assets = Asset::slug($asset_slug)->with('OptionalUrls')->WhereTriageValid()->first();
        $inScopeUrls = json_decode($assets->OptionalUrls->inScope_Url);
        $reports = $assets->infos;
        foreach ($reports as $report)
        $data = parseInfo($report);
        $filename = $assets->company_name;
        $users = User::where('id', '!=', '1')->get(['name']);
        $pdf = PDF::loadView('admin_panel.pages.pdf_blades.download_pdf', compact('data'), ['assets' => $assets, 'reports' => $reports, 'inScopeUrls' => $inScopeUrls, 'users' => $users]);
        $pdf->setPaper('A4');
        $pdf->setOptions([
            'margin-top' => 15,
            'footer-right' => 'Page [page]',
            'footer-center' => 'Pentester Space',
        ]);

        return $pdf->stream($filename . ' - Final Report' . '.pdf');
    }
}
