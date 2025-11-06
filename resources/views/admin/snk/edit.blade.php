@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Syarat Dan Ketentuan</h2>

        <form action="{{ route('admin.snk.update', $tnc) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <textarea name="judul" id="judul" rows="4" class="form-control" required>{{ $tnc->judul }}</textarea>
                @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control"
                    required>{{ $tnc->deskripsi }}</textarea>
                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
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

            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="{{ route('admin.snk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection