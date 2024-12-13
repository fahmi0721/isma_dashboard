@extends("template.purple.index")
@section("page-title", "TAMBAH DATA USER| MONITORING")
@section('custom_css')

@endsection
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="fa fa-user"></i>
    </span>User
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <!-- <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li> -->
        <li class="breadcrumb-item"><a href="{{ route('user') }}">User</a> </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah </li>
    </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data</h4>
                <p class="card-description"> Tambah data user </p>
                <form class="forms-sample" id="form_data" action="javascript:void(0)" autocomplete="off">
                    @csrf
                    @method("post")
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control"  maxlength="50" name='nama' id="nama" placeholder="Nama">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control"  maxlength="50" name='email' id="email" placeholder="Email"  autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control level" id="level" name='level' style="width:100%">
                            <option></option>
                            <option value='admin'>Admin</option>
                            <option value='user'>User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" autocomplete="off" class="form-control"  maxlength="100" name='password' id="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Komfirmasi Password</label>
                        <input type="password" class="form-control"  maxlength="100" name='password_confirmation' id="password_confirmation" placeholder="Komfirmasi Password">
                    </div>


                    <button type="submit" class="btn btn-gradient-primary me-2" id='btn-submit'><i class="mdi mdi-content-save btn-icon-prepend"></i> Submit</button>
                    <a href="{{ route('user') }}" class="btn btn-light"><i class="mdi mdi-reply btn-icon-prepend"></i> Kembali</a>
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
        select_option(".level","Pilih Level User");
    })
    proses_data = function(){
        var iData = $("#form_data").serialize();
        $.ajax({
            type    : "POST",
            url     : "{{ route('user.save') }}",
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
        var id_form = ["#nama","#email","#password","#password_confirmation"];
        id_form.forEach(element => {
            validasi_maksimal_karaker(element);
        });
    }
</script>
@endsection