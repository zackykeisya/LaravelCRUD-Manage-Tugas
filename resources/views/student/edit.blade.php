@extends('template.app')


@section('content-dinamis')
    <main class="main container" id="main"> 
        <form action="{{ route('data_siswa.ubah.proses', $student['id'])}}" method="POST" class="card p-5">
            @csrf
            @method('PATCH')
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
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $student['name'] }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rombel" class="col-sm-2 col-form-label">Rombel : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $student['rombel'] }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deadline" class="col-sm-2 col-form-label">Deadline : </label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $student['deadline']}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="namatugas" class="col-sm-2 col-form-label">namatugas :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namatugas" name="namatugas" value="{{  $student['namatugas'] }}">
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
@endpush
@endsection
