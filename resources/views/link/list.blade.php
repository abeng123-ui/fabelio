@extends('layouts.master')

@section('content')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div style="background-color:#cde0f7 " class="card-header">
                    <strong class="card-title">List of All Submitted Links</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="width:100%" id='bootstrap-data-table-export' class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; ?>
                            @foreach($data as $row)
                                <tr>
                                    <th scope="row">{{ $x }}</th>
                                    <td><a href="{{url('link/detail')}}/{{$row->id}}">{{ $row->product_name }}</a></td>
                                    <td><?php echo number_format($row->price_value) ?></td>
                                    <td>{{ $row->price_currency }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ $row->url }}</td>
                                    <td>{{ $row->created_at }}</td>
                                </tr>

                                <?php $x++; ?>

                            @endforeach
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
