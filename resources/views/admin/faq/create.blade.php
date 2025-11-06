@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah FAQ Baru</h2>

        <form action="{{ route('admin.faq.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                <textarea name="pertanyaan" id="pertanyaan" rows="4" class="form-control" required></textarea>
                @error('pertanyaan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="jawaban" class="form-label">Jawaban</label>
                <textarea name="jawaban" id="jawaban" rows="4" class="form-control" required></textarea>
                @error('jawaban') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('jawaban', {
            extraPlugins: 'indent,removeformat',
            toolbar: [
                { name: 'basicstyles', items: ['RemoveFormat', '-', 'Bold', 'Italic', 'Underline', 'Strike'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                { name: 'clipboard', items: ['Undo', 'Redo'] },
            ],
            removePlugins: 'image,link,table,about,styles,sourcearea,update-notifier',
        });

        const observer = new MutationObserver(() => {
            const notif = document.getElementById('cke_notifications_area_jawaban');
            if (notif) notif.remove();
        });

        console.log(Object.keys(CKEDITOR.plugins.registered));

        observer.observe(document.body, { childList: true, subtree: true });
    </script>
@endsection