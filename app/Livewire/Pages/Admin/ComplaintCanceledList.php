<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Complaint;
use Livewire\Component;

class ComplaintCanceledList extends Component
{
    private function getDataForDataTable()
    {
        // Fetch all complaints from the database
        $complaints = Complaint::select(['id', 'title', 'report_category', 'created_at'])
            ->withTrashed()
            ->whereNotNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        // DataTable configuration
        $config = [];

        // Transform the data into the required format
        $formattedData = $complaints->map(function ($complaint) {
            // Define action buttons
            // Using Bootstrap button classes for styling
            // $btnDetails = '<a href="' . route('complaint.show', $complaint) . '">
            //         <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Lihat">
            //             <i class="fa fa-lg fa-fw fa-eye"></i>
            //         </button>
            //     </a>';

            // $btnDeletes = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Hapus" wire:click="delete(\'' . $complaint->id . '\')">
            //             <i class="fas fa fa-lg fa-fw fa-trash"></i>
            //         </button>';

            // Combine buttons into a single string with <nobr> to prevent wrapping
            // $actionButtons = '<nobr>' . $btnDetails . $btnDeletes . '</nobr>';

            // Return the array for a single row
            return [
                $complaint->id,
                $complaint->title,
                $complaint->report_category,
                $complaint->created_at->format('d M Y H:i'),
                // $actionButtons,
            ];
        });

        $config['data'] = $formattedData;
        $config['order'] = [[3, 'desc']]; // Default order by created_at descending

        return $config;
    }
    
    public function render()
    {
        $data = $this->getDataForDataTable();
        return view('livewire.pages.admin.complaint-canceled-list', compact('data'));
    }
}
