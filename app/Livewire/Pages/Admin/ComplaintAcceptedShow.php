<?php

namespace App\Livewire\Pages\Admin;

use App\Livewire\Forms\CancelComplaintForm;
use App\Livewire\Forms\CompleteComplaintForm;
use App\Models\AcceptComplaint;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class ComplaintAcceptedShow extends Component
{
    use WithFileUploads;

    public AcceptComplaint $accepted_complaint;

    public CompleteComplaintForm $form;

    public CancelComplaintForm $cancel_form;

    public function mount(AcceptComplaint $accepted_complaint)
    {
        $this->accepted_complaint = $accepted_complaint
            ->select([
                'id',
                'complaint_id',
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
        $zipFilePath = download_attachment(complaint: $this->accepted_complaint->complaint);

        // 4. Return the zip file as a download and delete it after sending
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function completed()
    {
        try {
            DB::transaction(function () {
                $this->form->store(accepted_complaint: $this->accepted_complaint);
            });
            
            session()->flash('success', 'Pengaduan Telah Selesai Diproses');

            $this->redirectRoute('accepted.list');
        } catch (ValidationException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            $this->close_complete_modal();
            session()->flash('error', 'Data Gagal Diproses');
        }
    }

    public function canceled()
    {
        try {

            DB::transaction(function () {
                $cancel = $this->cancel_form->store(complaint: $this->accepted_complaint->complaint);

                $this->accepted_complaint->complaint->accepted_at = null;;

                $this->accepted_complaint->delete(); // soft delete
                $this->accepted_complaint->complaint->delte(); // soft delete
            });

            session()->flash('success', 'Data Berhasil Dibatalkan');

            $this->redirectRoute('accepted.list');
        } catch (ValidationException $ex) {
            throw $ex;
        }  catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
    }

    /**
     * Dispatch a browser event to open the Bootstrap modal.
     */
    public function open_complete_modal()
    {
        $this->dispatch('open_complete_modal');
    }

    /**
     * Dispatch a browser event to close the Bootstrap modal and reset form fields.
     */
    public function close_complete_modal()
    {
        $this->form->reset();
        $this->form->resetErrorBag();
        $this->dispatch('close_complete_modal');
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
        return view('livewire.pages.admin.complaint-accepted-show');
    }
}
