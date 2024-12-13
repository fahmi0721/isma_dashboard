@extends("template.purple.index")
@section("page-title", "DASHBOARD | MONITORING")
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
    </span> Home
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home </li>
    </ul>
    </nav>
</div>
@endsection

@section('konten')

<div class="col-12 grid-margin">
    <div class="card card-statistics">
        <div class="row">
        <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-users text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">Total</p>
                <div class="fluid-container">
                    <h3 class="mb-0 font-weight-medium">{{ number_format(($data['produksi_spjm']->tot + $data['produksi_jai']->tot + $data['produksi_pms']->tot),0,',','.') }}</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-user text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">{{ $data['produksi_spjm']->deskripsi }}</p>
                <div class="fluid-container">
                    <h3 class="mb-0 font-weight-medium">{{ $data['produksi_spjm']->tot }}</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-user-o text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">{{ $data['produksi_pms']->deskripsi }}</p>
                <div class="fluid-container">
                <h3 class="mb-0 font-weight-medium">{{ $data['produksi_pms']->tot }}</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-user text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">{{ $data['produksi_jai']->deskripsi }}</p>
                <div class="fluid-container">
                <h3 class="mb-0 font-weight-medium">{{ $data['produksi_jai']->tot }}</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title"><center>Laba Rugi</center></h5>
                <canvas id="laba-rugi"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><center>Pendapatan & Biaya</center></h5>
                <canvas id="pb"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function(){
        info('Welcome {{ auth()->user()->nama }}','Selamat datang diaplikasi Dashboard ISMA','success','top-right');
        load_laba_rugi();
        // bar_chart();
    });


    function load_laba_rugi(){
        $.ajax({
            type: "POST",
            dataType: "json",
            url : "{{ route('home.laba_rugi') }}",
            data	: "_token={{ csrf_token() }}",
            success: function(res){
                console.log(res)
                line_chart(res.result);
                bar_chart(res.result);
            },
            error : function(er){
                console.log(er)
            }

        })
    }

    bar_chart = function(result){

        const labels = ['Januari',"Februari"];
        const data = {
            labels: result.labels,
            datasets: result.pb.dataset
            //     datasets: [
            //     {
            //     label: 'Pendapatan (Miliyar)',
            //     data: result.pendapatan,
            //     backgroundColor: 'rgba(54, 162, 235, 1)',
            //     },
            //     {
            //     label: 'Biaya (Miliyar)',
            //     data: result.biaya,
            //     backgroundColor: 'rgba(255, 206, 86, 1)',
            //     },
                
            // ]
        };
        const config = {
        type: 'bar',
        data: data,
        options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        };

        var barChartCanvas = $("#pb").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var barChart = new Chart(barChartCanvas, config);
    }

    line_chart = function(result){
        var data = {
            labels: result.labels,
            datasets: result.laba_rugi.dataset
        };
        var options = {
            responsive: true,
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true
                    }
                }
            },
            legend: {
                display: true
            },
            elements: {
                line: {
                    tension: 0.5
                },
                point: {
                    radius: 2
                }
            },
        };

        var lineChartCanvas = $("#laba-rugi").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: data,
        options: options
        });
    }

    
</script>
@endsection