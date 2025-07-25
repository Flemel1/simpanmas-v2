<?php

namespace App\Livewire\Forms;

use App\Models\Complaint;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CancelComplaintForm extends Form
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
                'mimes' => "Harus berupa jpg/jpeg/png/pdf/docx",
                'max' => "Ukuran maksimal 10MB"
            ],
        ];
    }

    public function store(Complaint $complaint)
    {
        $this->validate();
        // Store the uploaded file  
        if ($this->attachment) {
            $attachment_path = $this->attachment->store(path: 'attachments/canceled_complaints', options: 'local');

            $complaint->update([
                'canceled_at' => now()
            ]);
            
            $complaint->cancel_complaint()->create([
                'description' => $this->description,
                'attachment' => $attachment_path
            ]);
        } else {
            $complaint->update([
                'canceled_at' => now()
            ]);
            
            $complaint->cancel_complaint()->create([
                'description' => $this->description
            ]);
        }
    }
}
