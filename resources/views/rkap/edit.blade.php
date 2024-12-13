@extends("template.purple.index")
@section("page-title", "EDIT DATA RKAP | MONITORING")
@section('custom_css')

@endsection
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-bulletin-board"></i>
    </span>RKAP
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <!-- <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li> -->
        <li class="breadcrumb-item"><a href="{{ route('rkap') }}">RKAP</a> </li>
        <li class="breadcrumb-item active" aria-current="page">Edit </li>
    </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data </h4>
                <p class="card-description"> Edit data rkap </p>
                <form class="forms-sample" id="form_data" action="javascript:void(0)">
                    @csrf
                    @method("put")
                    <input type="hidden" value="{{ $data->id }}" id="id" name="id">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control" value="{{ $data->tahun }}"  maxlength="4" name='tahun' id="tahun" placeholder="Tahun">
                    </div>

                    <div class="form-group">
                        <label for="pendapatan">Pendapatan</label>
                        <input type="text" class="form-control"  maxlength="20" value="{{ number_format($data->pendapatan,0,',','.') }}" name='pendapatan' id="pendapatan" placeholder="Pendapatan">
                    </div>

                    <div class="form-group">
                        <label for="biaya">Biaya</label>
                        <input type="text" class="form-control"  maxlength="20" name='biaya' value="{{ number_format($data->biaya,0,',','.') }}" id="biaya" placeholder="Biaya">
                    </div>

                    <div class="form-group">
                        <label for="laba_rugi">Laba Rugi</label>
                        <input type="text" class="form-control"  maxlength="20" name='laba_rugi' value="{{ number_format($data->laba_rugi,0,',','.') }}" id="laba_rugi" placeholder="Laba Rugi">
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2" id='btn-submit'><i class="mdi mdi-content-save btn-icon-prepend"></i> Submit</button>
                    <a href="{{ route('rkap') }}" class="btn btn-light"><i class="mdi mdi-reply btn-icon-prepend"></i> Kembali</a>
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
    $(document).ready(function(){
        validate_number();
    })

    validate_number = function(){
        var ids = ["#pendapatan","#biaya","#laba_rugi"];
        ids.forEach(id => {
            $(id).keyup(function(e){
                $(this).val(numberof($(this).val()));
            });
        });
    }

    proses_data = function(){
        var iData = $("#form_data").serialize();
        $.ajax({
            type    : "POST",
            url     : "{{ route('rkap.update') }}",
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
                    title = "Saved!";
                    info(title,pesan,icons,position);
                    $("#btn-submit").html("<i class='mdi mdi-content-save btn-icon-prepend'></i> SUBMIT")
                    $("#btn-submit").prop("disabled",false);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    
                }
            },
            error: function(e){
                console.log(e);
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
    });

    function validasi(){
        var id_form = ["#tahun","#pendapatan","#biaya","#laba_rugi"];
        id_form.forEach(element => {
            validasi_maksimal_karaker(element);
        });
    }
</script>
@endsection