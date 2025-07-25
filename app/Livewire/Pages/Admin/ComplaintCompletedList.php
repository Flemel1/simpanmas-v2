<?php

namespace App\Livewire\Pages\Admin;

use App\Models\AcceptComplaint;
use Exception;
use Livewire\Component;

class ComplaintCompletedList extends Component
{
    private function getDataForDataTable()
    {
        // Fetch all complaints from the database
        $accepted_complaints = AcceptComplaint::with(['complaint:id,title,report_category,created_at'])
            ->whereNotNull('doned_at') // Only get complaints that are not completed
            ->orderBy('created_at', 'desc')
            ->get();

        // DataTable configuration
        $config = [];

        // Transform the data into the required format
        $formattedData = $accepted_complaints->map(function ($accepted_complaint) {
            // Define action buttons
            // Using Bootstrap button classes for styling
            $btnDetails = '<a href="' . route('completed.show', $accepted_complaint) . '">
                    <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Lihat">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button>
                </a>';

            // Combine buttons into a single string with <nobr> to prevent wrapping
            $actionButtons = '<nobr>' . $btnDetails . '</nobr>';

            // Return the array for a single row
            return [
                $accepted_complaint->complaint->id,
                $accepted_complaint->complaint->title,
                $accepted_complaint->complaint->report_category,
                $accepted_complaint->complaint->created_at->format('d M Y H:i'),
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
    //         // Find the complaint by ID
    //         $accepted_complaint = AcceptComplaint::findOrFail($id);
    //         // Soft delete the complaint
    //         $accepted_complaint->delete();

    //         // Optionally, you can add a flash message or emit an event to notify the user
    //         session()->flash('success', 'Data Laporan Berhasil Dihapus');

    //         redirect()->route('completed.list');
    //     } catch (Exception $ex) {
    //         session()->flash('error', 'Data Laporan Gagal Dihapus');

    //         redirect()->route('completed.list');
    //     }
    // }

    public function render()
    {
        $data = $this->getDataForDataTable();
        return view('livewire.pages.admin.complaint-completed-list', compact('data'));
    }
}
