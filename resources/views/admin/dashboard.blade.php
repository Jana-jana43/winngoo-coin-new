@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')   
<!-- <div id="layout-wrapper"> -->

         <div class="vertical-overlay"></div>

       <!-- <div class=""> -->

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Dashboard</h4>                                
                           </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row project-wrapper">
                        <div class="col-xxl-12">
                            <p>Real-time insights into your winngoo Coin platform</p>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                        <i data-feather="users" class="text-primary"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Users</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-5 flex-grow-1 mb-0"><span class="counter-value" data-target="{{$totalUsers}}">{{$totalUsers}}</span></h4>

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success-subtle text-success rounded-2 fs-2">
                                                        <i data-feather="user-check" class="text-success"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-medium text-muted mb-3">Active Miners</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-5 flex-grow-1 mb-0"><span class="counter-value" data-target="{{$activeMiners}}">{{$activeMiners}}</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-danger-subtle text-danger rounded-2 fs-2">
                                                        <i data-feather="user-x" class="text-danger"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">In-Active Miners</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-5 flex-grow-1 mb-0"><span class="counter-value" data-target="{{$inactiveMiners }}">{{$inactiveMiners }}</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                                        <span class="ri-coins-line text-info"></span>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Mined</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-5 flex-grow-1 mb-0"><span class="counter-value" data-target="{{$totalMined}}">{{$totalMined}}</span> WNG</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->

                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="card">
                                        <div class="card-header border-0 bg-light-subtle align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Total Users</h4>
                                            <select class="bg-info-subtle border-0 px-2 py-1" id="yearSelect" title="year" name="year"></select>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="totalUsersChart" height="350"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="card">
                                        <div class="card-header border-0 bg-light-subtle align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Coin Usage</h4>
                                            <select class="bg-info-subtle border-0 px-2 py-1" id="yearSelectCoin" title="year" name="year"></select>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="coinUsageChart" class="m-auto" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--<div class="col-lg-6">-->
                                <!--    <div class="card">-->
                                <!--        <div class="card-header border-0 bg-light-subtle align-items-center d-flex">-->
                                <!--            <h4 class="card-title mb-0 flex-grow-1">Country Users</h4>-->
                                <!--        </div>-->
                                <!--        <div class="card-body">-->
                                <!--            <canvas id="countryUsersChart" height="250"></canvas>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header border-0 bg-light-subtle align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Users Activity</h4>
                                            <ul class="nav nav-tabs mb-0" id="chartTabs">
                                                <li class="nav-item"><a class="nav-link active" data-type="daily" href="#">Daily</a></li>
                                                <li class="nav-item"><a class="nav-link" data-type="weekly" href="#">Weekly</a></li>
                                                <li class="nav-item"><a class="nav-link" data-type="monthly" href="#">Monthly</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="activityChart" height="250"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

             @include('layouts.footer')
        <!-- </div> -->
        <!-- end main content-->

    </div>
@endsection

    @push('scripts')
  <script>
// ------- Total Users Chart -------
// const ctx1 = document.getElementById('totalUsersChart').getContext('2d');
// new Chart(ctx1, {
//   type: 'bar',
//   data: {
//     labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct'],
//     datasets: [{
//       label: 'Active Miners',
//       data: [50, 60, 70, 85, 65, 80, 75, 70, 85, 90],
//       backgroundColor: 'rgba(255, 99, 132, 0.7)',
//       borderRadius: 8
//     },{
//       label: 'In-Active Miners',
//       data: [20, 15, 25, 20, 18, 22, 20, 18, 22, 19],
//       backgroundColor: 'rgba(255, 159, 64, 0.5)',
//       borderRadius: 8
//     }]
//   },
//   options: {
//     responsive: true,
//     plugins: {
//       legend: { position: 'top' }
//     },
//     scales: {
//       y: { beginAtZero: true, max: 100, ticks: { stepSize: 25, callback: v => v + '%' } }
//     }
//   }
// });

