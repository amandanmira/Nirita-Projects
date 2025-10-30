@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Syarat Dan Ketentuan Baru</h2>

        <form action="{{ route('admin.snk.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <textarea name="judul" id="judul" rows="4" class="form-control" required></textarea>
                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required></textarea>
                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.snk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsi', {
            extraPlugins: 'indent,removeformat',
            toolbar: [
                { name: 'basicstyles', items: ['RemoveFormat', '-', 'Bold', 'Italic', 'Underline', 'Strike'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                { name: 'clipboard', items: ['Undo', 'Redo'] },
            ],
            removePlugins: 'image,link,table,about,styles,sourcearea,update-notifier',
        });

        const observer = new MutationObserver(() => {
            const notif = document.getElementById('cke_notifications_area_deskripsi');
            if (notif) notif.remove();
        });

        console.log(Object.keys(CKEDITOR.plugins.registered));

        observer.observe(document.body, { childList: true, subtree: true });
    </script>
@endsection