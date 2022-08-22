@extends('layouts.base')
@section('title', 'Simulasi Kelayakan Kredit')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <form action="{{url('nasabah/result-simulasi-kelayakan')}}" method="post" id="form">
                @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select class="form-control jumlahNasabah" name="" id=""
                                        onchange="jumlahNasabah(this.value)">
                                        <option value="" selected disabled>PILIH JUMLAH NASABAH</option>
                                        @for ($i = 1; $i <= 100; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="row appendForm">
                        </div>
                        <div class="float-end">
                            <button type="submit" class="btn btn-lg btn-dark btnHitung hidden"><i class="fas fa-check-circle"></i> Hitung</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function jumlahNasabah(jumlah) {
            $('.appendForm').html('');
            $('.btnHitung').removeClass('hidden');
            for(var i =1; i <= jumlah; i++){
                $('.appendForm').append(`
                <div class="col-sm-6">
                    <hr>
                    <label class="text-dark text-center mb-2"><b>FORM NASABAH KE ${i}</b></label>
                        <div class="form-group">
                                <input type="text"
                                class="form-control mb-4" name="nama_nasabah[]" id="" aria-describedby="helpId" placeholder="Masukan Nama Nasabah">
                        </div>
                        @foreach ($kriteria as $item)
                            @php
                                $name = strtolower($item->kriteria);
                                $name = implode('_', explode(' ', $name));
                                $sub_where = $sub->where('kode', $item->kode);
                            @endphp
                            <div class="form-group mb-4">
                                <select class="form-control kriteriavalue" name="{{ $name }}[]" required id="">
                                    <option value="" selected disabled>{{ $item->kriteria }}</option>
                                    @foreach ($sub_where as $list)
                                        <option value="{{ $list->nilai }}">
                                            {{ $list->sub }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach
                    </div>`);
            }
        }

        $('#form').on('submit', function(){
            $('.btnHitung').addClass('hidden');
        })
    </script>
@endsection
