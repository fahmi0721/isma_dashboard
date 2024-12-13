@extends("template.purple.index")
@section("page-title", "TAMBAH DATA PBL | MONITORING")
@section('custom_css')

@endsection
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="fa fa-users"></i>
    </span>PBL
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <!-- <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li> -->
        <li class="breadcrumb-item"><a href="{{ route('pbl') }}">PBL</a> </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah </li>
    </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data </h4>
                <p class="card-description"> Tambah data PBL </p>
                <form class="forms-sample" id="form_data" action="javascript:void(0)">
                    @csrf
                    @method("post")
                    <div class="form-group">
                        <label for="nama">Periode</label>
                        <input type="text" class="form-control" disabled value="{{ $data['periode'] }}"  maxlength="100" name='periode' id="periode" placeholder="Periode">
                    </div>
                    <div class="form-group">
                        <label for="nama">Project</label>
                        <select class="form-control project" id="project" name='project' style="width:100%">
                            <option></option>
                        @foreach($project as $projects)
                            <option value="{{ $projects->id }}">{{ $projects->kode }} - {{ $projects->nama }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pendapatan">Pendapatan</label>
                        <input type="text" class="form-control"  maxlength="20" name='pendapatan' id="pendapatan" placeholder="Pendapatan">
                    </div>

                    <div class="form-group">
                        <label for="biaya">Biaya</label>
                        <input type="text" class="form-control"  maxlength="20" name='biaya' id="biaya" placeholder="Biaya">
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2" id='btn-submit'><i class="mdi mdi-content-save btn-icon-prepend"></i> Submit</button>
                    <a href="{{ route('pbl_project') }}" class="btn btn-light"><i class="mdi mdi-reply btn-icon-prepend"></i> Kembali</a>
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
        select_option(".project","Pilih data project");
        @if($periode == 0)
            var position = "bottom-left";
            var icons = "info";
            var pesan = "Data Periode belum ada yang aktif";
            var title = "Perhatian!";
            info(title,pesan,icons,position);
            setTimeout(() => {
                window.location = "{{ route('periode') }}";
            }, 2000);
        @endif
        validate_number();
    })

    validate_number = function(){
        var ids = ["#pendapatan","#biaya"];
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
            url     : "{{ route('pbl_project.save') }}",
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
        var id_form = ["#pendapatan","biaya"];
        id_form.forEach(element => {
            validasi_maksimal_karaker(element);
        });
    }
</script>
@endsection