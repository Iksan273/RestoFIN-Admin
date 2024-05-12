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
                                    <h5 class="m-b-10">Sales</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i
                                                class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Sales Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- support-section start -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card support-bar">
                            <div class="card-body pb-0">
                                <h2 class="m-0">350</h2>
                                <span class="text-c-purple">Support Requests</span>
                                <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                            </div>
                            <div id="support-chart" style="height:100px;width:100%;"></div>
                            <div class="card-footer bg-purple text-white">
                                <div class="row text-center">
                                    <div class="col">
                                        <h4 class="m-0 text-white">10</h4>
                                        <span>Open</span>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-0 text-white">5</h4>
                                        <span>Running</span>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-0 text-white">3</h4>
                                        <span>Solved</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- support-section end -->
                    <!-- support1-section start -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card support-bar">
                            <div class="card-body pb-0">
                                <h2 class="m-0">30<small>min</small></h2>
                                <span class="text-c-blue">Agent Response</span>
                                <p class="mb-3 mt-3">Total number ticket solve by the agent.</p>
                            </div>
                            <div id="support-chart1" style="height:100px;width:100%;"></div>
                            <div class="card-footer bg-primary text-white">
                                <div class="row text-center">
                                    <div class="col">
                                        <h4 class="m-0 text-white">5</h4>
                                        <span>pending</span>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-0 text-white">75+</h4>
                                        <span>Satisfied clients</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- support1-section end -->
                    <!-- support2-section start -->
                    <div class="col-xl-4 col-md-12">
                        <div class="card support-bar">
                            <div class="card-body pb-0">
                                <h2 class="m-0">800</h2>
                                <span class="text-c-green">Support Resolved</span>
                                <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                            </div>
                            <div id="support-chart2" style="height:100px;width:100%;"></div>
                            <div class="card-footer bg-success text-white">
                                <div class="row text-center">
                                    <div class="col">
                                        <h4 class="m-0 text-white">80</h4>
                                        <span>Starred</span>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-0 text-white">3</h4>
                                        <span>Reopen</span>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-0 text-white">14+</h4>
                                        <span>Reassigned</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- support2-section end -->
                    <!-- site-section start -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card bg-primary earning-date">
                                    <div class="card-header borderless">
                                        <h5 class="text-white">Earnings</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="bd-example bd-example-tabs">
                                            <div class="tab-content" id="tabContent-pills">
                                                <div class="tab-pane fade active show" id="earnings-mon"
                                                    role="tabpanel" aria-labelledby="pills-earnings-mon">
                                                    <h2 class="text-white mb-3 f-w-300">359,234<i
                                                            class="feather icon-arrow-up"></i></h2>
                                                    <span class="text-white mb-4 d-block">TOTAL EARNINGS</span>
                                                </div>
                                                <div class="tab-pane fade" id="earnings-tue" role="tabpanel"
                                                    aria-labelledby="pills-earnings-tue">
                                                    <h2 class="text-white mb-3 f-w-300">222,586<i
                                                            class="feather icon-arrow-down"></i></h2>
                                                    <span class="text-white mb-4 d-block">TOTAL EARNINGS</span>
                                                </div>
                                                <div class="tab-pane fade" id="earnings-wed" role="tabpanel"
                                                    aria-labelledby="pills-earnings-wed">
                                                    <h2 class="text-white mb-3 f-w-300">859,745<i
                                                            class="feather icon-arrow-up"></i></h2>
                                                    <span class="text-white mb-4 d-block">TOTAL EARNINGS</span>
                                                </div>
                                                <div class="tab-pane fade" id="earnings-thu" role="tabpanel"
                                                    aria-labelledby="pills-earnings-thu">
                                                    <h2 class="text-white mb-3 f-w-300">785,684<i
                                                            class="feather icon-arrow-up"></i></h2>
                                                    <span class="text-white mb-4 d-block">TOTAL EARNINGS</span>
                                                </div>
                                                <div class="tab-pane fade" id="earnings-fri" role="tabpanel"
                                                    aria-labelledby="pills-earnings-fri">
                                                    <h2 class="text-white mb-3 f-w-300">123,486<i
                                                            class="feather icon-arrow-down"></i></h2>
                                                    <span class="text-white mb-4 d-block">TOTAL EARNINGS</span>
                                                </div>
                                                <div class="tab-pane fade" id="earnings-sat" role="tabpanel"
                                                    aria-labelledby="pills-earnings-sat">
                                                    <h2 class="text-white mb-3 f-w-300">762,963<i
                                                            class="feather icon-arrow-up"></i></h2>
                                                    <span class="text-white mb-4 d-block">TOTAL EARNINGS</span>
                                                </div>
                                                <div class="tab-pane fade" id="earnings-sun" role="tabpanel"
                                                    aria-labelledby="pills-earnings-sun">
                                                    <h2 class="text-white mb-3 f-w-300">984,632<i
                                                            class="feather icon-arrow-down"></i></h2>
                                                    <span class="text-white mb-4 d-block">TOTAL EARNINGS</span>
                                                </div>
                                            </div>
                                            <ul class="nav nav-pills align-items-center" id="pills-tab"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" id="pills-earnings-mon"
                                                        data-bs-toggle="pill" href="#earnings-mon" role="tab"
                                                        aria-controls="earnings-mon"
                                                        aria-selected="false">Mon</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-earnings-tue"
                                                        data-bs-toggle="pill" href="#earnings-tue" role="tab"
                                                        aria-controls="earnings-tue"
                                                        aria-selected="false">Tue</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-earnings-wed"
                                                        data-bs-toggle="pill" href="#earnings-wed" role="tab"
                                                        aria-controls="earnings-wed"
                                                        aria-selected="false">Wed</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-earnings-thu"
                                                        data-bs-toggle="pill" href="#earnings-thu" role="tab"
                                                        aria-controls="earnings-thu"
                                                        aria-selected="false">Thu</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-earnings-fri"
                                                        data-bs-toggle="pill" href="#earnings-fri" role="tab"
                                                        aria-controls="earnings-fri"
                                                        aria-selected="false">Fri</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link " id="pills-earnings-sat"
                                                        data-bs-toggle="pill" href="#earnings-sat" role="tab"
                                                        aria-controls="earnings-sat"
                                                        aria-selected="true">Sat</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-earnings-sun"
                                                        data-bs-toggle="pill" href="#earnings-sun" role="tab"
                                                        aria-controls="earnings-sun"
                                                        aria-selected="false">Sun</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-auto">
                                                <h6>Active customer <span class="d-block">on site</span></h6>
                                                <h2 class="m-0">2.86</h2>
                                                <span class="text-c-green">+85.9%</span>
                                            </div>
                                            <div class="col">
                                                <div id="site-chart" style="height:150px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- site-section end -->
                    <!-- visit-section start -->
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Total customer by Location</h5>
                            </div>
                            <div class="card-body">
                                <div id="am-map-chart" style="height:300px;width:100%;"></div>
                                <div class="row mb-2 mt-3">
                                    <div class="col">
                                        <p class="m-0"><i class="fas fa-circle text-c-blue f-10 m-r-10"></i>USA
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="m-0">8.2 k</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-c-blue m-0"><i class="feather icon-arrow-up"></i>8%</p>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="m-0"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>India
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="m-0">7.2 k</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-c-red m-0"><i class="feather icon-arrow-up"></i>5%</p>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="m-0"><i
                                                class="fas fa-circle text-c-green f-10 m-r-10"></i>China</p>
                                    </div>
                                    <div class="col">
                                        <p class="m-0">9.2 k</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-c-green m-0"><i class="feather icon-arrow-up"></i>6%</p>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="m-0"><i
                                                class="fas fa-circle text-c-yellow f-10 m-r-10"></i>Brazil</p>
                                    </div>
                                    <div class="col">
                                        <p class="m-0">3.2 k</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-c-yellow m-0"><i class="feather icon-arrow-up"></i>4%</p>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="m-0"><i
                                                class="fas fa-circle text-c-purple f-10 m-r-10"></i>Other</p>
                                    </div>
                                    <div class="col">
                                        <p class="m-0">4.2 k</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-c-purple m-0"><i class="feather icon-arrow-up"></i>3%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- visit-section end -->
                    <!-- sessions-section start -->
                    <div class="col-xl-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Sale report</h5>
                            </div>
                            <div class="card-body px-0 py-0">
                                <div class="table-responsive">
                                    <div class="session-scroll" style="height:354px;position:relative;">
                                        <table class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th><span>CAMPAIGN DATE</span></th>
                                                    <th><span>CLICK <a class="help" data-bs-toggle="popover"
                                                                title="Popover title"
                                                                data-bs-content="And here's some amazing content. It's very engaging. Right?"><i
                                                                    class="feather icon-help-circle f-16"></i></a></span>
                                                    </th>
                                                    <th><span>COST <a class="help" data-bs-toggle="popover"
                                                                title="Popover title"
                                                                data-bs-content="And here's some amazing content. It's very engaging. Right?"><i
                                                                    class="feather icon-help-circle f-16"></i></a></span>
                                                    </th>
                                                    <th><span>CTR <a class="help" data-bs-toggle="popover"
                                                                title="Popover title"
                                                                data-bs-content="And here's some amazing content. It's very engaging. Right?"><i
                                                                    class="feather icon-help-circle f-16"></i></a></span>
                                                    </th>
                                                    <th><span>ARPU <a class="help" data-bs-toggle="popover"
                                                                title="Popover title"
                                                                data-bs-content="And here's some amazing content. It's very engaging. Right?"><i
                                                                    class="feather icon-help-circle f-16"></i></a></span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Entire</td>
                                                    <td>1300</td>
                                                    <td>1025</td>
                                                    <td>14005</td>
                                                    <td>95,3%</td>
                                                </tr>
                                                <tr>
                                                    <td>8-11-2016</td>
                                                    <td>786
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 60%;"
                                                                aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>485
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 50%;"
                                                                aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>769
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 70%;"
                                                                aria-valuenow="70" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>45,3%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 60%;"
                                                                aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>15-10-2016</td>
                                                    <td>786
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 65%;"
                                                                aria-valuenow="65" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>523
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 80%;"
                                                                aria-valuenow="80" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>736
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 80%;"
                                                                aria-valuenow="80" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>78,3%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 70%;"
                                                                aria-valuenow="70" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>8-8-2017</td>
                                                    <td>624
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 45%;"
                                                                aria-valuenow="45" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>436
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 55%;"
                                                                aria-valuenow="55" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>756
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 95%;"
                                                                aria-valuenow="95" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>78,3%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 38%;"
                                                                aria-valuenow="38" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>11-12-2017</td>
                                                    <td>423
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 54%;"
                                                                aria-valuenow="54" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>123
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 70%;"
                                                                aria-valuenow="70" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>756
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 75%;"
                                                                aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>78,6%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 60%;"
                                                                aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1-6-2015</td>
                                                    <td>465
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 66%;"
                                                                aria-valuenow="66" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>463
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 50%;"
                                                                aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>456
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 30%;"
                                                                aria-valuenow="30" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>68,6%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 30%;"
                                                                aria-valuenow="30" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>8-11-2016</td>
                                                    <td>786
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 43%;"
                                                                aria-valuenow="43" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>485
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 70%;"
                                                                aria-valuenow="70" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>769
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 69%;"
                                                                aria-valuenow="69" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>45,3%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 90%;"
                                                                aria-valuenow="90" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>15-10-2016</td>
                                                    <td>786
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 61%;"
                                                                aria-valuenow="61" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>523
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 45%;"
                                                                aria-valuenow="45" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>736
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 70%;"
                                                                aria-valuenow="70" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>78,3%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 60%;"
                                                                aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>8-8-2017</td>
                                                    <td>624
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 66%;"
                                                                aria-valuenow="66" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>436
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 55%;"
                                                                aria-valuenow="55" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>756
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 90%;"
                                                                aria-valuenow="90" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>78,3%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 66%;"
                                                                aria-valuenow="66" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>11-12-2017</td>
                                                    <td>423
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 35%;"
                                                                aria-valuenow="35" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>123
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 60%;"
                                                                aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>756
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 70%;"
                                                                aria-valuenow="70" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>78,6%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 50%;"
                                                                aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1-6-2015</td>
                                                    <td>465
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-danger rounded"
                                                                role="progressbar" style="width: 66%;"
                                                                aria-valuenow="66" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>463
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-primary rounded"
                                                                role="progressbar" style="width: 50%;"
                                                                aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>456
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-warning rounded"
                                                                role="progressbar" style="width: 30%;"
                                                                aria-valuenow="30" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>68,6%
                                                        <div class="progress mt-1" style="height:4px;">
                                                            <div class="progress-bar bg-success rounded"
                                                                role="progressbar" style="width: 90%;"
                                                                aria-valuenow="90" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sessions-section end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
</div>
@endsection
