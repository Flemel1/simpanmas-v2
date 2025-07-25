<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public array $complaint_total_chart_data = [
        'labels' => [],
        'data' => [],
    ];

    public array $complaint_group_category_chart_data = [
        'labels' => [],
        'data' => [],
    ];

    /**
     * Mount the component and prepare the chart data.
     */
    public function mount()
    {
        $this->prepare_chart_data();
    }

    /**
     * Query the database and format the data for the chart.
     */
    public function prepare_chart_data()
    {
        // Get the current year
        $current_year = date('Y');

        // Fetch complaint counts grouped by month for the current year
        $complaints = Complaint::withTrashed()
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', $current_year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month'); // Key the collection by month for easy lookup

        $complaints_grouped_by_category = Complaint::withTrashed()
            ->select(
                'report_category',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', $current_year)
            ->groupBy('report_category', 'month')
            ->orderBy('count', 'desc')
            ->get();

        // Initialize an array for all 12 months with 0 counts
        $monthly_counts = array_fill(1, 12, 0);
        $complaint_group_category_monthly_counts = [
            [
                'category' => 'pengaduan',
                'counts' => array_fill(1, 12, 0)
            ],
            [
                'category' => 'aspirasi',
                'counts' => array_fill(1, 12, 0)
            ],
            [
                'category' => 'permintaan informasi',
                'counts' => array_fill(1, 12, 0)
            ],
        ];

        // Fill the array with actual counts from the database
        foreach ($complaints as $month => $data) {
            $monthly_counts[$month] = $data->count;
        }

        // Prepare the final data structure for the chart
        $this->complaint_total_chart_data = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'data' => array_values($monthly_counts),
        ];

        // Fill the array with actual counts from the database
        foreach ($complaints_grouped_by_category as $month => $data) {
            foreach ($complaint_group_category_monthly_counts as &$category_data) {
                if ($data->report_category === $category_data['category']) {
                    $category_data['counts'][$data->month] = $data->count;
                }
            }
        }

        foreach ($complaint_group_category_monthly_counts as &$category_data) {
            $category_data['counts'] = array_values($category_data['counts']);
        }

        $this->complaint_group_category_chart_data = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'data' => $complaint_group_category_monthly_counts,
        ];

        // Dispatch an event to the browser to render the chart
        $this->dispatch('chart_data_updated', $this->complaint_total_chart_data, $this->complaint_group_category_chart_data);
    }

    public function render()
    {
        return view('livewire.pages.admin.dashboard');
    }
}
