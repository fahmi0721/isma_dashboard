@extends("template.purple.index")
@section("page-title", "EDIT DATA JUMLAH TENAGA KERJA | MONITORING")
@section('custom_css')

@endsection
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="fa fa-users"></i>
    </span>Jumlah Tenaga Kerja
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <!-- <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li> -->
        <li class="breadcrumb-item"><a href="{{ route('tenaga_kerja') }}">Jumlah Tenaga Kerja</a> </li>
        <li class="breadcrumb-item active" aria-current="page">Edit </li>
    </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data </h4>
                <p class="card-description"> Edit data jumlah tenaga kerja </p>
                <form class="forms-sample" id="form_data" action="javascript:void(0)">
                    @csrf
                    @method("put")
                    <input type="hidden" value="{{ $data['tenaga_kerja']->id }}" id="id" name="id">
                    <div class="form-group">
                        <label for="nama">Project</label>
                        <select class="form-control project" id="project" name='project' style="width:100%">
                            <option></option>
                        @foreach($data['project'] as $project)
                            <option value="{{ $project->id }}" @if($data['tenaga_kerja']->project_id == $project->id) selected @endif>{{ $project->kode }} - {{ $project->nama }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="job">Jabatan</label>
                        <select class="form-control jabatan" id="job" name='job' style="width:100%">
                            <option></option>
                        @foreach($data['job'] as $job)
                            <option value="{{ $job->id }}" @if($data['tenaga_kerja']->job_id == $job->id) selected @endif>{{ $job->nama }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jabatan_tipe">Jabatan Tipe</label>
                        <select class="form-control jabatan_tipe" disabled id="jabatan_tipe" name='jabatan_tipe' style="width:100%">
                            <option></option>
                            <option value="{{ $data['job_type']->nama }}" selected>{{ $data['job_type']->nama }}</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="jumlah_tenaga_kerja">Jumlah Tenaga Kerja</label>
                        <input type="text" class="form-control" value="{{ $data['tenaga_kerja']->jumlah_tk }}" maxlength="10" name='jumlah_tenaga_kerja' id="jumlah_tenaga_kerja" placeholder="Jumlah Tenaga Kerja">
                    </div>


                    <button type="submit" class="btn btn-gradient-primary me-2" id='btn-submit'><i class="mdi mdi-content-save btn-icon-prepend"></i> Submit</button>
                    <a href="{{ route('tenaga_kerja') }}" class="btn btn-light"><i class="mdi mdi-reply btn-icon-prepend"></i> Kembali</a>
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
        select_option(".jabatan","Pilih data jabatan");
        select_option(".jabatan_tipe","Pilih data tipe jabatan");
        $("#jumlah_tenga_kerja").keyup(function(e){
            $(this).val(numberof($(this).val()));
        });
    })

    $("#job").on("change", function(){
        let job_id = $(this).val();
        $.ajax({
            type    : "GET",
            dataType : "json",
            url     : "{{ route('tenaga_kerja.job_type') }}?job_id="+job_id,
            success : function(res){
                $("#jabatan_tipe").html("<option value='"+res.nama+"' selected>"+res.nama+"</option");
            },
            error   : function(er){
                console.log(er)
                pesan_error(er,'bottom-left');
            }
        })
    })

    proses_data = function(){
        var iData = $("#form_data").serialize();
        $.ajax({
            type    : "POST",
            url     : "{{ route('tenaga_kerja.update') }}",
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
        var id_form = ["#jumlah_tenga_kerja"];
        id_form.forEach(element => {
            validasi_maksimal_karaker(element);
        });
    }
</script>
@endsection