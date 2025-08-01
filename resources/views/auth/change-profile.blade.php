@extends('layouts.home')

@section('container')
    @if (session('success'))
        <div class="alert alert-success floating-alert fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <style>
        .modal-backdrop {
            display: none !important;
        }

        .crop-container {
            width: 100%;
            max-width: 200px;
            /* Pastikan area crop besar */
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
    </style>

    <h2 class="mb-4">Ganti Foto Profil</h2>

    <img src="{{ auth()->user()->profilePhotoUrl }}" alt="Profile Photo" class="rounded-circle mb-3 border border-primary"
        style="width: 100px; height: 100px;">

    <form id="profile-form" action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" id="profile-photo" name="profile_photo" accept="image/*">

        <!-- Tempat Preview Setelah Crop -->
        <div>
            <img id="final-preview" class="mt-2"
                style="max-width: 100px; height: 100px; display: none; border-radius: 50%; border: 2px solid blue;">
        </div>

        <!-- Tombol untuk Submit -->
        <button type="submit" class="btn btn-primary mt-2">Upload</button>

        <!-- Hidden Input untuk menyimpan gambar hasil crop -->
        <input type="hidden" name="cropped_image" id="cropped-image">
    </form>

    <!-- Modal untuk Cropper -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- Gunakan modal-xl agar lebih besar -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Crop Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <div class="crop-container">
                        <img id="crop-image" style="width: 100%; display: block;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="crop-btn" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script>
        document.getElementById('MenuKanan').style.display = 'none';
        let cropper;
        const input = document.getElementById('profile-photo');
        const modal = new bootstrap.Modal(document.getElementById('cropModal'));
        const cropImage = document.getElementById('crop-image');
        const finalPreview = document.getElementById('final-preview');
        const cropBtn = document.getElementById('crop-btn');
        const croppedImageInput = document.getElementById('cropped-image');

        input.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    cropImage.src = e.target.result;
                    modal.show();

                    // Tunggu gambar muncul sebelum inisialisasi cropper
                    cropImage.onload = function() {
                        if (cropper) {
                            cropper.destroy();
                        }

                        // Inisialisasi Cropper.js dengan area besar
                        cropper = new Cropper(cropImage, {
                            aspectRatio: 1, // Kotak (1:1)
                            viewMode: 1, // Pastikan agar lebih fleksibel dalam crop
                            autoCropArea: 1, // Gunakan area penuh modal
                            responsive: true,
                            scalable: true, // Bisa diperbesar dan diperkecil
                            zoomable: true // Bisa di-zoom
                        });
                    };
                };
                reader.readAsDataURL(file);
            }
        });

        // Tombol Crop
        cropBtn.addEventListener('click', function() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 400, // Perbesar hasil crop
                    height: 400
                });

                // Tampilkan preview hasil crop
                finalPreview.src = canvas.toDataURL('image/jpeg');
                finalPreview.style.display = 'block';

                // Simpan hasil crop di input hidden untuk dikirim ke server
                croppedImageInput.value = canvas.toDataURL('image/jpeg');

                // Tutup modal
                modal.hide();
            }
        });
    </script>
@endsection
