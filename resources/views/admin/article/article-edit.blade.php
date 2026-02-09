@extends('admin.layout.main')
@section('title', 'Edit Artikel')

@section('link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom styles untuk CKEditor */
        .ck-editor__editable {
            min-height: 350px !important;
            max-height: 600px;
            font-family: 'Open Sans', sans-serif;
            line-height: 1.6;
        }

        .ck.ck-editor__main>.ck-editor__editable {
            padding: 1.5em;
            background-color: #fff;
            border: 1px solid #e0e0e0 !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        /* Style untuk form */
        #formEditArticle {
            background: linear-gradient(145deg, #ffffff, #f5f7fa);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
            display: block;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        /* Icon input styling */
        .input-icon-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 18px;
            z-index: 10;
            transition: all 0.3s;
        }

        .icon-input {
            padding-left: 45px !important;
            height: 50px;
            font-size: 15px;
            border: 2px solid #e0e6ed;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 8px rgba(0,0,0,0.02);
        }

        .icon-input:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
            background-color: #fff;
        }

        .icon-input:focus + .input-icon {
            color: #4299e1;
        }

        /* Style untuk tombol simpan */
        .btn-save {
            background: linear-gradient(to right, #3182ce, #4299e1);
            color: white;
            border: none;
            padding: 15px 30px;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 25px;
            box-shadow: 0 4px 15px rgba(49, 130, 206, 0.2);
        }

        .btn-save:hover {
            background: linear-gradient(to right, #2c5282, #3182ce);
            box-shadow: 0 6px 20px rgba(49, 130, 206, 0.25);
            transform: translateY(-2px);
        }

        .btn-save:active {
            transform: translateY(1px);
        }

        .btn-save i {
            margin-right: 10px;
            font-size: 1.1em;
        }

        /* Section heading */
        .section-heading {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2d3748;
            display: flex;
            align-items: center;
            position: relative;
            padding-bottom: 10px;
        }

        .section-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #4299e1, #7f9cf5);
            border-radius: 5px;
        }

        .section-heading i {
            margin-right: 10px;
            color: #4299e1;
            font-size: 1.3em;
        }

        /* Card styling */
        .content-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .content-card-header {
            background: linear-gradient(to right, #4299e1, #7f9cf5);
            color: white;
            padding: 20px 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .content-card-header i {
            margin-right: 12px;
            font-size: 1.4em;
        }

        .content-card-body {
            padding: 30px;
            background-color: #fff;
        }

        /* Status badge */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 15px;
        }

        .status-badge.draft {
            background-color: #edf2f7;
            color: #4a5568;
        }

        .status-badge.published {
            background-color: #c6f6d5;
            color: #2f855a;
        }

        /* Original content info */
        .original-info {
            background-color: #f7fafc;
            border-left: 4px solid #4299e1;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 0 8px 8px 0;
        }

        .original-info p {
            margin: 0;
            color: #4a5568;
            font-size: 0.9rem;
        }

        /* thumbnail */
        :root {
            --primary-color: #4299e1;
            --primary-hover: #3182ce;
            --primary-gradient: linear-gradient(135deg, #4299e1 0%, #667eea 100%);
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
            --text-dark: #2d3748;
            --text-muted: #718096;
            --card-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            --border-radius: 12px;
            --transition-speed: 0.3s;
        }

        .control-label {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-dark);
            font-size: 1rem;
            display: block;
        }

        /* Upload Thumbnail Styling */
        .thumbnail-upload-wrapper,
        .current-thumbnail-wrapper {
            position: relative;
            margin-bottom: 20px;
            height: 300px;
        }

        .thumbnail-upload-container,
        .current-thumbnail-container {
            height: 100%;
        }

        .thumbnail-dropzone {
            position: relative;
            height: 100%;
            border: 2px dashed var(--border-color);
            background-color: var(--light-bg);
            border-radius: var(--border-radius);
            transition: all var(--transition-speed) ease;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .thumbnail-dropzone:hover {
            border-color: var(--primary-color);
            background-color: rgba(66, 153, 225, 0.05);
        }

        .thumbnail-dropzone.drag-over {
            border-color: var(--primary-color);
            background-color: rgba(66, 153, 225, 0.1);
            transform: scale(1.02);
        }

        .thumbnail-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .thumbnail-placeholder {
            text-align: center;
            padding: 30px;
            width: 100%;
        }

        .upload-icon-container {
            margin-bottom: 20px;
            width: 80px;
            height: 80px;
            background: rgba(66, 153, 225, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .upload-icon {
            font-size: 36px;
            color: var(--primary-color);
        }

        .upload-text {
            display: flex;
            flex-direction: column;
        }

        .upload-text .primary-text {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .upload-text .secondary-text {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Preview Styling */
        .thumbnail-preview {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: var(--light-bg);
            padding: 20px;
        }

        .thumbnail-preview img {
            max-height: 60%;
            max-width: 70%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .thumbnail-preview img:hover {
            transform: scale(1.05);
        }

        .thumbnail-preview-info {
            margin-top: 15px;
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
            width: 100%;
        }

        #filename-display {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 90%;
            margin: 0 auto;
        }

        #filesize-display {
            font-size: 13px;
        }

        .change-file-tip {
            margin-top: 10px;
            font-size: 13px;
            color: var(--primary-color);
            text-align: center;
            font-style: italic;
        }

        .file-selected-indicator {
            position: absolute;
            bottom: 15px;
            background-color: var(--success-color);
            color: white;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            animation: fadeInUp 0.5s ease forwards;
            box-shadow: 0 3px 10px rgba(72, 187, 120, 0.3);
        }

        .file-selected-indicator i {
            margin-right: 6px;
        }

        /* Current Thumbnail Styling */
        .current-thumbnail-card {
            height: 100%;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all var(--transition-speed) ease;
            background-color: white;
            display: flex;
            flex-direction: column;
        }

        .current-thumbnail-card:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-5px);
        }

        .current-thumbnail-header {
            padding: 15px 20px;
            background-image: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
        }

        .header-icon {
            width: 36px;
            height: 36px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .header-icon i {
            font-size: 16px;
        }

        .header-text {
            font-size: 16px;
            font-weight: 600;
        }

        .current-thumbnail-body {
            flex: 1;
            padding: 1px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: var(--light-bg);
            position: relative;
        }

        /* Container gambar yang fixed size dengan ukuran yang lebih kecil */
        .image-container {
            width: 70%;
            height: 55%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            overflow: hidden;
            background-color: white;
            border-radius: 8px;
            padding: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .current-thumbnail-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .current-thumbnail-image:hover {
            transform: scale(1.05);
        }

        .image-metadata {
            margin-top: auto;
            text-align: center;
            width: 100%;
        }

        .image-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 90%;
            margin: 0 auto;
        }

        .image-dimensions {
            font-size: 13px;
            color: var(--text-muted);
        }

        .current-thumbnail-footer {
            padding: 12px 20px;
            background-color: white;
            border-top: 1px solid var(--border-color);
        }

        .footer-info {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: var(--text-muted);
        }

        .footer-info i {
            color: var(--warning-color);
            margin-right: 8px;
            font-size: 15px;
        }

        /* Upload Status */
        .upload-status {
            margin-top: 15px;
            display: none;
        }

        .thumbnail-progress {
            height: 6px;
            border-radius: 3px;
            overflow: hidden;
            background-color: #e2e8f0;
        }

        .thumbnail-progress .progress-bar {
            background-image: var(--primary-gradient);
            transition: width 0.5s ease;
        }

        .status-text {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            margin-top: 8px;
            color: var(--text-muted);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .pulse-animation {
            animation: pulse 1s ease infinite;
        }

        .fade-in {
            animation: fadeInUp 0.5s ease forwards;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #formEditArticle {
                padding: 20px;
            }

            .content-card-body {
                padding: 20px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="content-card">
                    <div class="content-card-header">
                        <i class="fas fa-edit"></i>
                        <h5 class="mb-0">Edit Artikel</h5>
                        <span class="status-badge published">Diterbitkan: {{ $article->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="content-card-body">
                        <div class="original-info">
                            <p><i class="fas fa-info-circle mr-2"></i> Anda sedang mengedit artikel <strong>{{ $article->title }}</strong> yang dibuat oleh <strong>{{ $article->author }}</strong></p>
                        </div>

                        <form id="formEditArticle" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PATCH">

                            <!-- Judul & Author Section -->
                            <h3 class="section-heading"><i class="fas fa-heading"></i> Informasi Artikel</h3>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Judul Artikel</label>
                                        <div class="input-icon-wrapper">
                                            <input type="text" class="form-control icon-input" name="title" id="title"
                                                value="{{ $article->title }}">
                                            <i class="fas fa-heading input-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="author">Pembuat Artikel</label>
                                        <div class="input-icon-wrapper">
                                            <input type="text" class="form-control icon-input" name="author" id="author"
                                                value="{{ $article->author }}">
                                            <i class="fas fa-user-edit input-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Category and Tags Section -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Kategori Artikel <span class="text-danger">*</span></label>
                                        <div class="input-icon-wrapper">
                                            <select class="form-control icon-input" name="category_id" id="category_id" required>
                                                <option value="">Pilih Kategori...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-tags input-icon"></i>
                                        </div>
                                        <small class="text-muted">Pilih kategori yang sesuai untuk artikel ini</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tags">Tags Artikel</label>
                                        <div class="input-icon-wrapper">
                                            <input type="text" class="form-control icon-input" name="tags" id="tags"
                                                value="{{ $article->tags->pluck('name')->implode(', ') }}"
                                                placeholder="Contoh: kesehatan, jantung, tips">
                                            <i class="fas fa-hashtag input-icon"></i>
                                        </div>
                                        <small class="text-muted">Pisahkan tags dengan koma (contoh: kesehatan, jantung, tips)</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Thumbnail Section -->
                            <h3 class="section-heading"><i class="fas fa-image"></i> Thumbnail Artikel</h3>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="thumbnail" class="control-label">Upload Thumbnail Baru</label>
                                        <div class="thumbnail-upload-wrapper">
                                            <div class="thumbnail-upload-container">
                                                <div class="thumbnail-dropzone" id="thumbnail-dropzone">
                                                    <input type="file" class="thumbnail-input" name="thumbnail" id="thumbnail" accept=".jpg,.jpeg,.png">
                                                    <!-- Area saat belum ada file dipilih -->
                                                    <div class="thumbnail-placeholder">
                                                        <div class="upload-icon-container">
                                                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <span class="primary-text">Klik atau seret gambar ke sini</span>
                                                            <span class="secondary-text">Format: JPG, JPEG, PNG | Maks: 1024 KB</span>
                                                        </div>
                                                    </div>
                                                    <!-- Area setelah file dipilih (preview) -->
                                                    <div class="thumbnail-preview" id="thumbnail-preview-container" style="display:none;">
                                                        <img src="#" alt="Preview" id="thumbnail-preview-image">
                                                        <div class="thumbnail-preview-info">
                                                            <span id="filename-display"></span>
                                                            <span id="filesize-display"></span>
                                                        </div>
                                                        <div class="file-selected-indicator">
                                                            <i class="fas fa-check-circle"></i> File dipilih
                                                        </div>
                                                        <div class="change-file-tip">
                                                            Klik area ini untuk memilih file lain
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upload-status" id="upload-status">
                                                <div class="progress thumbnail-progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="status-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Thumbnail Saat Ini</label>
                                        <div class="current-thumbnail-wrapper">
                                            <div class="current-thumbnail-container">
                                                <!-- Card untuk thumbnail saat ini -->
                                                <div class="current-thumbnail-card">
                                                    <div class="current-thumbnail-header">
                                                        <div class="header-icon">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                        <div class="header-text">
                                                            Thumbnail Artikel Saat Ini
                                                        </div>
                                                    </div>
                                                    <div class="current-thumbnail-body">
                                                        <div class="image-container">
                                                            <img src="{{ asset('images/article/thumbnails/' . $article->thumbnail) }}"
                                                                alt="{{ $article->title }}" class="current-thumbnail-image" id="current-thumbnail-image">
                                                        </div>
                                                        <div class="image-metadata">
                                                            <div class="image-name">{{ $article->thumbnail }}</div>
                                                            <div class="image-dimensions" id="current-dimensions"></div>
                                                        </div>
                                                    </div>
                                                    <div class="current-thumbnail-footer">
                                                        <div class="footer-info">
                                                            <i class="fas fa-info-circle"></i>
                                                            <span>Thumbnail ini akan diganti jika Anda mengunggah yang baru</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Konten Artikel -->
                            <h3 class="section-heading"><i class="fas fa-file-alt"></i> Konten Artikel</h3>
                            <div class="form-group mb-4">
                                <p class="text-muted mb-3">Edit konten artikel sesuai kebutuhan.</p>
                                <textarea name="description" id="description" cols="30" rows="10">{{ $article->description }}</textarea>
                                <div class="small text-muted mt-2">
                                    <i class="fas fa-info-circle mr-1"></i> Perubahan yang Anda buat akan langsung ditampilkan di website
                                </div>
                            </div>

                            <!-- Hidden field untuk menyimpan data CKEditor -->
                            <input type="hidden" id="description_data" name="description_data" value="{{ $article->description }}">

                            <!-- Aksi -->
                            <div class="form-group text-center mt-5">
                                <button type="submit" class="btn-save" id="editArticleButton">
                                    <i class="fas fa-save"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            // Form submit handler
            $('#formEditArticle').on('submit', function(e) {
                e.preventDefault();

                // Disable tombol untuk mencegah submit berulangg
                document.getElementById("editArticleButton").disabled = true;

                try {
                    // Perksa apakahh editor sudah siapp
                    if (!window.editor) {
                        console.error('Editor belum siap');
                        toastr.error("Editor belum siap, silakan muat ulang halaman");
                        document.getElementById("editArticleButton").disabled = false;
                        return;
                    }

                    // Ambil nilai dari inputt
                    let title = $("#title").val();
                    let author = $("#author").val();
                    let category_id = $("#category_id").val();
                    let tags = $("#tags").val();
                    let description = window.editor.getData();

                    console.log('DATA EDITOR:', description);

                    // Valdasi input dasar
                    if (!title || title.trim() === '') {
                        toastr.error("Judul artikel tidak boleh kosong");
                        document.getElementById("editArticleButton").disabled = false;
                        return;
                    }

                    if (!author || author.trim() === '') {
                        toastr.error("Pembuat artikel tidak boleh kosong");
                        document.getElementById("editArticleButton").disabled = false;
                        return;
                    }
                    if (!category_id || category_id === '') {
                        toastr.error("Kategori artikel harus dipilih");
                        document.getElementById("editArticleButton").disabled = false;
                        return;
                    }

                    // Validasi isi editor
                    if (!description || description.trim() === '') {
                        toastr.error("Konten artikel tidak boleh kosong");
                        document.getElementById("editArticleButton").disabled = false;
                        return;
                    }

                    // ID artikel dari URL
                    const articleId = {{ $article->id }};

                    // Siapkan formData dengan APPENDING description
                    const formData = new FormData();
                    formData.append('_token', $('input[name="_token"]').val());
                    formData.append('_method', 'PATCH');
                    formData.append('title', title);
                    formData.append('author', author);
                    formData.append('description', description);
                    formData.append('category_id', category_id);
                    formData.append('tags', tags);

                    // Tambahkan thumbnail jika ada file yang dipilih
                    const thumbnailFile = $('#thumbnail')[0].files[0];
                    if (thumbnailFile) {
                        // Validasi ukuran dan tipe file
                        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                        const maxSizeInBytes = 1 * 1024 * 1024; // 1024 KB

                        if (!allowedExtensions.exec(thumbnailFile.name)) {
                            toastr.error("Thumbnail harus memiliki ekstensi JPG, JPEG, atau PNG");
                            document.getElementById("editArticleButton").disabled = false;
                            return;
                        }

                        if (thumbnailFile.size > maxSizeInBytes) {
                            toastr.error("Ukuran thumbnail maksimal 1024 KB");
                            document.getElementById("editArticleButton").disabled = false;
                            return;
                        }

                        formData.append('thumbnail', thumbnailFile);
                    }

                    // Debug log untuk memastikan data sudah benar ka blm
                    for (let pair of formData.entries()) {
                        console.log(pair[0] + ': ' + (pair[0] === 'description' ?
                            ('[data length: ' + pair[1].length + ', excerpt: ' + pair[1].substring(0, 50) + '...]') :
                            pair[1]));
                    }


                    // Kirim AJAX request
                    $.ajax({
                        url: `/article/${articleId}`,
                        method: "POST", // Gunakan POST dengan _method=PATCH untuk compatibility
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function(xhr) {
                            const csrfToken = $('meta[name=csrf-token]').attr('content');
                            xhr.setRequestHeader('X-CSRF-Token', csrfToken);
                        },
                        success: function(data) {
                            toastr.success(data.message || "Artikel berhasil diperbarui");
                            setTimeout(function() {
                                window.location.href = '/article';
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error response:", xhr.responseJSON);
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                toastr.error(xhr.responseJSON.message);
                            } else {
                                toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                            }
                            document.getElementById("editArticleButton").disabled = false;
                        }
                    });
                } catch (e) {
                    console.error("Terjadi kesalahan:", e);
                    toastr.error("Terjadi kesalahan saat mengedit artikel");
                    document.getElementById("editArticleButton").disabled = false;
                }
            });

            // Pastikan form di-reset saat halaman dimuat
            $('#formEditArticle')[0].reset();

            // Memastikan content editor bisa diambil dengan benar
            window.addEventListener('load', function() {
                setTimeout(function() {
                    if (window.editor) {
                        // Verifikasi konten editor setelah halaman dimuat sepenuhnya
                        console.log('Content editor saat halaman dimuat:', window.editor.getData() ? window.editor.getData().substring(0, 100) + '...' : '(kosong)');
                    }
                }, 1000);
            });

            const {
                ClassicEditor,
                Alignment,
                Autoformat,
                AutoImage,
                AutoLink,
                Autosave,
                BalloonToolbar,
                BlockQuote,
                BlockToolbar,
                Bold,
                Bookmark,
                CKBox,
                CKBoxImageEdit,
                CloudServices,
                Code,
                Emoji,
                Essentials,
                FindAndReplace,
                FontBackgroundColor,
                FontColor,
                FontFamily,
                FontSize,
                GeneralHtmlSupport,
                Heading,
                Highlight,
                HorizontalLine,
                ImageBlock,
                ImageCaption,
                ImageEditing,
                ImageInline,
                ImageInsert,
                ImageInsertViaUrl,
                ImageResize,
                ImageStyle,
                ImageTextAlternative,
                ImageToolbar,
                ImageUpload,
                ImageUtils,
                Indent,
                IndentBlock,
                Italic,
                Link,
                LinkImage,
                List,
                ListProperties,
                Mention,
                PageBreak,
                Paragraph,
                PasteFromOffice,
                PictureEditing,
                RemoveFormat,
                SpecialCharacters,
                SpecialCharactersArrows,
                SpecialCharactersCurrency,
                SpecialCharactersEssentials,
                SpecialCharactersLatin,
                SpecialCharactersMathematical,
                SpecialCharactersText,
                Strikethrough,
                Style,
                Subscript,
                Superscript,
                Table,
                TableCaption,
                TableCellProperties,
                TableColumnResize,
                TableProperties,
                TableToolbar,
                TextTransformation,
                TodoList,
                Underline
            } = window.CKEDITOR;

            const {
                CaseChange,
                ExportPdf,
                ExportWord,
                FormatPainter,
                ImportWord,
                MergeFields,
                MultiLevelList,
                PasteFromOfficeEnhanced,
                SlashCommand,
                TableOfContents,
                Template
            } = window.CKEDITOR_PREMIUM_FEATURES;

            const LICENSE_KEY =
                'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzE4OTExOTksImp0aSI6IjQ3NzhkY2I2LThmN2QtNDEyOS1hOGY4LWY1Mzk5MTBlMGJjMiIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImUwYTY0M2MyIn0.4WjMhpNQyJcK_LIURkyfcjd1iSfxRpibq2W_zDMaW4OfVefXl8A3QlqZw2RtPwisTZYWk98tWpwQL9BRv3x37A';

            const CLOUD_SERVICES_TOKEN_URL =
                'https://gmm6b59nrrc2.cke-cs.com/token/dev/ca836878c23eb2a436262dc41e3dc18c0ce26bad8ea8735dc976e6344f64?limit=10';

            const editorConfig = {
                toolbar: {
                    items: [
                        'insertMergeField',
                        'previewMergeFields',
                        '|',
                        'importWord',
                        'exportWord',
                        'exportPdf',
                        'formatPainter',
                        'caseChange',
                        'findAndReplace',
                        '|',
                        'heading',
                        'style',
                        '|',
                        'fontSize',
                        'fontFamily',
                        'fontColor',
                        'fontBackgroundColor',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'subscript',
                        'superscript',
                        'code',
                        'removeFormat',
                        '|',
                        'emoji',
                        'specialCharacters',
                        'horizontalLine',
                        'pageBreak',
                        'link',
                        'bookmark',
                        'insertImage',
                        'insertImageViaUrl',
                        'ckbox',
                        'insertTable',
                        'tableOfContents',
                        'insertTemplate',
                        'highlight',
                        'blockQuote',
                        '|',
                        'alignment',
                        '|',
                        'bulletedList',
                        'numberedList',
                        'multiLevelList',
                        'todoList',
                        'outdent',
                        'indent',
                        '|',
                        'undo',
                        'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                plugins: [
                    Alignment,
                    Autoformat,
                    AutoImage,
                    AutoLink,
                    Autosave,
                    BalloonToolbar,
                    BlockQuote,
                    BlockToolbar,
                    Bold,
                    Bookmark,
                    CKBox,
                    CKBoxImageEdit,
                    CloudServices,
                    Code,
                    Emoji,
                    Essentials,
                    FindAndReplace,
                    FontBackgroundColor,
                    FontColor,
                    FontFamily,
                    FontSize,
                    GeneralHtmlSupport,
                    Heading,
                    Highlight,
                    HorizontalLine,
                    ImageBlock,
                    ImageCaption,
                    ImageEditing,
                    ImageInline,
                    ImageInsert,
                    ImageInsertViaUrl,
                    ImageResize,
                    ImageStyle,
                    ImageTextAlternative,
                    ImageToolbar,
                    ImageUpload,
                    ImageUtils,
                    Indent,
                    IndentBlock,
                    Italic,
                    Link,
                    LinkImage,
                    List,
                    ListProperties,
                    Mention,
                    PageBreak,
                    Paragraph,
                    PasteFromOffice,
                    PictureEditing,
                    RemoveFormat,
                    SpecialCharacters,
                    SpecialCharactersArrows,
                    SpecialCharactersCurrency,
                    SpecialCharactersEssentials,
                    SpecialCharactersLatin,
                    SpecialCharactersMathematical,
                    SpecialCharactersText,
                    Strikethrough,
                    Style,
                    Subscript,
                    Superscript,
                    Table,
                    TableCaption,
                    TableCellProperties,
                    TableColumnResize,
                    TableProperties,
                    TableToolbar,
                    TextTransformation,
                    TodoList,
                    Underline,
                    // Plugin premium
                    CaseChange,
                    ExportPdf,
                    ExportWord,
                    FormatPainter,
                    ImportWord,
                    MergeFields,
                    MultiLevelList,
                    PasteFromOfficeEnhanced,
                    SlashCommand,
                    TableOfContents,
                    Template
                ],
                balloonToolbar: ['bold', 'italic', '|', 'link', 'insertImage', '|', 'bulletedList', 'numberedList'],
                blockToolbar: [
                    'fontSize',
                    'fontColor',
                    'fontBackgroundColor',
                    '|',
                    'bold',
                    'italic',
                    '|',
                    'link',
                    'insertImage',
                    'insertTable',
                    '|',
                    'bulletedList',
                    'numberedList',
                    'outdent',
                    'indent'
                ],
                cloudServices: {
                    tokenUrl: CLOUD_SERVICES_TOKEN_URL
                },
                licenseKey: LICENSE_KEY,
                placeholder: 'Silahkan Tulis Konten Artikel...',
                fontFamily: {
                    supportAllValues: true
                },
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                heading: {
                    options: [
                        {
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /^.*$/,
                            styles: true,
                            attributes: true,
                            classes: true
                        }
                    ]
                },
                image: {
                    toolbar: [
                        'toggleImageCaption',
                        'imageTextAlternative',
                        '|',
                        'imageStyle:inline',
                        'imageStyle:wrapText',
                        'imageStyle:breakText',
                        '|',
                        'resizeImage'
                    ]
                },
                link: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://'
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                style: {
                    definitions: [
                        {
                            name: 'Article category',
                            element: 'h3',
                            classes: ['category']
                        },
                        {
                            name: 'Title',
                            element: 'h2',
                            classes: ['document-title']
                        },
                        {
                            name: 'Subtitle',
                            element: 'h3',
                            classes: ['document-subtitle']
                        },
                        {
                            name: 'Info box',
                            element: 'p',
                            classes: ['info-box']
                        },
                        {
                            name: 'Side quote',
                            element: 'blockquote',
                            classes: ['side-quote']
                        },
                        {
                            name: 'Marker',
                            element: 'span',
                            classes: ['marker']
                        },
                        {
                            name: 'Spoiler',
                            element: 'span',
                            classes: ['spoiler']
                        },
                        {
                            name: 'Code (dark)',
                            element: 'pre',
                            classes: ['fancy-code', 'fancy-code-dark']
                        },
                        {
                            name: 'Code (bright)',
                            element: 'pre',
                            classes: ['fancy-code', 'fancy-code-bright']
                        }
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
                }
            };

            // Definisikan variabel editor di scope global
            window.editor = null;

            // Log untuk memastikan konten textarea description
            console.log('Konten textarea description:', $('#description').val() ? $('#description').val().substring(0, 100) + '...' : '(kosong)');

            ClassicEditor.create(document.querySelector('#description'), editorConfig)
                .then(newEditor => {
                    window.editor = newEditor;
                    console.log('Editor berhasil dibuat');
                    // Verifikasi konten editor setelah dibuat
                    console.log('Konten editor setelah dibuat:', window.editor.getData() ? window.editor.getData().substring(0, 100) + '...' : '(kosong)');
                })
                .catch(error => {
                    console.error('Error saat membuat editor:', error);
                });
        });

        // thumbnail
        $(document).ready(function() {
            // Cek dimensi gambar thumbnail saat ini
            var currentImg = document.getElementById('current-thumbnail-image');
            currentImg.onload = function() {
                $('#current-dimensions').text(this.naturalWidth + ' × ' + this.naturalHeight + ' px');
            };

            // Preview thumbnail saat file dipilih
            $('#thumbnail').on('change', function() {
                const file = this.files[0];

                if (file) {
                    // Tampilkan nama file dan ukuran
                    const fileName = file.name;
                    const fileSize = formatFileSize(file.size);

                    $('#filename-display').text(fileName);
                    $('#filesize-display').text(fileSize);

                    // Baca file untuk preview
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        $('#thumbnail-preview-image').attr('src', e.target.result);
                        $('#thumbnail-preview-container').fadeIn();
                        $('.thumbnail-placeholder').hide();

                        // Tampilkan status upload
                        showUploadStatus();

                        // Animasi gambar preview
                        $('#thumbnail-preview-image').addClass('fade-in');

                        // Cek dimensi gambar
                        var img = new Image();
                        img.onload = function() {
                            $('#filesize-display').append(' • ' + this.width + ' × ' + this.height + ' px');
                        };
                        img.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });

            // Efek drag dan drop
            $('#thumbnail-dropzone')
                .on('dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('drag-over');
                })
                .on('dragleave dragend', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-over');
                })
                .on('drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-over');

                    if (e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
                        $('#thumbnail')[0].files = e.originalEvent.dataTransfer.files;
                        $('#thumbnail').trigger('change');
                    }
                });

            // Format file size untuk display
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';

                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));

                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Simulasi status upload
            function showUploadStatus() {
                $('#upload-status').slideDown();

                // Simulasi progress
                $('.status-text').html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Mempersiapkan file...');

                setTimeout(function() {
                    $('.progress-bar').css('width', '30%');
                    $('.status-text').html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Memvalidasi format...');
                }, 500);

                setTimeout(function() {
                    $('.progress-bar').css('width', '60%');
                    $('.status-text').html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Mengoptimalkan gambar...');
                }, 1000);

                setTimeout(function() {
                    $('.progress-bar').css('width', '100%');
                    $('.status-text').html('<i class="fas fa-check-circle mr-2 text-success"></i> File siap diunggah');
                }, 1500);
            }
        });

        // Tag autocomplete functionality
        $(document).ready(function() {
            let availableTags = [];
            let tagTimeout;

            // Load existing tags on page load
            loadExistingTags();

            function loadExistingTags() {
                $.ajax({
                    url: '/api/tags/search',
                    method: 'GET',
                    data: { q: '' },
                    success: function(tags) {
                        availableTags = tags.map(tag => tag.text);
                    }
                });
            }

            // Tag input with autocomplete
            $('#tags').on('input', function() {
                clearTimeout(tagTimeout);
                const query = $(this).val().split(',').pop().trim();

                if (query.length > 1) {
                    tagTimeout = setTimeout(function() {
                        searchTags(query);
                    }, 300);
                }
            });

            function searchTags(query) {
                $.ajax({
                    url: '/api/tags/search',
                    method: 'GET',
                    data: { q: query },
                    success: function(tags) {
                        if (tags.length > 0) {
                            showTagSuggestions(tags);
                        } else {
                            hideTagSuggestions();
                        }
                    }
                });
            }

            function showTagSuggestions(tags) {
                hideTagSuggestions(); // Remove existing suggestions

                const $input = $('#tags');
                const offset = $input.offset();
                const $suggestions = $('<div>')
                    .addClass('tag-suggestions')
                    .css({
                        position: 'absolute',
                        top: offset.top + $input.outerHeight(),
                        left: offset.left,
                        width: $input.outerWidth(),
                        background: 'white',
                        border: '1px solid #ddd',
                        borderRadius: '4px',
                        boxShadow: '0 2px 8px rgba(0,0,0,0.1)',
                        maxHeight: '200px',
                        overflowY: 'auto',
                        zIndex: 1000
                    });

                tags.forEach(function(tag) {
                    const $suggestion = $('<div>')
                        .addClass('tag-suggestion')
                        .css({
                            padding: '8px 12px',
                            cursor: 'pointer',
                            borderBottom: '1px solid #eee'
                        })
                        .html(`<strong>${tag.text}</strong> <small class="text-muted">(${tag.usage_count} artikel)</small>`)
                        .hover(
                            function() { $(this).css('background', '#f5f5f5'); },
                            function() { $(this).css('background', 'white'); }
                        )
                        .click(function() {
                            addTagToInput(tag.text);
                            hideTagSuggestions();
                        });

                    $suggestions.append($suggestion);
                });

                $('body').append($suggestions);
            }

            function addTagToInput(tagName) {
                const $input = $('#tags');
                const currentValue = $input.val();
                const tags = currentValue.split(',').map(t => t.trim()).filter(t => t);

                // Remove the last incomplete tag and add the selected one
                tags.pop();
                tags.push(tagName);

                $input.val(tags.join(', ') + ', ');
                $input.focus();
            }

            function hideTagSuggestions() {
                $('.tag-suggestions').remove();
            }

            // Hide suggestions when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('#tags, .tag-suggestions').length) {
                    hideTagSuggestions();
                }
            });
        });

    </script>
@endsection
