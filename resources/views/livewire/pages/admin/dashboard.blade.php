{{-- Customize layout sections --}}

@section('subtitle', 'Dashboard')

{{-- Content body: main page content --}}

<div>
    <div class="card">
        <div class="card-header">
            <h1 class="h2 font-weight-bold text-secondary mb-4">Dashboard</h1>
            <h2 class="h3 font-weight-semibold text-muted mb-4">Laporan Diterima Tahun Ini</h2>
        </div>
        <div class="card-body">
            <div wire:ignore>
                <canvas id="complaints_chart" height="400"></canvas>
            </div>
            <div wire:ignore>
                <canvas id="complaints_grouped_by_category_chart" height="400"></canvas>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', () => {
                // Initial chart data
                const initial_complaint_total_chart_data = @json($complaint_total_chart_data);
                const initial_complaint_grouped_by_category_chart_data = @json($complaint_group_category_chart_data);
                let chart_complaint_total;
                let chart_complaint_grouped_by_category;



                const ctx = document.getElementById('complaints_chart').getContext('2d');
                const ctx_complaints_grouped_by_category_chart = document.getElementById(
                    'complaints_grouped_by_category_chart').getContext('2d');

                function render_complaint_total_chart(data) {
                    if (chart_complaint_total) {
                        chart_complaint_total.destroy(); // Destroy the old chart instance before creating a new one
                    }

                    chart_complaint_total = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Jumlah Laporan',
                                data: data.data,
                                backgroundColor: 'rgba(239, 68, 68, 0.2)', // Red area color
                                borderColor: 'rgba(239, 68, 68, 1)', // Red line color
                                borderWidth: 2,
                                tension: 0.4, // Makes the line smooth
                                fill: true,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: {
                                    beginAtZero: true,
                                    ticks: {
                                        // Ensure only whole numbers are shown on the Y-axis
                                        stepSize: 1,
                                        callback: function(value) {
                                            if (value % 1 === 0) {
                                                return value;
                                            }
                                        }
                                    },
                                    gridLines: {
                                        display: false
                                    },
                                },
                                xAxes: {
                                    gridLines: {
                                        display: false
                                    },
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false // Hide the legend as there's only one dataset
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return ' Laporan: ' + context.parsed.y;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                function render_complaint_grouped_by_category_chart(data) {
                    if (chart_complaint_grouped_by_category) {
                        chart_complaint_grouped_by_category.destroy(); // Destroy the old chart instance before creating a new one
                    }

                    chart_complaint_grouped_by_category = new Chart(ctx_complaints_grouped_by_category_chart, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                    label: 'Pengaduan',
                                    data: data.data[0]['counts'],
                                    backgroundColor: 'rgba(255, 203, 97, 0.2)', // Red area color
                                    borderColor: 'rgba(255, 203, 97, 1)', // Red line color
                                    borderWidth: 2,
                                    tension: 0.4, // Makes the line smooth
                                    fill: true,
                                },
                                {
                                    label: 'Aspirasi',
                                    data: data.data[1]['counts'],
                                    backgroundColor: 'rgba(255, 137, 79, 0.2)', // Red area color
                                    borderColor: 'rgba(255, 137, 79, 1)', // Red line color
                                    borderWidth: 2,
                                    tension: 0.4, // Makes the line smooth
                                    fill: true,
                                },
                                {
                                    label: 'Permintaan Informasi',
                                    data: data.data[2]['counts'],
                                    backgroundColor: 'rgba(234, 91, 111, 0.2)', // Red area color
                                    borderColor: 'rgba(2234, 91, 111, 1)', // Red line color
                                    borderWidth: 2,
                                    tension: 0.4, // Makes the line smooth
                                    fill: true,
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: {
                                    beginAtZero: true,
                                    ticks: {
                                        // Ensure only whole numbers are shown on the Y-axis
                                        stepSize: 1,
                                        callback: function(value) {
                                            if (value % 1 === 0) {
                                                return value;
                                            }
                                        }
                                    },
                                    gridLines: {
                                        display: false
                                    },
                                },
                                xAxes: {
                                    gridLines: {
                                        display: false
                                    },
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false // Hide the legend as there's only one dataset
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return ' Laporan: ' + context.parsed.y;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                // Render the initial chart
                render_complaint_total_chart(initial_complaint_total_chart_data);
                // render_complaint_grouped_by_category_chart(initial_complaint_grouped_by_category_chart_data);

                // Listen for the 'chartDataUpdated' event from the Livewire component
                Livewire.on('chart_data_updated', (event) => {
                    render_complaint_total_chart(event[0]);
                    render_complaint_grouped_by_category_chart(event[1]);
                });
            });
        </script>
    @endpush
</div>
