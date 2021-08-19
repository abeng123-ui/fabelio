@extends('layouts.master')

@section('content')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div style="background-color:#cde0f7" class="card-header">
                    <strong class="card-title">Product Detail</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="width:100%" id='bootstrap-data-table-export' class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>{{ $result['product_name'] }}</td>
                                    <td align="right">{{ $result['price'] }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <img src="{{$result['image']}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">{{ $result['header'] }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        @foreach($result['header_desc'] as $row)
                                            {!! $row !!}
                                        @endforeach

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div><!-- .animated -->

@push('scripts')
<script type="text/javascript">
    // $(document).ready( function () {
    //     // $('#id_kopi').DataTable();
    //     var table = $('#tb_ini').DataTable({
    //      // "order": [[ 1, "desc" ]],
    //      "aLengthMenu": [10, 25, 50, 100],

    //    });

    //     $('#tb_ini tfoot th').each( function () {
    //         var title = $(this).text();
    //         $(this).html( '<input type="text" placeholder="Cari '+title+'" />' );

    //         var table = $('#tb_ini').DataTable();
    //         table.columns().every( function () {
    //         var that = this;

    //         $( 'input', this.footer() ).on( 'keyup change', function () {
    //             if ( that.search() !== this.value ) {
    //                 that
    //                     .search( this.value )
    //                     .draw();
    //                 }
    //             } );
    //         } );

    //     } );
    // });
</script>
@endpush

@endsection
