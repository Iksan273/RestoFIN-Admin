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
                                    </select>
                                </div>
                                <div class="card-body  text-center">
                                    <div id="chart-echart-line-basic" style="width: 100%; height: 300px;"></div>
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
            // Inisialisasi chart menggunakan ECharts
            var dom = document.getElementById("chart-echart-line-basic");
            var myChart = echarts.init(dom);
            var option = null;

            // Mendefinisikan fungsi untuk memperbarui chart dengan data tahunan
            function fetchYearlyData(selectedYear) {
                fetch('/get-yearly-sales-data?year=' + selectedYear)
                    .then(response => response.json())
                    .then(data => {
                        // Memperbarui data dan menggambar chart
                        option.xAxis.data = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                            'Oct', 'Nov', 'Dec'
                        ];
                        option.series[0].data = data.data;
                        myChart.setOption(option);
                    })
                    .catch(error => {
                        console.error('Error fetching yearly data:', error);
                    });
            }

            // Mendefinisikan opsi chart
            option = {
                tooltip: {
                    trigger: 'axis'
                },
                xAxis: {
                    type: 'category',
                    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    type: 'value'
                },
                color: "#19BCBF",
                series: [{
                    data: [], // Data akan diisi melalui fetchYearlyData
                    type: 'line',
                }]
            };

            // Menginisialisasi chart dengan opsi yang sudah ditentukan
            myChart.setOption(option);

            // Memanggil fungsi fetchYearlyData dengan tahun saat ini
            fetchYearlyData(new Date().getFullYear());

            // Mendengarkan perubahan pada dropdown tahun
            $('#year-select').change(function() {
                var selectedYear = $(this).val();
                fetchYearlyData(selectedYear);
            });

        });
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var selectedMonth = document.getElementById('month-select').value;

            // Use AJAX to fetch data
            fetch(`/get-sales-data?month=${selectedMonth}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 1) {
                        // Show message if no data is found
                        document.getElementById('chart-google-area').innerHTML =
                            '<p>No sales data found for this month.</p>';
                    } else {
                        var chartData = google.visualization.arrayToDataTable(data);

                        var options = {
                            hAxis: {
                                title: 'Tanggal' // Add label for X-axis
                            },
                            vAxis: {
                                minValue: 0
                            },
                            colors: ['#14DF51']
                        };

                        var chart = new google.visualization.AreaChart(document.getElementById('chart-google-area'));
                        chart.draw(chartData, options);
                    }
                })
                .catch(error => {
                    console.error('Error fetching sales data:', error);
                    document.getElementById('chart-google-area').innerHTML =
                        '<p>Error loading data. Please try again.</p>';
                });
        }

        // Event listener for the dropdown menu
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('month-select').addEventListener('change', drawChart);
        });
    </script>
    <script>
        // untuk combo box tahun

        var currentYear = new Date().getFullYear();


        var minYear = 2021;


        var selectOptions = '';
        for (var year = currentYear; year >= minYear; year--) {
            selectOptions += '<option value="' + year + '">' + year + '</option>';
        }

        // Populate the select element with options
        document.getElementById('year-select').innerHTML = selectOptions;
    </script>
@endsection
