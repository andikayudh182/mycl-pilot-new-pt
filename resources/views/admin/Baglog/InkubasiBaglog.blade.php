@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monitoring Inkubasi Baglog</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <h3>Data Kartu Kendali</h3>
    <table class="table m-3">
        <tr>
            <th>Kode Produksi</th>
            <th>Tanggal Pembibitan</th>
            <th>Tanggal Crushing</th>
            <th>Status Crushing</th>
            <th>Tanggal Harvest</th>
            <th>Jumlah Baglog</th>
            <th>In Stock</th>
        </tr>
        @foreach ($Pembibitan as $data )
        <tr>
            <td><?php echo $data['KodeProduksi'];?></td>
            <td><?php echo $data['TanggalPengerjaan'];?></td>
            <td><?php echo $data['TanggalCrushing'];?></td>
            @if ($data['StatusCrushing']=='0')
                <td>Belum di crushing</td>
            @else
                <td>Sudah di crushing</td>
            @endif
            <td><?php echo $data['TanggalPanen'];?></td>
            <td><?php echo $data['JumlahBaglog'];?></td>
            <?php
            $JumlahKonta = '0';
            ?>
            @if (isset($Kontaminasi[$data['KodeProduksi']]))
                @foreach ($Kontaminasi[$data['KodeProduksi']] as $key )
                    <?php
                        $JumlahKonta  = $JumlahKonta + $key['JumlahKonta'];
                    ?>                    
                @endforeach
            @endif
            <td><?php echo $data['JumlahBaglog']-$JumlahKonta;?></td>
            <td><a href="{{ url('admin/baglog/inkubasi-baglog/konta', ['id'=>$data['id'],])}}">Kontaminasi</a></td>
            <td><a href="{{ url('admin/baglog/inkubasi-baglog/crushing', ['id'=>$data['id'],])}}">Crushing</a></td>
            <td><a href="{{ url('admin/baglog/inkubasi-baglog/undo-crushing', ['id'=>$data['id'],])}}">Undo Crushing</a></td>
            <td><a href="{{ url('admin/baglog/inkubasi-baglog/panen', ['id'=>$data['id'],])}}">Selesai</a></td>
        </tr>  
        @endforeach

    </table>
</section>
@endsection