@extends('Layouts.user')
@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">Dashboard</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#!">Master Dashboard</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <!-- table card-1 start -->
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-blue order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Total Order Hari Ini</h6>
                                    <h2 class="text-start"><span>{{ $totalOrdersToday }}</span><i
                                            class="feather icon-shopping-cart float-end"></i></h2>
                                    <p class="m-b-0 text-end">Orderan Selesai
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- table card-1 end -->
                        <!-- table card-2 start -->
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-green order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Total Pendapatan Hari Ini</h6>
                                    <h2 class="text-start"><span>Rp. {{ number_format($todaySales, 0, ',', '.') }}</span><i
                                            class="feather icon-shopping-cart float-end"></i></h2>
                                    <p class="m-b-0 text-end">Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <!-- table card-2 end -->
                        <!-- Widget primary-success card start -->
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-blue order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Total Rating</h6>
                                    <h2 class="text-start"><span>{{ $averageRating }}</span><i
                                            class="feather icon-star-on float-end"></i>
                                    </h2>
                                    <p class="m-b-0 text-end">Pelanggan</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <div class="card prod-p-card bg-c-red">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-25">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Orderan Bulan Ini</h6>
                                            <h3 class="m-b-0 text-white">{{ $totalOrdersThisMonth }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span
                                            class="label label-danger m-r-10">+{{ $percentageIncrease }}%</span>From
                                        Previous Month ({{ $totalLastMonthOrders }})</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card prod-p-card bg-c-yellow">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-25">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Member</h6>
                                            <h3 class="m-b-0 text-white">{{ $totalMembers }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tags text-c-yellow f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label  m-r-10"></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Omset Per Tahun</h5>
                                    <select id="year-select" class="form-control"
                                        style="width: auto; display: inline-block; margin-left: 20px;">
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <!-- Add more years as needed -->
                                    </select>
                                </div>
                                <div class="card-body">
                                    <canvas id="chart-bar-tahun" style="width: 100%; height: 300px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Omset Per Bulan</h5>
                                    <select id="month-select" class="form-control"
                                        style="width: auto; display: inline-block; margin-left: 20px;">
                                        <option value="Jan">January</option>
                                        <option value="Feb">February</option>
                                        <option value="Mar">March</option>
                                        <option value="Apr">April</option>
                                        <option value="May">May</option>
                                        <option value="Jun">June</option>
                                        <option value="Jul">July</option>
                                        <option value="Aug">August</option>
                                        <option value="Sep">September</option>
                                        <option value="Oct">October</option>
                                        <option value="Nov">November</option>
                                        <option value="Dec">December</option>
                                    </select>
                                </div>
                                <div class="card-body  text-center">
                                    <div id="chart-google-area" style="width: auto"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function createBarChart(canvasId, data, labels) {
                var ctx = document.getElementById(canvasId).getContext('2d');
                return new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Data 1",
                            data: data,
                            borderColor: '#19BCBF',
                            backgroundColor: '#19BCBF',
                            hoverBorderColor: '#19BCBF',
                            hoverBackgroundColor: '#19BCBF'
                        }, {
                            label: "Data 2",
                            data: data.map(d => d * 0.8), // Example data transformation
                            borderColor: '#463699',
                            backgroundColor: '#463699',
                            hoverBorderColor: '#463699',
                            hoverBackgroundColor: '#463699'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true,
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                enabled: true
                            }
                        },
                        layout: {
                            padding: {
                                left: 20,
                                right: 20,
                                top: 20,
                                bottom: 20
                            }
                        }
                    }
                });
            }

            // Initial data and labels
            var yearData = [25, 45, 74, 85, 55, 66, 77, 88, 99, 21, 22, 23];
            var monthData = [30, 52, 65, 65, 88, 77, 88, 99, 76, 44, 22, 11];
            var label1 = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var label2 = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];

            var yearChart = createBarChart("chart-bar-tahun", yearData, label1);
            var monthChart = createBarChart("chart-bar-bulan", monthData, label2);

            // Update chart when year selection changes
            $('#year-select').change(function() {
                var selectedYear = $(this).val();
                // Fetch and update data based on selected year
                // Placeholder: generate random data
                var newData = Array.from({
                    length: 12
                }, () => Math.floor(Math.random() * 100));
                yearChart.data.datasets.forEach((dataset, index) => {
                    dataset.data = newData.map(d => d * (index === 1 ? 0.8 : 1));
                });
                yearChart.update();
            });

        });
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Sample data for each month (30 days of data)
        const monthlyData = {
            'Jan': [
                ['Day', 'Sales'],
                [1, 200],
                [2, 800],
                [3, 210],
                [4, 250],
                [5, 300],
                [6, 310],
                [7, 320],
                [8, 330],
                [9, 340],
                [10, 350],
                [11, 360],
                [12, 370],
                [13, 380],
                [14, 390],
                [15, 400],
                [16, 410],
                [17, 420],
                [18, 430],
                [19, 440],
                [20, 450],
                [21, 460],
                [22, 470],
                [23, 480],
                [24, 490],
                [25, 500],
                [26, 510],
                [27, 520],
                [28, 530],
                [29, 540],
                [30, 550]
            ],
            // Add similar data for other months
            'Feb': [
                ['Day', 'Sales'],
                [1, 210],
                [2, 230],
                [3, 220],
                [4, 260],
                [5, 310],
                [6, 320],
                [7, 330],
                [8, 340],
                [9, 350],
                [10, 360],
                [11, 370],
                [12, 380],
                [13, 390],
                [14, 400],
                [15, 410],
                [16, 420],
                [17, 430],
                [18, 440],
                [19, 450],
                [20, 460],
                [21, 470],
                [22, 480],
                [23, 490],
                [24, 500],
                [25, 510],
                [26, 520],
                [27, 530],
                [28, 540],
                [29, 550],
                [30, 560]
            ],
            // Add data for other months similarly...
        };

        function drawChart() {
            // Get the selected month
            var selectedMonth = document.getElementById('month-select').value;

            // Get the data for the selected month
            var data = google.visualization.arrayToDataTable(monthlyData[selectedMonth]);

            var options = {
                vAxis: {
                    minValue: 0
                },
                colors: ['#463699']
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart-google-area'));
            chart.draw(data, options);
        }

        // Event listener for the dropdown menu
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('month-select').addEventListener('change', drawChart);
        });
    </script>
@endsection
