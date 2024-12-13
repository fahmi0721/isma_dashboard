@extends("template.purple.index")
@section("page-title", "DATA RKAP | MONITORING")
@section("page-header")
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-bulletin-board"></i>
    </span> RKAP
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <!-- <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li> -->
        <li class="breadcrumb-item active" aria-current="page">RKAP </li>
    </ul>
    </nav>
</div>
<div class="row">
    <div class='col-12'>
        <div class='pull-right' style='margin-bottom:5px'>
            <a href="{{ route('rkap.form-tambah') }}" class="btn btn-gradient-info btn-icon-text" data-bs-toggle='tooltip' title='Tambah Data'>
                <i class="mdi mdi-plus-box btn-icon-prepend"></i>
                <span> Tambah</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
    <h4 class="card-title">RKAP</h4>
    <div class="row">
        <div class="col-12 table-responsive">
            <table id="data" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th width='5%'>No</th>
                    <th>Tahun</th>
                    <th>Pendapatan</th>
                    <th>Biaya</th>
                    <th>Laba Rugi</th>
                    <th width='5%'>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    </div>
</div>
@endsection

@section('konten')

@endsection


@section('script')
<script>
    function delete_data(id) {
        swal({
            title 	: 'Konfirmasi Hapus!',
            text  	: "apakah anda yakin ingin menghapus data ini?",
            icon 	: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            dangerMode: false,
            showLoaderOnConfirm :true,
            buttons: {
                cancel: {
                    text: "Tidak",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                },
                confirm: {
                    text: "Ya",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            }
        }).then((isConfirm) => {
            if (isConfirm) {
                $.ajax({
                    type	: "DELETE",
                    dataType: "json",
                    url		: "{{ route('rkap.delete') }}?id="+id,
                    data	: "_method=DELETE&_token={{ csrf_token() }}",
                    success	:function(result) {
                        if(result.status == "success"){
                            position = "bottom-left";
                            icons = result.status;
                            pesan = result.messages;
                            title = "Deleted!";
                            info(title,pesan,icons,position);
                            $("#btn-submit").html("<i class='mdi mdi-content-save btn-icon-prepend'></i> SUBMIT")
                            $("#btn-submit").prop("disabled",false);
                            $('#data').DataTable().ajax.reload();
                            
                        }
                    },
                    error: function(e){
                        pesan_error(e,'bottom-left');
                    }
                });
            }
        });
    }

    
    $(function() {
       $('#data').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: "{{ route('rkap') }}",
            columns: [
                { data: 'id', className: "text-center", "orderable": false, 'searchable':false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'tahun', name: 'tahun'},
                { data: 'pendapatan', name: 'pendapatan',render: function (data, type, row, meta) {
                    let pendapatan = numberof(row.pendapatan);
                    return pendapatan;
                }},
                { data: 'biaya', name: 'biaya',render: function (data, type, row, meta) {
                    let biaya = numberof(row.biaya);
                    return biaya;
                }},
                { data: 'laba_rugi', name: 'laba_rugi',render: function (data, type, row, meta) {
                    let laba_rugi = numberof(row.laba_rugi);
                    return laba_rugi;
                }},
                { data: 'id', name: 'aksi',"orderable": false, className: "text-center", 'searchable':false, render: function (data, type, row, meta) {
                    let aksi = "<a class='badge badge-pill badge-primary' data-bs-toggle='tooltip' href='{{ route('rkap.form-edit') }}?id="+row.id+"' title='Edit Data'><i class='mdi mdi-tooltip-edit'></i></a> <a class='badge badge-pill badge-danger' data-bs-toggle='tooltip' onclick=\"delete_data('"+row.id+"')\" title='Hapus Data'><i class='fa fa-trash'></i></a>";
                    
                    return aksi;
                }},
            ],
            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });
        
        $('#data').each(function() {
            var datatable = $(this);
            var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
            search_input.attr('placeholder', 'Search');
            var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
            length_sel.removeClass('form-control-sm');
        });
    });
</script>
@endsection