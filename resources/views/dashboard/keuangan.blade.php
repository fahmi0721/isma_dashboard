@extends("template.purple.index")
@section("page-title", "DASHBOARD KEUANGAN | MONITORING")
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="fa fa-dashboard"></i>
    </span> Dashboard Keuangan
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard Keuangan </li>
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
        <div class="card-col col-xl-4 col-lg-4 col-md-4 col-6 border-right">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-money text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">Laba Rugi</p>
                <div class="fluid-container">
                    <h3 class="mb-0 font-weight-medium"><span id='c_laba_rugi'>{{ $data['pbl']->laba_rugi }}</span> M</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-col col-xl-4 col-lg-4 col-md-4 col-6 border-right">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-money text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">Pendapatan</p>
                <div class="fluid-container">
                <h3 class="mb-0 font-weight-medium"><span id='c_pendapatan'>{{ $data['pbl']->pendapatan }}</span> M</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-col col-xl-4 col-lg-4 col-md-4 col-6">
            <div class="card-body">
            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                <i class="fa fa-money text-primary me-0 me-sm-4 icon-lg"></i>
                <div class="wrapper text-center text-sm-left">
                <p class="card-text mb-0">Biaya</p>
                <div class="fluid-container">
                <h3 class="mb-0 font-weight-medium"><span id='c_biaya'>{{ $data['pbl']->biaya }}</span> M</h3>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Laba Rugi Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
                <canvas id="laba_chart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pendapatan & Biaya Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
                <canvas id="pb_chart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class='row'>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Laba Rugi Berdasarkan Project Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
            <div id="box_job"><canvas id="laba_project"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pendapatan Berdasarkan Project Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
                <div id="box_segmen"><canvas id="pendapatan_project"></canvas></div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Biaya Berdasarkan Project Periode <span class='periode_name'>{{ $data['periode_active_name'] }}</span></h5>
                <div id="box_segmen"><canvas id="biaya_project"></canvas></div>
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
            url : "{{ route('dashboard.keuangan') }}",
            data	: "_token={{ csrf_token() }}&periode_id="+periode_id,
            success: function(res){
                console.log(res.result)
                $("#c_laba_rugi").html(res.result.pbl.laba_rugi);
                $("#c_pendapatan").html(res.result.pbl.pendapatan);
                $("#c_biaya").html(res.result.pbl.biaya);
                bar_chart(res.result.laba_rugi,"#laba_chart");
                bar_chart(res.result.pb,"#pb_chart");
                bar_chart(res.result.laba_rugi_project,"#laba_project");
                bar_chart(res.result.pendapatan_project,"#pendapatan_project");
                bar_chart(res.result.biaya_project,"#biaya_project");
            },
            error : function(er){
                console.log(er)
            }

        })
    }

    bar_chart = function(result,id){
        if(id in charts){
            console.log(charts[id]);
            charts[id].destroy();
        }else{
            console.log("null")
            
        }
        const data = {
            labels: result.labels,
            datasets:result.dataset
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

        var barChartCanvas = $(id).get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: data,
            options: config
        });
        charts[id] = barChart;
    }


    
</script>
@endsection