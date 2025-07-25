<?php

namespace App\Livewire\Pages\Admin;

use App\Models\ComplaintArchive;
use Livewire\Component;

class ComplaintArchiveList extends Component
{
    private function getDataForDataTable()
    {
        // Fetch all complaints from the database
        $archives = ComplaintArchive::select(['id', 'title', 'report_category'])
            ->orderBy('created_at', 'desc')
            ->get();

        // DataTable configuration
        $config = [];

        // Transform the data into the required format
        $formattedData = $archives->map(function ($archive) {
            // Define action buttons
            // Using Bootstrap button classes for styling
            $btnDetails = '<a href="' . route('complaint.show', $archive) . '">
                    <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Lihat">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button>
                </a>';

            // Combine buttons into a single string with <nobr> to prevent wrapping
            $actionButtons = '<nobr>' . $btnDetails . '</nobr>';

            // Return the array for a single row
            return [
                $archive->id,
                $archive->title,
                $archive->report_category,
                $actionButtons,
            ];
        });

        $config['data'] = $formattedData;

        return $config;
    }

    public function render()
    {
        $data = $this->getDataForDataTable();
        return view('livewire.pages.admin.complaint-archive-list', compact('data'));
    }
}