// ------- Country Users Chart -------
// const ctx2 = document.getElementById('countryUsersChart').getContext('2d');
// new Chart(ctx2, {
//   type: 'bar',
//   data: {
//     labels: ['2021', '2022', '2023', '2024', '2025'],
//     datasets: [
//       { label: 'USA', data: [60, 70, 85, 75, 90], backgroundColor: '#7c4baf' },
//       { label: 'India', data: [80, 50, 65, 40, 70], backgroundColor: '#3cd188' },
//       { label: 'Canada', data: [40, 55, 60, 65, 45], backgroundColor: '#f04770' },
//       { label: 'Australia', data: [30, 40, 70, 35, 50], backgroundColor: '#2db0b5' },
//       { label: 'UK', data: [90, 95, 80, 75, 80], backgroundColor: '#fa9e34' }
//     ]
//   },
//   options: {
//     responsive: true,
//     plugins: {
//       legend: { position: 'top' }
//     },
//     scales: {
//       y: { beginAtZero: true, max: 100 }
//     }
//   }
// });
</script>
<script>
// ---------- Pie Chart ----------
// const ctxPie = document.getElementById('coinUsageChart').getContext('2d');
// new Chart(ctxPie, {
//   type: 'pie',
//   data: {
//     labels: ['Bronze', 'Silver', 'Gold'],
//     datasets: [{
//       data: [45, 30, 25],   // your values
//       backgroundColor: ['#f6c23e', '#858796', '#1cc88a']
//     }]
//   },
//   options: {
//     responsive: true,
//     plugins: {
//       legend: {
//         position: 'right'
//       },
//       datalabels: {
//         color: '#fff',
//         font: {
//           weight: 'bold',
//           size: 14
//         },
//         formatter: (value, ctx) => {
//           let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
//           let percentage = (value / sum * 100).toFixed(1) + "%";
//           return percentage;  // only % inside pie
//         }
//       }
//     }
//   },
//   plugins: [ChartDataLabels]
// });


// ---------- Line Chart with Tabs ----------
// const ctxLine = document.getElementById('activityChart').getContext('2d');

// const chartData = {
//   daily: {
//     labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
//     data: [50, 100, 150, 200, 120, 180, 250]
//   },
//   weekly: {
//     labels: ['Week 1','Week 2','Week 3','Week 4'],
//     data: [220, 300, 280, 350]
//   },
//   monthly: {
//     labels: ['May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr'],
//     data: [50,100,200,380,250,230,180,120,280,320,360,150]
//   }
// };

// Create Line Chart
// let activityChart = new Chart(ctxLine, {
//   type: 'line',
//   data: {
//     labels: chartData.monthly.labels,
//     datasets: [{
//       label: 'Users',
//       data: chartData.monthly.data,
//       fill: true,
//       backgroundColor: 'rgba(78, 115, 223, 0.1)',
//       borderColor: 'rgba(78, 115, 223, 1)',
//       tension: 0.4,
//       pointBackgroundColor: 'rgba(78, 115, 223, 1)'
//     }]
//   },
//   options: {
//     responsive: true,
//     plugins: { legend: { display: false } },
//     scales: {
//       y: { beginAtZero: true }
//     }
//   }
// });

// Tab click event
// document.querySelectorAll('#chartTabs .nav-link').forEach(tab => {
//   tab.addEventListener('click', function(e) {
//     e.preventDefault();
//     document.querySelectorAll('#chartTabs .nav-link').forEach(t => t.classList.remove('active'));
//     this.classList.add('active');

//     const type = this.getAttribute('data-type');
//     activityChart.data.labels = chartData[type].labels;
//     activityChart.data.datasets[0].data = chartData[type].data;
//     activityChart.update();
//   });
// });
</script>
<script>
//   const yearSelect = document.getElementById("yearSelect");
//   const currentYear = new Date().getFullYear();
//   const startYear = 1900;
//   const endYear = 2099;

//   for (let year = startYear; year <= endYear; year++) {
//     let option = document.createElement("option");
//     option.value = year;
//     option.textContent = year;
//     if (year === currentYear) option.selected = true; // ✅ default select
//     yearSelect.appendChild(option);
  }

  // Ensure dropdown shows current year by default
//   yearSelect.value = currentYear;
//   yearSelect.scrollTop = yearSelect.selectedIndex * 30;
// </script>
// <script>
//   const yearSelectCoin = document.getElementById("yearSelectCoin");
//   const currentYearCoin = new Date().getFullYear();
//   const startYearCoin = 1900;
//   const endYearCoin = 2099;

