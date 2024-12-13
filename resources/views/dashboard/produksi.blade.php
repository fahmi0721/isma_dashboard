@extends("template.purple.index")
@section("page-title", "DASHBOARD PRODUKSI | MONITORING")
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="fa fa-dashboard"></i>
    </span> Dashboard Produksi
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard Produksi </li>
    </ul>
    </nav>
</div>
@endsection

@section('konten')
<div class='row'>
    <div class='col-4'>
    <div class="form-group">
        <label for="nama">Periode</label>
        <select class="form-control periode" id="periode" onchange="load_chart(this.value)" name='periode' style="width:100%">
            <option></option>
            @foreach($data['periode'] as $periode)
                <option value="{{ $periode->id }}" @if($data['periode_active'] == $periode->id) selected @endif>{{ $periode->nama }}</option>
            @endforeach
        </select>
    </div>
    </div>
</div>
<div class="col-12 grid-margin">
    <div class="card card-statistics">
        <div class="row">
        <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-users text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">Tenaga Kerja</p>
                <div class="fluid-container">
                    <h3 class="mb-0 font-weight-medium"><span id='count_tk'>{{ number_format($data['tenaga_kerja']->jumlah_tk,0,',','.') }}</span></h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-building text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">Data Entitas</p>
                <div class="fluid-container">
                    <h3 class="mb-0 font-weight-medium">{{ $data['entitas'] }}</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-file-pdf-o text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">Data Project</p>
                <div class="fluid-container">
                <h3 class="mb-0 font-weight-medium">{{ $data['project'] }}</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-tags text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">Segmen Usaha</p>
                <div class="fluid-container">
                <h3 class="mb-0 font-weight-medium">{{ $data['segmen'] }}</h3>
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
            <h5 class="card-title">Jumlah Tenaga Kerja Berdasarkan Entitas Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
                <div id="box_entitas"><canvas id="entitas_chart"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jumlah Tenaga Kerja Berdasarkan Project Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
                <div id="box_project"><canvas id="entitas_project"></canvas></div>
            </div>
        </div>
    </div>
</div>

<div class='row'>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Jumlah Tenaga Kerja Berdasarkan Jabatan Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
            <div id="box_job"><canvas id="job_chart"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jumlah Tenaga Kerja Berdasarkan Segmen Usaha Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
                <div id="box_segmen"><canvas id="segmen_dt"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function(){
        select_option(".periode","Pilih data periode");
        load_chart("{{ $data['periode_active'] }}");
        
        
    });
       
    var charts=[];
    load_chart = function(periode_id){
        $.ajax({
            type: "POST",
            dataType: "json",
            url : "{{ route('dashboard.produksi') }}",
            data	: "_token={{ csrf_token() }}&periode_id="+periode_id,
            success: function(res){
                console.log(res)
                $("#count_tk").html(res.result.tenaga_kerja);
                $(".periode_name").html(res.result.periode_active_name);
                vertikal_chart_load(res.result.entitas,"#entitas_chart");
                vertikal_chart_load(res.result.project,"#entitas_project");
                vertikal_chart_load(res.result.job,"#job_chart");
                vertikal_chart_load(res.result.segmen,"#segmen_dt");
                // chart_load(res.result.segmen,"#segmen_dt","segmen_dt");
                // chart_load(res.result.entitas,"#entitas_chart","entita");
                // chart_load(res.result.project,"#entitas_project","project");
                // chart_load(res.result.job,"#job_chart","job");
                
            },
            error : function(er){
                console.log(er)
            }

        })
    }

    vertikal_chart_load = function(result,id){
        
        if(id in charts){
            console.log(charts[id]);
            charts[id].destroy();
        }else{
            console.log("null")
            
        }
        
        const config = {
            type: 'bar',
            data: result,
            options: {
                indexAxis: 'y',
                // Elements options apply to all of the options unless overridden in a dataset
                // In this case, we are setting the border of each horizontal bar to be 2px wide
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Horizontal Bar Chart'
                    }
                }
            },
        };
        var barChartCanvas = $(id).get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var barChart = new Chart(barChartCanvas,config);
        charts[id] = barChart;
    }

    chart_load = function(result,id,box){
        
        if(id in charts){
            console.log(charts[id]);
            charts[id].destroy();
        }else{
            console.log("null")
            
        }
        
        var doughnutPieData = {
            
            datasets: [{
                data: result.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(29, 252, 21, 0.5)',
                    'rgba(198, 21, 252, 0.5)',
                    'rgba(252, 21, 202, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(29, 252, 21, 1)',
                    'rgba(198, 21, 252, 1)',
                    'rgba(252, 21, 202, 1)'
                ],
            }],
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: result.label
        };
        var doughnutPieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };
        var pieChartCanvas = $(id).get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: doughnutPieData,
            options: doughnutPieOptions
        });
        charts[id] = pieChart;
    }

    
</script>
@endsection