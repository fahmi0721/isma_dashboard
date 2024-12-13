@extends("template.purple.index")
@section("page-title", "EDIT DATA PROJECT | MONITORING")
@section('custom_css')

@endsection
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-application"></i>
    </span>Project
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <!-- <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li> -->
        <li class="breadcrumb-item"><a href="{{ route('project') }}">Project</a> </li>
        <li class="breadcrumb-item active" aria-current="page">Edit </li>
    </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data</h4>
                <p class="card-description"> Edit data project </p>
                <form class="forms-sample" id="form_data" action="javascript:void(0)">
                    @csrf
                    @method("put")
                    <input type="hidden" value="{{ $data['project']->id }}" name="id" id="id">
                    <div class="form-group">
                        <label for="kode_project">Kode Project</label>
                        <input type="text" class="form-control" value="{{ $data['project']->kode }}" maxlength="50" name='kode_project' id="kode_project" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" value="{{ $data['project']->nama }}"  maxlength="100" name='nama' id="nama" placeholder="Nama">
                    </div>

                    <div class="form-group">
                        <label for="nama">Entitas</label>
                        <select class="form-control entitas" id="entitas" name='entitas' style="width:100%">
                            <option></option>
                        @foreach($data['entitas'] as $entitas)
                            <option value="{{ $entitas->id }}" @if($data['project']->entitas_id == $entitas->id) selected @endif >{{ $entitas->nama }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama">Kategori Project</label>
                        <select class="form-control kategori_project" id="kategori_project" name='kategori_project' style="width:100%">
                            <option></option>
                        @foreach($data['kategori_project'] as $kategori_project)
                            <option value="{{ $kategori_project->id }}"  @if($data['project']->kategori_id == $kategori_project->id) selected @endif>{{ $kategori_project->nama }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" maxlength="100" class="form-control" name='deskripsi' id="deskripsi" placeholder="Deskripsi">{{ $data['project']->deskripsi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="valid">Valid</label>
                        <div class="input-group">
                            <input type="text" maxlength="10" value="{{ $data['project']->valid_from }}" autocomplete=off class="form-control" name='valid_from' id="valid_from" placeholder="Valid From">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='fa fa-calendar-o'></i></span>
                            </div>
                            <input type="text" maxlength="10" class="form-control" value="{{ $data['project']->valid_to }}"  name='valid_to' id="valid_to" placeholder="Valid To">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-gradient-primary me-2" id='btn-submit'><i class="mdi mdi-content-save btn-icon-prepend"></i> Submit</button>
                    <a href="{{ route('project') }}" class="btn btn-light"><i class="mdi mdi-reply btn-icon-prepend"></i> Kembali</a>
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
        var startDate;
        var endDate;        
        select_option(".entitas","Pilih data entitas");
        select_option(".kategori_project","Pilih data kategori project");
        $("#valid_to").datepicker({
            changeMonth: true,    // Allow month selection
            changeYear: true,     // Allow year selection
            autoclose:true,
            starDate : new Date("{{ $data['project']->valid_from }}"),
            format: 'yyyy-mm-dd',  // Format to show year and month
            startDate: '+0d'
        }).on('changeDate', function(selected) {
            endDate = selected.date;
            $('#valid_from').datepicker('setEndDate', endDate); // Set the maximum date for start date;
        });

        $("#valid_from").datepicker({
            changeMonth: true,    // Allow month selection
            changeYear: true,     // Allow year selection
            autoclose:true,
            endDate : new Date("{{ $data['project']->valid_to }}"),
            format: 'yyyy-mm-dd',  // Format to show year and month
        }).on("changeDate", function (e) {
            startDate = e.date;
            $('#valid_to').datepicker("setStartDate", startDate);
        });
        
        
    })


    proses_data = function(){
        var iData = $("#form_data").serialize();
        $.ajax({
            type    : "POST",
            url     : "{{ route('project.update') }}",
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
    });

    function validasi(){
        var id_form = ["#nama","#deskripsi","#kode_project","#valid_from","#valid_to"];
        id_form.forEach(element => {
            validasi_maksimal_karaker(element);
        });
    }
</script>
@endsection