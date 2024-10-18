@extends('template.app')

@section('content-dinamis')
    <main class="main container" id="main"> 
        <div class="container mt-1">
            <div class="d-flex justify-content-end">
                <form class="d-flex me-3 mb-0" action="{{ route('data_siswa.data') }}" method="GET">
                    <input type="text" name="cari" placeholder="Cari Nama Tugas ..." class="form-control me-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form> 
            <a href="{{ route('data_siswa.tambah')}}" class="btn btn-success" >+ Tambah pengguna</a>
        </div>
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success')}}
        </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <table class="table table-stripped table-bordered mt-3 text-center">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Deadline</th>
                <th>Nama Tugas</th>
                <th>Aksi</th>
            </thead>

            <tbody>

                <tr>
    
                @foreach ($student as $index => $bagian)
                {{-- "Nomor urut = (Nomor halaman saat ini - 1) x Jumlah data per halaman + (Indeks data + 1)" --}}
                {{-- Nomor urut = (2 - 1) x 10 + (5 + 1) = 1 x 10 + 6 = 16 --}}
                    <td>{{ ($student->currentPage()-1) * ($student->perpage()) + ($index+1) }}</td>
                    <td>{{$bagian['name']}}</td>
                    <td>{{$bagian['rombel']}}</td>
                    <td>
                        <script>
                            // penjelas algoritma hitung mundur adalah
                            CountDownTimer('{{$bagian['deadline']}}', 'countdown-{{ $index }}');
                            function CountDownTimer(dt, id) {
                                var end = new Date(dt);
                                var _second = 1000;
                                var _minute = _second * 60;
                                var _hour = _minute * 60;
                                var _day = _hour * 24;
                                var timer;
                                function showRemaining() {
                                    var now = new Date();
                                    var distance = end - now;
                                    if (distance < 0) {
                                        clearInterval(timer);
                                        document.getElementById(id).innerHTML = '<b>TUGAS SUDAH BERAKHIR</b>';
                                        return;
                                    }
                                    var days = Math.floor(distance / _day);
                                    var hours = Math.floor((distance % _day) / _hour);
                                    var minutes = Math.floor((distance % _hour) / _minute);
                                    var seconds = Math.floor((distance % _minute) / _second);

                                    document.getElementById(id).innerHTML = days + ' days ';
                                    document.getElementById(id).innerHTML += hours + ' hrs ';
                                    document.getElementById(id).innerHTML += minutes + ' mins ';
                                    document.getElementById(id).innerHTML += seconds + ' secs';
                                }
                                timer = setInterval(showRemaining, 1000);
                            }
                        </script>
                        <div id="countdown-{{ $index }}"></div>
                    </td>   
                    <td>{{$bagian['namatugas']}}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('data_siswa.ubah',$bagian['id'])}}" class="btn btn-primary me-2">Edit</a>
                        <button onclick="showModalDelete('{{ $bagian->id}}','{{$bagian->name}}')" class="btn btn-danger">Hapus</button>
                        <!-- <button id="btn-delete" class="btn btn-danger">Hapus</button> -->
                    </td>
                </tr>
    
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end my-3">
                {{ $student->links() }}
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="" class="modal-content" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">HAPUS DATA</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      apakah anda yakin menghapus data siswa ini?? <b id="nama"></b>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    
    </main>




@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
crossorigin="anonymous">
</script>
<script>
    function showModalDelete(id, name) {
        //memasukkan teks dari parameter ke html bagian id="nama_obat"
        $('#nama_siswa').text(name);
        let url = "{{ route('data_siswa.hapus', ':id')}}";
        //isi path dinamis :id dari data parameter id
        url = url.replace(':id', id);
        // action="" di form diisi dengan url diatas
        $('form').attr('action', url);
        //memunculkan modal dengan id="exampleModal"
        $('#exampleModal').modal('show');
    }
    const showSidebar = (toggleId, sidebarId, headerId, mainId  ) =>{
        const toggle = document.getElementById(toggleId),
            sidebar = document.getElementById(sidebarId),
            header = document.getElementById(headerId),
            main = document.getElementById(mainId)
    
        if(toggle && sidebar && header && main){
            toggle.addEventListener('click', ()=>{
                /* Show sidebar */
                sidebar.classList.toggle('show-sidebar')
                /* Add padding header */
                header.classList.toggle('left-pd')
                /* Add padding main */
                main.classList.toggle('left-pd')
            })
        }
    }
    showSidebar('header-toggle','sidebar', 'header', 'main')
    
    /*=============== LINK ACTIVE ===============*/
    const sidebarLink = document.querySelectorAll('.sidebar__list a')
    
    function linkColor(){
        sidebarLink.forEach(l => l.classList.remove('active-link'))
        this.classList.add('active-link')
    }
    sidebarLink.forEach(l => l.addEventListener('click', linkColor))
    
</script>

<script>

</script>
@endpush