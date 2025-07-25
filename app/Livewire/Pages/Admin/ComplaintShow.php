<?php

namespace App\Livewire\Pages\Admin;

use App\Livewire\Forms\CancelComplaintForm;
use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use ZipArchive;

class ComplaintShow extends Component
{
    use WithFileUploads;

    public Complaint $complaint;

    public CancelComplaintForm $form;

    public function mount(Complaint $complaint)
    {
        $this->complaint = $complaint
            ->select([
                'id',
                'name',
                'title',
                'description',
                'agency_id',
                'report_category',
                'phone_number',
                'identity_photo',
                'new_agency',
                'attachment',
                'accepted_at',
                'archived_at',
                'canceled_at'
            ])->with('agency')->findOrFail($complaint->id);
    }

    public function download_attachment()
    {
        $complaint = Complaint::with('agency')->findOrFail($this->complaint->id);
        $zipFilePath = download_attachment($complaint);

        // 4. Return the zip file as a download and delete it after sending
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function accepted()
    {
        try {
            DB::transaction(function () {
                $this->complaint->accept_complaint()->create();
                $this->complaint->accepted_at = now();
                $this->complaint->save();
            });

            session()->flash('success', 'Data Berhasil Diterima');

            $this->redirectRoute('complaint.list');
        } catch (Exception $ex) {
            session()->flash('error', 'Data Gagal Diproses');
        }
    }

    public function canceled()
    {
        try {

            DB::transaction(function () {
                $cancel = $this->form->store(complaint: $this->complaint);

                $this->complaint->canceled_at = now();
                $this->complaint->save();
                $this->complaint->delete(); // Soft delete the complaint
            });

            session()->flash('success', 'Data Berhasil Dibatalkan');

            $this->redirectRoute('complaint.list');
        } catch (ValidationException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            $this->close_cancel_modal();
            session()->flash('error', 'Data Gagal Dibatalkan');
        }
    }

    /**
     * Dispatch a browser event to open the Bootstrap modal.
     */
    public function open_cancel_modal()
    {
        $this->dispatch('open_cancel_modal');
    }

    /**
     * Dispatch a browser event to close the Bootstrap modal and reset form fields.
     */
    public function close_cancel_modal()
    {
        $this->form->reset();
        $this->form->resetErrorBag();
        $this->dispatch('close_cancel_modal');
    }

    public function render()
    {
        return view('livewire.pages.admin.complaint-show');
    }
}
