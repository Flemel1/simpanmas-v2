<?php

use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

if (!function_exists('download_attachment')) {
    /**
     * Download attachment file of the complaint.
     *
     * @param Complaint $complaint
     * @param bool $is_completed if the complaint is completed
     * @return string
     */
    function download_attachment(Complaint $complaint, $is_completed = false) : string
    {
        // 1. Generate the PDF from the Blade view
        $pdf = Pdf::loadView('pdfs.complaint-detail', ['complaint' => $complaint]);
        $pdfContent = $pdf->output();
        $pdfFileName = 'complaint-detail-' . $complaint->id . '.pdf';

        // Store the PDF temporarily
        Storage::disk('local')->put($pdfFileName, $pdfContent);

        // 2. Prepare the zip file
        $zip = new ZipArchive;
        $agencyName = $complaint->agency ? $complaint->agency->name : $complaint->new_agency;
        $agencyName = str_replace(' ', '-', strtolower($agencyName));
        $zipFileName = '';

        if ($is_completed) {
            $zipFileName = 'LHP-' . $agencyName . '-' . $complaint->name . '.zip';
        } else {
            $zipFileName = 'laporan-' . $agencyName . '-' . $complaint->name . '.zip';
        }

        $zipFilePath = storage_path('app/' . $zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            // Add the generated PDF to the zip
            $zip->addFile(storage_path('app/' . $pdfFileName), $pdfFileName);

            // Add the original attachment to the zip if it exists
            if ($complaint->attachment && Storage::disk('public')->exists($complaint->attachment)) {
                $attachmentFullPath = storage_path('app/public/' . $complaint->attachment);
                $zip->addFile($attachmentFullPath, basename($complaint->attachment));
            }

            if ($complaint->accept_complaint->attachment && Storage::disk('local')->exists($complaint->accept_complaint->attachment)) {
                $attachmentFullPath = storage_path('app/' . $complaint->accept_complaint->attachment);
                $zip->addFile($attachmentFullPath, basename($complaint->accept_complaint->attachment));
            }

            $zip->close();
        }

        // 3. Clean up the temporary PDF file
        Storage::disk('local')->delete($pdfFileName);

        return $zipFilePath;
    }
}
