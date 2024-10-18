@extends('template.app')

@section('content-dinamis')
    <main class="main container" id="main"> 
        <form action="{{ route('tugas_umum.tambah.proses')}}" class="card p-5" method="POST">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
                </div>
            </div>
            <div class="mb-3 row">
            <label for="rombel" class="col-sm-2 col-form-label">Rombel : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rombel" name="rombel" value="{{ old('rombel')}}">
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="deadline" class="col-sm-2 col-form-label">Deadline : </label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline')}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="namatugas" class="col-sm-2 col-form-label">namatugas :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namatugas" name="namatugas">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
        </form>
    </main>

    @push('script')
    <script>
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
        // Mengatur waktu akhir perhitungan mundur
        var countDownDate = new Date("Dec 5, 2024 15:37:25").getTime();

        // Memperbarui hitungan mundur setiap 1 detik
        var x = setInterval(function() {

        // Untuk mendapatkan tanggal dan waktu hari ini
        var now = new Date().getTime();
            
        // Temukan jarak antara sekarang dan tanggal hitung mundur
        var distance = countDownDate - now;
            
        // Perhitungan waktu untuk hari, jam, menit dan detik
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
        // Keluarkan hasil dalam elemen dengan id = "demo"
        document.getElementById("timer").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
            
        // Jika hitungan mundur selesai, tulis beberapa teks 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "EXPIRED";
        }
        }, 1000);
        </script>
@endpush
@endsection