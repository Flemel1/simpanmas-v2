<?php

namespace App\Livewire\Pages\Admin;

use App\Models\AcceptComplaint;
use Livewire\Component;

class ComplaintCompletedShow extends Component
{
    public AcceptComplaint $accepted_complaint;

    public function mount(AcceptComplaint $accepted_complaint)
    {
        $this->accepted_complaint = $accepted_complaint
            ->select([
                'id',
                'complaint_id',
                'description',
                'attachment',
                'doned_at'
            ])
            ->with(['complaint' => function ($query) {
                $query->select([
                    'id',
                    'name',
                    'title',
                    'description',
                    'agency_id',
                    'report_category',
                    'phone_number',
                    'identity_photo',
                    'attachment',
                    'accepted_at',
                    'archived_at',
                    'canceled_at'
                ])->with('agency');
            }])
            ->findOrFail($accepted_complaint->id);
    }

    public function download_attachment()
    {
        $zipFilePath = download_attachment(complaint: $this->accepted_complaint->complaint, is_completed: true);

        // 4. Return the zip file as a download and delete it after sending
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.pages.admin.complaint-completed-show');
    }
}
