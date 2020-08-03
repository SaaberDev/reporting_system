<?php

namespace App\Http\Controllers\admin_panel;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use PDF;

class PDFController extends Controller
{
    public function previewPDF($asset_slug){
        $assets = Asset::slug($asset_slug)->WhereTriageValid()->first();
        $reports = $assets->infos;
        foreach ($reports as $report)
        $data = parseInfo($report);

        return view('admin_panel.pages.pdf_blades.preview_pdf', compact('assets', 'reports', 'data'));
    }

    public function downloadPDF($asset_slug){
        $assets = Asset::slug($asset_slug)->WhereTriageValid()->first();
        $reports = $assets->infos;
        foreach ($reports as $report)
        $data = parseInfo($report);
        $filename = $assets->company_name;
        $pdf = PDF::loadView('admin_panel.pages.pdf_blades.download_pdf', compact('data'), ['assets' => $assets, 'reports' => $reports]);
        $pdf->setPaper('A4');
        $pdf->setOptions([
            'margin-top' => 15,
            'footer-right' => 'Page [page]',
            'footer-center' => 'Pentester Space',
        ]);

        return $pdf->stream($filename . ' - Final Report' . '.pdf');
    }
}
