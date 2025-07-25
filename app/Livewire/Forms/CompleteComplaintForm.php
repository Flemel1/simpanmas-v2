<?php

namespace App\Livewire\Forms;

use App\Models\AcceptComplaint;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CompleteComplaintForm extends Form
{
    public $attachment;

    public string $description = '';

    protected function rules(): array
    {
        return [
            'description' => [
                'required',
                'string',
                'min:10'
            ],
            'attachment' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf,docx',
                'max:11000'
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'description' => [
                'required' => "Deskripsi laporan harus diisi",
                'min' => 'Deskripsi laporan minimal 10 huruf'
            ],
            'attachment' => [
                'file' => 'Harus berupa file',
                'mimes' => "Harus berupa jpg/jpeg/png/pdf",
                'max' => "Ukuran maksimal 10MB"
            ],
        ];
    }

    public function store(AcceptComplaint $accepted_complaint)
    {
        $this->validate();
        // Store the uploaded file  
        if ($this->attachment) {
            $attachment_path = $this->attachment->store(path: 'attachments/completed_complaints', options: 'local');

            $accepted_complaint->update([
                'description' => $this->description,
                'attachment' => $attachment_path,
                'doned_at' => now()
            ]);
        } else {
            $accepted_complaint->update([
                'description' => $this->description,
                'doned_at' => now()
            ]);
        }
    }
}
