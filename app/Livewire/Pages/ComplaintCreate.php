<?php

namespace App\Livewire\Pages;

use App\Livewire\Forms\ComplaintForm;
use App\Models\Agency;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.guest')]
class ComplaintCreate extends Component
{
    use WithFileUploads;

    // The entire form logic is now encapsulated in this Form Object.
    public ComplaintForm $form;

    /**
     * Handle the form submission by calling the store method on the Form Object.
     */
    public function save()
    {
        try {
            // The validation and database logic is handled inside the Form Object.
            $this->form->store();

            // Dispatch a success event to the browser
            $this->dispatch('show-toast', [
                'type' => 'success',
                'message' => 'Laporan Anda telah berhasil dikirim. Terima kasih!'
            ]);
        } catch (ValidationException $ex) {
            throw $ex; // Rethrow the validation exception to show validation errors in the UI
        } catch (Exception $ex) {
            // If an error occurs, dispatch an error event
            $this->dispatch('show-toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengirim laporan. Silakan coba lagi.'
            ]);

            // Optional: Log the actual error for debugging purposes
            // \Log::error('Complaint submission error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $agencies = Agency::select(['id', 'name'])->get();
        return view('livewire.pages.complaint-create', compact('agencies'));
    }
}
