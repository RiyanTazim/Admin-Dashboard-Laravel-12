@extends('backend.app')

@section('title', 'Dashboard')

@section('content')
    {{--     PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    {{--     PAGE-HEADER --}}


    <div class="row">
        <!-- Card 1 -->
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2 fw-semibold">{{ $total_users ?? 0 }}</h3>
                        <p class="text-muted fs-13 mb-0">Total Users</p>
                    </div>
                    <div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
                        <i class="fe fe-users text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2 fw-semibold">{{ $total_orders ?? 0 }}</h3>
                        <p class="text-muted fs-13 mb-0">Total Orders</p>
                    </div>
                    <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                        <i class="fe fe-shopping-cart text-white"></i>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Card 3 -->
        {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2 fw-semibold">{{ $total_products ?? 0 }}</h3>
                        <p class="text-muted fs-13 mb-0">Total Products</p>
                    </div>
                    <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                        <i class="fe fe-box text-white"></i>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Card 4 -->
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2 fw-semibold">{{ $premium_users ?? 0 }}</h3>
                        <p class="text-muted fs-13 mb-0">Premium Users</p>
                    </div>
                    <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                        <i class="fe fe-star text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2 fw-semibold">{{ $total_care_plan ?? 0 }}</h3>
                        <p class="text-muted fs-13 mb-0">Total Care Plan</p>
                    </div>
                    <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                        <i class="fe fe-heart text-white"></i>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Card 6 -->
        {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2 fw-semibold">&pound; {{ $total_payments ?? 0 }}</h3>
                        <p class="text-muted fs-13 mb-0">Total Payments</p>
                    </div>
                    <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                        <i class="fe fe-credit-card text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row" style="margin-bottom: 100px;">
        <!-- Chart 1 -->
        <div class="col-lg-4 col-md-12 col-12 mb-4">
            <div class="card card-body mb-10">
                <div style="background-color: white;" class="p-4 rounded-3">
                    <div class="chart-container" style="height: 400px;">
                        <canvas id="new-users-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 2 -->
        <div class="col-lg-4 col-md-12 col-12 mb-4">
            <div class="card card-body mb-10">
                <div style="background-color: white;" class="p-4 rounded-3">
                    <div class="chart-container" style="height: 400px;">
                        <canvas id="total-order-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chart 3 -->
        <div class="col-lg-4 col-md-12 col-12 mb-4">
            <div class="card card-body mb-10">
                <div style="background-color: white;" class="p-4 rounded-3">
                    <div class="chart-container" style="height: 400px;">
                        <canvas id="total-payment-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

    {{-- chart for new users start --}}
    {{-- <script>
        // Get the current year dynamically
        const currentYear = new Date().getFullYear();

        // Data passed from the controller
        const labels = @json($chartData['labels']); // Will always have 12 months
        const data = @json($chartData['data']); // Will have counts, with 0 for months without users

        const ctx = document.getElementById('new-users-chart').getContext('2d');
        const newUserChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'This year\'s Users',
                    data: data,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(0, 123, 255, 0.5)',
                        'rgba(220, 53, 69, 0.5)',
                        'rgba(40, 167, 69, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(23, 162, 184, 0.5)',
                        'rgba(255, 193, 7, 0.5)',
                        'rgba(188, 80, 144, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132,0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(0, 123, 255, 0.5)',
                        'rgba(220, 53, 69, 0.5)',
                        'rgba(40, 167, 69, 0.5)',
                        'rgba(23, 162, 184, 0.5)',
                        'rgba(255, 193, 7, 0.5)',
                        'rgba(188, 80, 144, 0.5)'
                    ],
                    borderWidth: 1,
                    barThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // will be fixed height wise
                plugins: {
                    title: {
                        display: true,
                        text: `Total Users per Month (${currentYear})`
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}
    {{-- chart for new users end --}}

    {{-- chart for All Orders start --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Get the current year dynamically
            const currentYear = new Date().getFullYear();

            const labels = @json($orderChartData['labels']);
            const data = @json($orderChartData['data']);
            const ctx = document.getElementById('total-order-chart').getContext('2d');

            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Total Orders",
                        data: data,
                        borderColor: [
                            'rgba(255, 99, 132,0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                            'rgba(0, 123, 255, 0.5)',
                            'rgba(220, 53, 69, 0.5)',
                            'rgba(40, 167, 69, 0.5)',
                            'rgba(23, 162, 184, 0.5)',
                            'rgba(255, 193, 7, 0.5)',
                            'rgba(188, 80, 144, 0.5)'
                        ],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Disable aspect ratio maintenance
                    plugins: {
                        title: {
                            display: true,
                            text: `Total Orders per Month (${currentYear})`
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script> --}}
    {{-- chart for All Orders start --}}


    {{-- chart for All Payment start --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Get the current year dynamically
            const currentYear = new Date().getFullYear();

            // Get chart data from the controller
            const labels = @json($paymentChartData['labels']); // Months
            const data = @json($paymentChartData['data']); // Total payments for each month

            // Get the canvas element
            const ctx = document.getElementById('total-payment-chart').getContext('2d');

            // Create the chart
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `Total Payments per Month (${currentYear})`,
                        data: data,
                        borderColor: 'rgba(54, 162, 235, 0.7)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Disable aspect ratio maintenance
                    plugins: {
                        title: {
                            display: true,
                            text: `Total Payments per Month (${currentYear})`
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script> --}}
    {{-- chart for All Payment start --}}
@endpush
