<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Complaint;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ComplaintList extends Component
{
    private function getDataForDataTable()
    {
        // Fetch all complaints from the database
        $complaints = Complaint::select(['id', 'title', 'report_category', 'created_at'])
            ->whereNull('accepted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        // DataTable configuration
        $config = [];

        // Transform the data into the required format
        $formattedData = $complaints->map(function ($complaint) {
            // Define action buttons
            // Using Bootstrap button classes for styling
            $btnDetails = '<a href="' . route('complaint.show', $complaint) . '">
                    <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Lihat">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button>
                </a>';

            // Combine buttons into a single string with <nobr> to prevent wrapping
            $actionButtons = '<nobr>' . $btnDetails . '</nobr>';

            // Return the array for a single row
            return [
                $complaint->id,
                $complaint->title,
                $complaint->report_category,
                $complaint->created_at->format('d M Y H:i'),
                $actionButtons,
            ];
        });

        $config['data'] = $formattedData;
        $config['order'] = [[3, 'desc']]; // Default order by created_at descending

        return $config;
    }

    // public function delete($id)
    // {
    //     try {
    //         DB::transaction(function () use ($id) {
    //             // Find the complaint by ID
    //             $complaint = Complaint::findOrFail($id);
    //             // Soft delete the complaint
    //             $complaint->canceled_at = now();
    //             $complaint->save();
    //             $complaint->delete();
    //         });

    //         // Optionally, you can add a flash message or emit an event to notify the user
    //         session()->flash('success', 'Data Laporan Berhasil Dihapus');

    //         redirect()->route('complaint.list');
    //     } catch (Exception $ex) {
    //         session()->flash('error', 'Data Laporan Gagal Dihapus');

    //         redirect()->route('complaint.list');
    //     }
    // }


    public function render()
    {
        $data = $this->getDataForDataTable();
        return view('livewire.pages.admin.complaint-list', compact('data'));
    }
}
