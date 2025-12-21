@extends('admin.layout.main')

@section('title', 'Artikel')

@section('link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        /* DataTables search styling */
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            color: #4a5568;
        }
        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0;
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            outline: none;
            transition: all 0.2s;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.25);
        }
        .dataTables_wrapper .dataTables_filter i {
            color: #4299e1;
        }
        /* Article list styling */
        .article-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            border: none;
        }

        .article-card-header {
            background: linear-gradient(to right, #4299e1, #7f9cf5);
            color: white;
            padding: 18px 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .article-card-body {
            padding: 25px;
            background-color: #fff;
        }

        .article-stats {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3182ce;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #718096;
            margin-top: 5px;
        }

        /* Button styling */
        .btn-create {
            background: linear-gradient(to right, #3182ce, #4299e1);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(49, 130, 206, 0.2);
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(49, 130, 206, 0.25);
            color: white;
        }

        .btn-create i {
            margin-right: 8px;
            font-size: 18px;
        }

        /* Action button styling */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            padding: 0;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .btn-action span {
            display: none;
        }

        .btn-view {
            background-color: #edf2f7;
            color: #3182ce;
            border: 1px solid #e2e8f0;
        }

        .btn-view:hover {
            background-color: #e6f0ff;
            color: #2b6cb0;
            border-color: #bee3f8;
        }

        .btn-edit {
            background-color: #edf2f7;
            color: #d69e2e;
            border: 1px solid #e2e8f0;
        }

        .btn-edit:hover {
            background-color: #fefcbf;
            color: #b7791f;
            border-color: #faf089;
        }

        .btn-delete {
            background-color: #edf2f7;
            color: #e53e3e;
            border: 1px solid #e2e8f0;
        }

        .btn-delete:hover {
            background-color: #fff5f5;
            color: #c53030;
            border-color: #fed7d7;
        }

        .btn-action i {
            margin: 0;
            font-size: 16px;
        }

        .btn-action:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.25);
        }

        /* ========================================
   ARTICLE MANAGEMENT PAGE COMPONENTS
   CSS Best Practices Implementation
   ======================================== */

   /* Article Page Layout Wrapper */
   .article-management-page {
       /* Page-specific styles if needed */
   }

   /* Article Statistics Component */
   .article-stats-section {
       background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
       border-radius: 12px;
       padding: 1.5rem;
       margin-bottom: 1.5rem;
       box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
   }

   .article-stats-section__header {
       display: flex;
       justify-content: space-between;
       align-items: center;
       margin-bottom: 0;
   }

   .article-stats-section__info {
       display: flex;
       align-items: center;
       gap: 0.5rem;
   }

   .article-stats-section__info-icon {
       color: rgba(255, 255, 255, 0.8);
       font-size: 1.1rem;
   }

   .article-stats-section__info-text {
       color: rgba(255, 255, 255, 0.9);
       font-size: 0.875rem;
       margin: 0;
   }

   .article-stats-section__info-value {
       color: #ffffff;
       font-weight: 600;
       font-size: 1rem;
   }

   /* Article Filter Component */
   .article-filter-section {
       margin-bottom: 1rem;
   }

   .article-filter-section__control-group {
       display: flex;
       align-items: center;
       gap: 0.5rem;
   }

   .article-filter-section__label {
       color: #495057;
       font-weight: 500;
       font-size: 0.875rem;
       margin: 0;
       white-space: nowrap;
   }

   .article-filter-section__dropdown {
       min-width: 180px;
       font-size: 0.875rem;
       border-radius: 6px;
       border: 1px solid #dee2e6;
       padding: 0.375rem 0.75rem;
   }

   /* Article Table Component */
   .article-data-table {
       background: white;
       border-radius: 8px;
       overflow: hidden;
       box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
   }

   .article-data-table__badge {
       font-size: 0.85rem;
       padding: 0.4em 0.6em;
       font-weight: 500;
       border-radius: 4px;
       transition: transform 0.2s ease-in-out;
   }

   .article-data-table__badge:hover {
       transform: scale(1.05);
   }

   /* Views Badge Variants (State-based) */
   .article-data-table__badge--views-low {
       background-color: #d4edda;
       color: #155724;
   }

   .article-data-table__badge--views-medium {
       background-color: #d1ecf1;
       color: #0c5460;
   }

   .article-data-table__badge--views-high {
       background-color: #fff3cd;
       color: #856404;
   }

   .article-data-table__badge--views-viral {
       background-color: #f8d7da;
       color: #721c24;
   }

   /* Utility Classes (Global, reusable) */
   .u-text-white { color: #ffffff !important; }
   .u-font-weight-600 { font-weight: 600 !important; }
   .u-font-weight-500 { font-weight: 500 !important; }

   /* Responsive Design */
   @media (max-width: 768px) {
       .article-stats-section__header {
           flex-direction: column;
           gap: 1rem;
           align-items: flex-start;
       }

       .article-filter-section__control-group {
           width: 100%;
           justify-content: space-between;
       }

       .article-filter-section__dropdown {
           flex: 1;
           max-width: 200px;
       }
   }

            </style>
@endsection

@section('content')
    <div class="article-management-page">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="article-card">
                    <div class="article-card-header">
                        <div>
                            <i class="material-icons-round mr-2" style="font-size: 24px; vertical-align: middle;">description</i>
                            <span>Manajemen Artikel</span>
                        </div>
                        <a href="/article-add" class="btn-create">
                            <i class="material-icons-round">add_circle</i>
                            Buat Artikel Baru
                        </a>
                    </div>
                    <div class="article-card-body">
                        <!-- Quick Stats -->
                        <div class="article-stats mb-4">
                            <!-- Stats pakai js nanti yang isi -->
                            <div class="stat-item">
                                <div class="stat-value" id="totalArticles">0</div>
                                <div class="stat-label">Total Artikel</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value" id="recentArticles">0</div>
                                <div class="stat-label">Artikel Bulan Ini</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value" id="mostAuthor">-</div>
                                <div class="stat-label">Penulis Terproduktif</div>
                            </div>
                        </div>

                        <!-- Article Statistics & Filter Component -->
                        <div class="article-stats-section">
                            <div class="article-stats-section__header">
                                <!-- Statistics Info -->
                                <div class="article-stats-section__info">
                                    <i class="fas fa-eye article-stats-section__info-icon"></i>
                                    <div class="article-stats-section__info-text">
                                        Total Views:
                                        <span id="totalViews" class="article-stats-section__info-value">-</span>
                                    </div>
                                    <div class="article-stats-section__info-text">
                                        |
                                    </div>
                                    <div class="article-stats-section__info-text">
                                        Rata-rata:
                                        <span id="avgViews" class="article-stats-section__info-value">-</span>
                                    </div>
                                </div>

                                <!-- Filter Control -->
                                <div class="article-filter-section">
                                    <div class="article-filter-section__control-group">
                                        <label for="sortOptions" class="article-filter-section__label">Urutkan:</label>
                                        <select id="sortOptions" class="form-select article-filter-section__dropdown">
                                            <option value="default">Tanggal (Terbaru)</option>
                                            <option value="views_desc">Views (Tertinggi)</option>
                                            <option value="views_asc">Views (Terendah)</option>
                                            <option value="date_asc">Tanggal (Terlama)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table article-table data-table">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="35%">Judul</th>
                                        <th width="18%">Penulis</th>
                                        <th width="15%">Tanggal</th>
                                        <th width="12%">Views</th>
                                        <th width="15%" class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded by DataTables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        // Initialize DataTable
        var table = $('.data-table').DataTable({
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>",
            language: {
                "lengthMenu": "Tampilkan _MENU_ data",
                "search": "<i class='fas fa-search'></i> Cari:",
                'info': 'Menampilkan _START_ hingga _END_ dari _TOTAL_ data',
                'infoEmpty': 'Tidak ada data',
                "infoFiltered": "",
                "processing": "<div class='d-flex justify-content-center'><div class='spinner-border text-primary' role='status'></div></div>",
                "emptyTable": "<div class='empty-state'><i class='fas fa-file-alt fa-3x mb-3'></i><h4>Belum Ada Artikel</h4><p>Artikel yang Anda buat akan muncul di sini</p></div>",
                "zeroRecords": "<div class='empty-state'><i class='fas fa-search fa-3x mb-3'></i><h4>Tidak Ada Hasil</h4></div>",
                'paginate': {
                    'previous': '<i class="fas fa-chevron-left"></i>',
                    'next': '<i class="fas fa-chevron-right"></i>'
                }
            },
            order: [
                [3, "desc"]
            ],
            columnDefs: [{
                targets: [0],
                orderable: false,
                searchable: false
            }],
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('article.index') }}",
                dataSrc: function(json) {
                    // Update stats
                    updateStats(json);
                    return json.data;
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    'orderable': false,
                    'searchable': false
                },
                {
                    data: 'title',
                    name: 'title',
                    render: function(data, type, row) {
                        return '<span class="fw-bold">' + data + '</span>';
                    }
                },
                {
                    data: 'author',
                    name: 'author'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        // Format date
                        var date = new Date(data);
                        return date.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric'
                        });
                    }
                },
                {
                    data: 'views_formatted',
                    name: 'views',
                    orderSequence: ['desc', 'asc'],
                    render: function(data, type, row) {
                        if (type === 'sort' || type === 'type') {
                            return row.views || 0;
                        }

                        // Determine badge variant based on views count using state-based approach
                        var views = row.views || 0;
                        var badgeVariant = 'article-data-table__badge--views-low';

                        if (views >= 1000) {
                            badgeVariant = 'article-data-table__badge--views-viral'; // Viral content
                        } else if (views >= 500) {
                            badgeVariant = 'article-data-table__badge--views-high'; // High performing
                        } else if (views >= 50) {
                            badgeVariant = 'article-data-table__badge--views-medium'; // Moderate views
                        }

                        return '<span class="article-data-table__badge ' + badgeVariant + '">' + data + '</span>';
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            drawCallback: function() {
                // Apply styles to action buttons after table draw
                styleActionButtons();
            }
        });

        // fungsi Update stats based on data
        function updateStats(json) {
            try {
                // Update total articles
                const totalArticles = json.recordsTotal || 0;
                $('#totalArticles').text(totalArticles);

                // Get all data articles
                $.ajax({
                    url: "{{ route('article.index') }}",
                    method: 'GET',
                    data: { get_all: true },
                    success: function(fullData) {
                        if (fullData.data && Array.isArray(fullData.data)) {
                            // hitung artikel terbaru (dengan bulan sekarang)
                            const now = new Date();
                            const currentMonth = now.getMonth();
                            const currentYear = now.getFullYear();

                            // Author tracking
                            const authorStats = {};
                            let recentCount = 0;

                            fullData.data.forEach(article => {
                                if (!article) return;

                                // Count articlles from bulan sekarangg
                                const articleDate = new Date(article.created_at);
                                if (!isNaN(articleDate.getTime()) &&
                                    articleDate.getMonth() === currentMonth &&
                                    articleDate.getFullYear() === currentYear) {
                                    recentCount++;
                                }

                                // Trackk author frequency
                                const author = article.author?.trim();
                                if (author) {
                                    authorStats[author] = (authorStats[author] || 0) + 1;
                                }
                            });

                            // Find most prolific author
                            let mostProlificAuthor = '-';
                            let highestCount = 0;

                            Object.entries(authorStats).forEach(([author, count]) => {
                                if (count > highestCount) {
                                    highestCount = count;
                                    mostProlificAuthor = author;
                                }
                            });

                            // Update UI
                            $('#recentArticles').text(recentCount);
                            $('#mostAuthor').text(mostProlificAuthor);
                        }
                    },
                    error: function() {
                        // Reset stats if error
                        $('#recentArticles').text('0');
                        $('#mostAuthor').text('-');
                    }
                });
            } catch (error) {
                console.error('Error updating stats:', error);
                // Fallback to safe values
                $('#totalArticles').text('0');
                $('#recentArticles').text('0');
                $('#mostAuthor').text('-');
            }
        }

        // Style action buttons
        function styleActionButtons() {
            // Style view buttons
            $('.btn-view').html('<i class="fas fa-eye"></i><span>Lihat</span>');
            $('.btn-view').addClass('btn-action');

            // Style edit buttons
            $('.btn-edit').html('<i class="fas fa-edit"></i><span>Edit</span>');
            $('.btn-edit').addClass('btn-action');

            // Style delete buttons
            $('.btn-delete').html('<i class="fas fa-trash-alt"></i><span>Hapus</span>');
            $('.btn-delete').addClass('btn-action');

            // Add tooltips
            $('.btn-view').attr('title', 'Lihat Artikel');
            $('.btn-edit').attr('title', 'Edit Artikel');
            $('.btn-delete').attr('title', 'Hapus Artikel');
        }

        function deleteArticle(id) {
            document.getElementById("deleteArticleButton"+id).disabled = true;
            $.ajax({
                type: 'DELETE',
                url: '/article/' + id,
                data: $('#formDeleteArticle' + id).serialize(),
                success: function(response) {
                    $('#cancelDeleteArticle' + id).click();
                    $('.data-table').DataTable().ajax.reload();
                    toastr.success(response.message);
                    document.getElementById("deleteArticleButton"+id).disabled = false;
                },
                error: function(error) {
                    const errorMessage = error.responseJSON ? error.responseJSON.message : 'Terjadi kesalahan';
                    toastr.error(errorMessage);
                    document.getElementById("deleteArticleButton"+id).disabled = false;
                }
            });
        }

        // Dropdown sorting handler
        $('#sortOptions').on('change', function() {
            var value = $(this).val();
            switch(value) {
                case 'views_desc': table.order([4, 'desc']).draw(); break;
                case 'views_asc': table.order([4, 'asc']).draw(); break;
                case 'date_asc': table.order([3, 'asc']).draw(); break;
                default: table.order([3, 'desc']).draw();
            }
        });

        // Update statistics using server data
        function updateViewStatistics(json) {
            // Use server-calculated statistics instead of client-side
            var totalViews = json.total_views_all || 0;
            var avgViews = Math.round((json.avg_views_all || 0) * 10) / 10; // Round to 1 decimal place like dashboard

            // Format numbers to match dashboard exactly
            function formatNumber(num) {
                // Simulate PHP number_format behavior
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            }

            $('#totalViews').text(formatNumber(totalViews));
            // For average, show with 1 decimal place like dashboard
            $('#avgViews').text(avgViews % 1 !== 0 ? avgViews.toFixed(1) : avgViews.toString());
        }

        // Update statistics on initial load and after each draw
        table.on('xhr', function(e, settings, json) {
            if (json) {
                updateViewStatistics(json);
            }
        });
    </script>
@endsection