//   for (let year = startYear; year <= endYear; year++) {
//     let option = document.createElement("option");
//     option.value = year;
//     option.textContent = year;
//     if (year === currentYear) option.selected = true; // ✅ default select
//     yearSelectCoin.appendChild(option);
  }

  // Ensure dropdown shows current year by default
//   yearSelectCoin.value = currentYear;
//   yearSelectCoin.scrollTop = yearSelectCoin.selectedIndex * 30;
</script>

<!--functionality-->


 <script>
// ------- Total Users Chart -------

const ctx1 = document.getElementById('totalUsersChart').getContext('2d');

new Chart(ctx1, {
  type: 'bar',
  data: {
    labels: @json($months),
    datasets: [
      {
        label: 'Active Miners',
        data: @json($activeData),
        backgroundColor: 'rgba(255, 99, 132, 0.7)'
      },
      {
        label: 'In-Active Miners',
        data: @json($inactiveData),
        backgroundColor: 'rgba(255, 159, 64, 0.5)'
      }
    ]
  }
});
// ------- Country Users Chart -------

</script>
<script>
// ---------- Pie Chart ----------

const ctxPie = document.getElementById('coinUsageChart').getContext('2d');

new Chart(ctxPie, {
  type: 'pie',
  data: {
    labels: ['Bronze', 'Silver', 'Gold'],
    datasets: [{
      data: @json($coinUsage),
      backgroundColor: ['#f6c23e', '#858796', '#1cc88a']
    }]
  }
});
// ---------- Line Chart with Tabs ----------




</script>
<script>

// ---------- DATA ----------
const chartData = {
  daily: {
    labels: @json($dailyLabels),
    data: @json($dailyData)
  },
  weekly: {
    labels: @json($weeklyLabels),
    data: @json($weeklyData)
  },
  monthly: {
    labels: @json($monthlyLabels),
    data: @json($monthlyData)
  }
};

// ---------- INITIAL CHART ----------
const ctx = document.getElementById('activityChart').getContext('2d');

let activityChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: chartData.daily.labels,
    datasets: [{
      label: 'Users',
      data: chartData.daily.data,
      borderColor: '#4e73df',
      backgroundColor: 'rgba(78,115,223,0.1)',
      fill: true,
      tension: 0.4
    }]
  }
});

// ---------- TAB CLICK ----------
document.querySelectorAll('#chartTabs .nav-link').forEach(tab => {
  tab.addEventListener('click', function (e) {
    e.preventDefault();

    document.querySelectorAll('#chartTabs .nav-link')
      .forEach(t => t.classList.remove('active'));

    this.classList.add('active');

    let type = this.getAttribute('data-type');

    activityChart.data.labels = chartData[type].labels;
    activityChart.data.datasets[0].data = chartData[type].data;

    activityChart.update();
  });
});

</script>
<script>
 const yearSelect = document.getElementById("yearSelect");

const currentYear = new Date().getFullYear();
const startYear = 2020; // optional (or your project start year)
const endYear = currentYear; // ❌ future remove

for (let year = startYear; year <= endYear; year++) {
    let option = document.createElement("option");
    option.value = year;
    option.textContent = year;

    // selected year from backend
    if (year == "{{ request('users_year', now()->year) }}") {
        option.selected = true;
    }

    yearSelect.appendChild(option);
}
</script>
<script>
const yearSelectCoin = document.getElementById("yearSelectCoin");

for (let year = startYear; year <= endYear; year++) {
    let option = document.createElement("option");
    option.value = year;
    option.textContent = year;

   if (year == "{{ request('users_year', now()->year) }}") {
        option.selected = true;
    }

    yearSelectCoin.appendChild(option);
}
</script>
<script>
const params = new URLSearchParams(window.location.search);

document.getElementById("yearSelect").addEventListener("change", function () {
    params.set("users_year", this.value);
    window.location.search = params.toString();
});
</script>
    
   <script>
document.getElementById("yearSelectCoin").addEventListener("change", function () {
    params.set("coin_year", this.value);
    window.location.search = params.toString();
});
</script>
<script>
yearSelect.value = "{{ request('users_year', now()->year) }}";
yearSelectCoin.value = "{{ request('coin_year', now()->year) }}";
</script>


    @endpush