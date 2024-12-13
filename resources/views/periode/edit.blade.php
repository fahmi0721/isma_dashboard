@extends("template.purple.index")
@section("page-title", "EDIT DATA PERIODE | MONITORING")
@section('custom_css')
<style>
    div.datepicker-days {
        /* display: none; */
        }
    div.datepicker-months {
        display: block;
    }
    .ui-widget {
        font-size:.7em;
    }
</style>
@endsection
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi mdi-calendar-multiple"></i>
    </span> Priode
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <!-- <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li> -->
        <li class="breadcrumb-item"><a href="{{ route('periode') }}">Periode</a> </li>
        <li class="breadcrumb-item active" aria-current="page">Edit </li>
    </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data</h4>
                <p class="card-description"> Edit dana periode </p>
                <form class="forms-sample" id="form_data" action="javascript:void(0)">
                    @csrf
                    @method("put")
                    <input type="hidden" value="{{ $data->id }}" id="id" name="id">
                    <div class="form-group">
                        <label for="periode">Priode</label>
                        <input type="text" class="form-control" value="{{ $data->nama }}" autocomplete="off"  maxlength="15" name='periode' id="periode" placeholder="Periode">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea type="text" maxlength="100" class="form-control" name='keterangan' id="keterangan" placeholder="Keterangan">{{ $data->keterangan }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2" id='btn-submit'><i class="mdi mdi-content-save btn-icon-prepend"></i> Submit</button>
                    <a href="{{ route('periode') }}" class="btn btn-light"><i class="mdi mdi-reply btn-icon-prepend"></i> Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('konten')

@endsection


@section('script')
<script>
    proses_data = function(){
        var iData = $("#form_data").serialize();
        $.ajax({
            type    : "POST",
            url     : "{{ route('periode.update') }}",
            data    : iData,
            chace   : false,
            beforeSend  : function (){
                $("#btn-submit").html("<i class='fa fa-spinner fa-spin btn-icon-prepend'></i>  SUBMIT..")
                $("#btn-submit").prop("disabled",true);
            },
            success: function(result){
                if(result.status == "success"){
                    position = "bottom-left";
                    icons = result.status;
                    pesan = result.messages;
                    title = "Updated";
                    info(title,pesan,icons,position);
                    $("#btn-submit").html("<i class='mdi mdi-content-save btn-icon-prepend'></i> SUBMIT")
                    $("#btn-submit").prop("disabled",false);
                    setTimeout(() => {
                        window.location = "{{ route('periode') }}";
                    }, 1000);
                    
                }
            },
            error: function(e){
                console.log(e)
                $("#btn-submit").html("<i class='mdi mdi-content-save btn-icon-prepend'></i> SUBMIT")
                $("#btn-submit").prop("disabled",false);
                pesan_error(e,'bottom-left');
            }
        })
    }

    $(function() {
        validasi();
        $("#form_data").submit(function(e){
            e.preventDefault();
            proses_data();
        });
        // $("#periode").monthYearPicker()
        $("#periode").datepicker({
            changeMonth: true,    // Allow month selection
            changeYear: true,     // Allow year selection
            showButtonPanel: true,
            autoclose:true,
            format: 'yyyy-mm',  // Format to show year and month
            orientation: "bottom"
        });
        
    });

    function validasi(){
        var id_form = ["#periode","#keterangan"];
        id_form.forEach(element => {
            validasi_maksimal_karaker(element);
        });
    }
</script>
@endsection