<?php

namespace App\Livewire\Forms;

use App\Models\Agency;
use Livewire\Form;
use App\Models\Complaint;
use Illuminate\Validation\Rule;

class ComplaintForm extends Form
{
    public $report_category = 'pengaduan';

    public $name;

    public $title = '';

    public $description = '';

    public $incident_date = '';

    public $destination_agency = '';

    public $new_destination_agency = null;

    public $phone_number = '';

    public $attachment;

    public $identity_photo;


    protected function rules(): array
    {
        $agencies = Agency::select(['id'])->get();
        $agencies->transform(function (Agency $value, int $key) {
            return $value->id;
        });
        $agencies = $agencies->toArray();
        $agencies[] = 'Lainnya';

        return [
            'report_category' => [
                'required',
                'string',
                Rule::in(['pengaduan', 'aspirasi', 'permintaan informasi']),
            ],
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'title' => [
                'required',
                'string',
                'min:5',
                'max:200'
            ],
            'description' => [
                'required',
                'string',
                'min:10'
            ],
            'incident_date' => [
                'required',
                'date',
                'before_or_equal:today'
            ],
            'destination_agency' => [
                'required',
                'string',
                Rule::in($agencies)
            ],
            'phone_number' => [
                'required',
                'string',
                'min:10',
                'max:12',
                'regex:/^08/'
            ],
            'attachment' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf,docx,doc',
                'max:11000'
            ],
            'identity_photo' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png',
                'max:11000'
            ],
            'new_destination_agency' => [
                'required_if:destination_agency,Lainnya',
                'max:100'
            ]
        ];
    }

    protected function messages(): array
    {

        return [
            'title' => [
                'required' => "Judul harus diisi",
                'min' => 'Judul minimal 5 huruf',
                'max' => "Judul maksimal 200 huruf"
            ],
            'report_category' => [
                'required' => 'Kategori harus diisi',
                'in' => 'Kategori harus salah dari pengaduan, aspirasi, permintaan informasi',
            ],
            'name' => [
                'required' => "Nama harus diisi",
                'max' => 'Nama maksimal 100 huruf'
            ],
            'description' => [
                'required' => "Deskripsi laporan harus diisi",
                'min' => 'Deskripsi laporan minimal 10 huruf'
            ],
            'incident_date' => [
                'required' => 'Tanggal harus diisi',
                'date' => "Harus berupa tanggal",
                'before_or_equal' => "Tidak boleh lebih dari tanggal sekarang"
            ],
            'destination_agency' => [
                'required' => 'Dinas harus diisi',
                'in' => 'Pilih dinas yang terkait'
            ],
            'phone_number' => [
                'required' => "Nomor HP harus diisi",
                'min' => 'Nomor HP minimal 10 angka',
                'max' => 'Nomor HP maksimal 12 angka',
                'regex' => 'Nomor HP harus diawal 08'
            ],
            'attachment' => [
                'file' => 'Harus berupa file',
                'mimes' => "Harus berupa jpg/jpeg/png/pdf/docx/doc",
                'max' => "Ukuran maksimal 10MB"
            ],
            'identity_photo' => [
                'required' => "Foto KTP harus diisi",
                'file' => 'Harus berupa file',
                'mimes' => "Harus berupa jpg/jpeg/png",
                'max' => "Ukuran maksimal 10MB"
            ],
            'new_destination_agency' => [
                'required_if' => "Nama Instansi Tujuan harus diisi",
                'max' => 'Nama Instansi Tujuan Maksimal 100 karakter',
            ],
        ];
    }

    /**
     * Store the new complaint in the database.
     */
    public function store()
    {
        // Validate the form data
        $this->validate();

        // Store identity photo (KTP)
        $identity_photo_path = $this->identity_photo->store(path: 'identities', options: 'public');

        // Store the uploaded file
        if ($this->attachment) {
            $attachment_path = $this->attachment->store(path: 'attachments', options: 'public');

            Complaint::create([
                'name' => $this->name,
                'title' => $this->title,
                'description' => $this->description,
                'agency_id' => $this->destination_agency === 'Lainnya' ? null : $this->destination_agency,
                'phone_number' => $this->phone_number,
                'identity_photo' => $identity_photo_path,
                'report_category' => $this->report_category,
                'attachment' => $attachment_path,
                'new_agency' => $this->new_destination_agency
            ]);
        } else {
            Complaint::create([
                'name' => $this->name,
                'title' => $this->title,
                'description' => $this->description,
                'agency_id' => $this->destination_agency === 'Lainnya' ? null : $this->destination_agency,
                'phone_number' => $this->phone_number,
                'identity_photo' => $identity_photo_path,
                'report_category' => $this->report_category,
                'new_agency' => $this->new_destination_agency
            ]);
        }

        // Reset the form fields after successful submission
        $this->reset();
    }
}
