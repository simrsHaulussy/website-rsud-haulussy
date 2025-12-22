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

   /* Article Statistics Component - Match existing design system */
   .article-stats-section {
       background: linear-gradient(to right, #4299e1, #7f9cf5);
       border-radius: 8px;
       padding: 18px 25px;
       margin-bottom: 1.5rem;
       box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
   }

   .article-stats-section__header {
       display: flex;
       justify-content: space-between;
       align-items: center;
       margin-bottom: 0;
       line-height: 1;
   }

   .article-stats-section__info {
       display: flex;
       align-items: center;
       gap: 0.75rem;
   }

   .article-stats-section__info-icon {
       color: rgba(255, 255, 255, 0.9);
       font-size: 1.1rem;
       display: flex;
       align-items: center;
   }

   .article-stats-section__info-text {
       color: rgba(255, 255, 255, 0.95);
       font-size: 0.9rem;
       margin: 0;
       display: flex;
       align-items: center;
   }

   .article-stats-section__info-value {
       color: #ffffff;
       font-weight: 600;
       font-size: 1rem;
   }

   /* Article Filter Component */
   .article-filter-section {
       margin-bottom: 1rem;
       margin-left: 0;
   }

   .article-filter-section__control-group {
       display: flex;
       align-items: baseline;
       gap: 0.75rem;
       margin-top: 15px;
   }

   .article-filter-section__dropdown {
       height: 38px;
       line-height: 1.5;
       vertical-align: baseline;
   }

   .article-filter-section__label {
       color: rgba(255, 255, 255, 0.95);
       font-weight: 500;
       font-size: 0.9rem;
       margin: 0;
       white-space: nowrap;
   }

   .article-filter-section__dropdown {
       min-width: 180px;
       font-size: 0.875rem;
       border-radius: 6px;
       border: 1px solid rgba(255, 255, 255, 0.3);
       padding: 0.375rem 2.25rem 0.375rem 0.75rem;
       background-color: rgba(255, 255, 255, 0.95);
       color: #2c3e50;
       font-weight: 500;
       transition: all 0.15s ease-in-out;
   }

   .article-filter-section__dropdown:focus {
       border-color: rgba(255, 255, 255, 0.8);
       background-color: #ffffff;
       box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.3);
       outline: 0;
   }

   .article-filter-section__dropdown option {
       background-color: #ffffff;
       color: #2c3e50;
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

   .article-data-table__badge i {
       font-size: 0.8em;
       margin-right: 4px;
   }

   .article-data-table__badge:hover {
       transform: scale(1.05);
   }

   /* Views Badge Variants (State-based) - Improved Contrast */
   .article-data-table__badge--views-low {
       background-color: #e3f2fd;
       color: #0d47a1;
       border: 1px solid #bbdefb;
   }

   .article-data-table__badge--views-low i {
       color: #0d47a1;
   }

   .article-data-table__badge--views-medium {
       background-color: #e8f5e8;
       color: #1b5e20;
       border: 1px solid #c8e6c9;
   }

   .article-data-table__badge--views-medium i {
       color: #1b5e20;
   }

   .article-data-table__badge--views-high {
       background-color: #fff8e1;
       color: #e65100;
       border: 1px solid #ffe0b2;
   }

   .article-data-table__badge--views-high i {
       color: #e65100;
   }

   .article-data-table__badge--views-viral {
       background-color: #ffebee;
       color: #b71c1c;
       border: 1px solid #ffcdd2;
   }

   .article-data-table__badge--views-viral i {
       color: #b71c1c;
   }

   /* Custom Tooltip Styling */
   .custom-tooltip {
       position: absolute;
       bottom: 100%;
       left: 50%;
       transform: translateX(-50%);
       background: #1a1a1a;
       color: white;
       padding: 8px 12px;
       border-radius: 6px;
       font-size: 0.75rem;
       white-space: nowrap;
       opacity: 0;
       visibility: hidden;
       transition: opacity 0.3s ease, visibility 0.3s ease;
       z-index: 1000;
       pointer-events: none;
       box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
       max-width: 200px;
       white-space: normal;
       margin-bottom: 8px;
   }

   .custom-tooltip::after {
       content: '';
       position: absolute;
       top: 100%;
       left: 50%;
       transform: translateX(-50%);
       border: 6px solid transparent;
       border-top-color: #1a1a1a;
   }

   /* Enhanced Tooltip content styling */
   .custom-tooltip__title {
       font-weight: 600;
       margin-bottom: 6px;
       color: #fff;
       border-bottom: 1px solid #333;
       padding-bottom: 4px;
       font-size: 0.8rem;
   }

   .custom-tooltip__row {
       display: flex;
       justify-content: space-between;
       margin: 3px 0;
       align-items: center;
   }

   .custom-tooltip__label {
       color: #ccc;
       font-size: 0.7rem;
   }

   .custom-tooltip__value {
       font-weight: 500;
       color: #fff;
       font-size: 0.75rem;
   }

   .custom-tooltip__divider {
       height: 1px;
       background: #444;
       margin: 6px 0;
   }

   .custom-tooltip__calculation {
       background: rgba(255, 255, 255, 0.05);
       padding: 6px 8px;
       border-radius: 4px;
       margin-top: 4px;
   }

   .custom-tooltip__formula {
       font-size: 0.65rem;
       color: #aaa;
       margin-bottom: 4px;
       font-style: italic;
   }

   .custom-tooltip__example {
       font-size: 0.7rem;
       color: #fff;
       font-weight: 500;
   }

   .custom-tooltip__category {
       margin-top: 4px;
   }

   .custom-tooltip__category-title {
       font-weight: 600;
       color: #fff;
       margin-bottom: 3px;
       font-size: 0.75rem;
   }

   .custom-tooltip__category-meaning {
       font-size: 0.65rem;
       color: #ddd;
       margin-bottom: 4px;
       font-style: italic;
   }

   .custom-tooltip__characteristics {
       font-size: 0.6rem;
       color: #bbb;
       line-height: 1.3;
   }

   /* All Categories Display */
   .custom-tooltip__all-categories {
       margin: 6px 0;
   }

   .custom-tooltip__category-item {
       display: flex;
       align-items: center;
       margin: 3px 0;
       padding: 2px 4px;
       border-radius: 3px;
   }

   .custom-tooltip__category-item--current {
       background: rgba(255, 255, 255, 0.1);
       border: 1px solid rgba(255, 255, 255, 0.2);
   }

   .custom-tooltip__color-indicator {
       width: 12px;
       height: 12px;
       border-radius: 50%;
       margin-right: 8px;
       border: 1px solid rgba(0, 0, 0, 0.2);
   }

   .custom-tooltip__color--red {
       background-color: #ffebee;
       border-color: #ffcdd2;
   }

   .custom-tooltip__color--orange {
       background-color: #fff8e1;
       border-color: #ffe0b2;
   }

   .custom-tooltip__color--green {
       background-color: #e8f5e8;
       border-color: #c8e6c9;
   }

   .custom-tooltip__color--blue {
       background-color: #e3f2fd;
       border-color: #bbdefb;
   }

   .custom-tooltip__category-info {
       font-size: 0.65rem;
       color: #ddd;
   }

   .custom-tooltip__current-category {
       margin-top: 4px;
       padding: 4px;
       background: rgba(255, 255, 255, 0.05);
       border-radius: 4px;
   }

   /* Tooltip trigger styling */
   .article-stats-section__info-tooltip-trigger,
   .views-tooltip-trigger {
       position: relative;
       cursor: help;
   }

   .article-stats-section__info-tooltip-trigger:hover .custom-tooltip,
   .views-tooltip-trigger:hover .custom-tooltip {
       opacity: 1;
       visibility: visible;
   }

   /* Specific tooltip variants */
   .custom-tooltip--stats {
       min-width: 220px;
       max-width: 250px;
   }

   .custom-tooltip--badge {
       min-width: 200px;
       max-width: 220px;
       left: 50%;
       transform: translateX(-50%);
   }

   /* ==========================================================================
      TOOLTIP POSITIONING FIXES
      Prevents tooltip clipping for views badges in data table
      ========================================================================== */

   /* Bottom tooltip positioning for top-row badges */
   .custom-tooltip--badge.tooltip-bottom {
       bottom: auto;
       top: 100%;
       margin-bottom: 0;
       margin-top: 8px;
   }

   /* Arrow positioning for bottom tooltips */
   .custom-tooltip--badge.tooltip-bottom::after {
       top: auto;
       bottom: 100%;
       border-top-color: transparent;
       border-bottom-color: #1a1a1a;
   }

   /* Table container overflow fix - allows tooltips to display outside bounds */
   .table-responsive {
       overflow: visible !important;
   }

   /* Table cell positioning - ensures tooltips are not clipped */
   .article-data-table td {
       position: relative;
       overflow: visible !important;
   }

   /* Elevated z-index - ensures tooltips appear above all other elements */
   .custom-tooltip--badge {
       z-index: 9999 !important;
   }

   /* Responsive tooltip adjustments - maintains readability across screen sizes */
   @media screen {
       .custom-tooltip--badge {
           max-width: 280px !important;
           word-wrap: break-word;
       }
   }

   /* Enhanced hover effects */
   .article-stats-section__info-tooltip-trigger:hover {
       opacity: 0.8;
       transition: opacity 0.2s ease;
   }

   .views-tooltip-trigger:hover {
       transform: scale(1.05);
   }

   /* Utility Classes (Global, reusable) */
   .u-text-white { color: #ffffff !important; }
   .u-font-weight-600 { font-weight: 600 !important; }
   .u-font-weight-500 { font-weight: 500 !important; }

   /* Responsive Design - Better Mobile Experience */
   @media (max-width: 768px) {
       .article-stats-section {
           padding: 1rem 1.25rem;
           margin-bottom: 1rem;
       }

       .article-stats-section__header {
           flex-direction: column;
           gap: 1rem;
           align-items: flex-start;
       }

       .article-stats-section__info {
           flex-direction: column;
           align-items: flex-start;
           gap: 0.5rem;
       }

       .article-filter-section {
           align-self: flex-start;
           width: 100%;
       }

       .article-filter-section__control-group {
           width: 100%;
           flex-direction: column;
           align-items: flex-start;
           gap: 0.75rem;
       }

       .article-filter-section__dropdown {
           width: 100%;
           max-width: none;
       }

       .article-filter-section__label {
           margin-bottom: 0.25rem;
       }
   }

   @media (max-width: 576px) {
       .article-stats-section__info-text {
           font-size: 0.85rem;
       }

       .article-filter-section__label {
           font-size: 0.85rem;
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
                                <div class="article-stats-section__info article-stats-section__info-tooltip-trigger">
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
                                    <div class="custom-tooltip custom-tooltip--stats">Loading...</div>
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
        // Custom Tooltip Functions
        function formatNumber(num) {
            if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'K';
            }
            return num.toString();
        }

        function getBadgeInfo(views, badgeClass) {
            const infoMap = {
                'article-data-table__badge--views-low': {
                    category: '🔵 Low Engagement',
                    range: '0-99 views',
                    meaning: 'Artikel baru atau kurang menarik minat pembaca',
                    characteristics: '• Baru dipublish\n• Topik kurang populer\n• Perlu promosi lebih'
                },
                'article-data-table__badge--views-medium': {
                    category: '🟢 Moderate Engagement',
                    range: '100-499 views',
                    meaning: 'Artikel dengan performa standar yang sudah ada pembaca',
                    characteristics: '• Pembaca reguler\n• Topik menarik\n• Performa normal'
                },
                'article-data-table__badge--views-high': {
                    category: '🟠 High Performing',
                    range: '500-1999 views',
                    meaning: 'Artikel populer yang banyak menarik minat pembaca',
                    characteristics: '• Konten berkualitas\n• SEO baik\n• Banyak dishare'
                },
                'article-data-table__badge--views-viral': {
                    category: '🔴 Viral Content',
                    range: '2000+ views',
                    meaning: 'Artikel sangat populer yang sedang trending atau sangat relevan',
                    characteristics: '• Sedang trending\n• Topik hangat\n• Viral di media sosial'
                }
            };
            return infoMap[badgeClass] || { category: 'Unknown', range: 'N/A', meaning: 'Views information', characteristics: '' };
        }

        function populateStatsTooltip(totalViews, avgViews, articleCount) {
            // Format rata-rata sama seperti yang ditampilkan di luar
            const formattedAvg = avgViews % 1 !== 0 ? avgViews.toFixed(1) : avgViews.toString();

            const tooltipContent = `
                <div class="custom-tooltip__title">💡 Cara Perhitungan Statistik</div>
                <div class="custom-tooltip__row">
                    <span class="custom-tooltip__label">Total Views:</span>
                    <span class="custom-tooltip__value">${totalViews.toLocaleString('id-ID')}</span>
                </div>
                <div class="custom-tooltip__row">
                    <span class="custom-tooltip__label">Jumlah Artikel:</span>
                    <span class="custom-tooltip__value">${articleCount}</span>
                </div>
                <div class="custom-tooltip__divider"></div>
                <div class="custom-tooltip__calculation">
                    <div class="custom-tooltip__formula">
                        Rata-rata = Total Views ÷ Jumlah Artikel
                    </div>
                    <div class="custom-tooltip__example">
                        ${totalViews.toLocaleString('id-ID')} ÷ ${articleCount} = <strong>${formattedAvg}</strong> views/artikel
                    </div>
                </div>
            `;

            const tooltipElement = document.querySelector('.article-stats-section__info-tooltip-trigger .custom-tooltip');
            if (tooltipElement) {
                tooltipElement.innerHTML = tooltipContent;
            }
        }

        function populateBadgeTooltip(badgeElement, views, badgeClass) {
            const tooltipContent = `
                <div class="custom-tooltip__title">📈 Kategori Views</div>
                <div class="custom-tooltip__row">
                    <span class="custom-tooltip__label">Views Artikel Ini:</span>
                    <span class="custom-tooltip__value">${views.toLocaleString('id-ID')}</span>
                </div>
                <div class="custom-tooltip__divider"></div>
                <div class="custom-tooltip__all-categories">
                    <div class="custom-tooltip__category-item ${badgeClass === 'article-data-table__badge--views-viral' ? 'custom-tooltip__category-item--current' : ''}">
                        <span class="custom-tooltip__color-indicator custom-tooltip__color--red"></span>
                        <span class="custom-tooltip__category-info">🔴 Viral Content: 2.000+</span>
                    </div>
                    <div class="custom-tooltip__category-item ${badgeClass === 'article-data-table__badge--views-high' ? 'custom-tooltip__category-item--current' : ''}">
                        <span class="custom-tooltip__color-indicator custom-tooltip__color--orange"></span>
                        <span class="custom-tooltip__category-info">🟠 High Performing: 500-1.999</span>
                    </div>
                    <div class="custom-tooltip__category-item ${badgeClass === 'article-data-table__badge--views-medium' ? 'custom-tooltip__category-item--current' : ''}">
                        <span class="custom-tooltip__color-indicator custom-tooltip__color--green"></span>
                        <span class="custom-tooltip__category-info">🟢 Moderate Engagement: 100-499</span>
                    </div>
                    <div class="custom-tooltip__category-item ${badgeClass === 'article-data-table__badge--views-low' ? 'custom-tooltip__category-item--current' : ''}">
                        <span class="custom-tooltip__color-indicator custom-tooltip__color--blue"></span>
                        <span class="custom-tooltip__category-info">🔵 Low Engagement: 0-99</span>
                    </div>
                </div>
            `;

            const tooltipElement = badgeElement.querySelector('.custom-tooltip');
            if (tooltipElement) {
                tooltipElement.innerHTML = tooltipContent;
            }
        }

        /**
         * Initializes and positions tooltips for all views badges
         *
         * This function dynamically positions tooltips based on available viewport space,
         * preventing clipping issues especially for badges in table header rows.
         *
         * Features:
         * - Intelligent vertical positioning (top/bottom) based on space constraints
         * - Horizontal adjustment to prevent viewport overflow
         * - Automatic badge classification based on view count
         * - Responsive handling for different screen sizes
         */
        function populateAllBadges() {
            const badges = document.querySelectorAll('.views-tooltip-trigger');
            badges.forEach(function(badge) {
                // Parse view count from badge text content
                const viewsText = badge.textContent.replace('Loading...', '').trim();
                const viewsMatch = viewsText.match(/[\d.]+K?/);

                if (viewsMatch) {
                    const viewsTextValue = viewsMatch[0];
                    let views = 0;

                    // Convert K notation to actual numbers
                    if (viewsTextValue.includes('K')) {
                        views = parseFloat(viewsTextValue.replace('K', '')) * 1000;
                    } else {
                        views = parseInt(viewsTextValue);
                    }

                    // Determine appropriate badge class based on view count thresholds
                    let badgeClass = 'article-data-table__badge--views-low';
                    if (views >= 2000) {
                        badgeClass = 'article-data-table__badge--views-viral';
                    } else if (views >= 500) {
                        badgeClass = 'article-data-table__badge--views-high';
                    } else if (views >= 100) {
                        badgeClass = 'article-data-table__badge--views-medium';
                    }

                    // Populate tooltip with category information
                    populateBadgeTooltip(badge, views, badgeClass);

                    // Calculate optimal tooltip positioning
                    const tooltip = badge.querySelector('.custom-tooltip');
                    if (tooltip) {
                        // Get badge and container dimensions
                        const rect = badge.getBoundingClientRect();
                        const tableContainer = badge.closest('.table-responsive');
                        const containerRect = tableContainer ? tableContainer.getBoundingClientRect() : null;

                        // Identify badges in top table rows that need special handling
                        const row = badge.closest('tr');
                        const isNearTop = row && row.rowIndex <= 2; // First 2 rows require bottom positioning

                        const tooltipHeight = 160; // Estimated tooltip height in pixels
                        const spaceAbove = rect.top;
                        const spaceBelow = window.innerHeight - rect.bottom;

                        // Position tooltip below badges in top rows or when insufficient space above
                        if (isNearTop || spaceAbove < tooltipHeight + 20) { // 20px safety buffer
                            tooltip.classList.add('tooltip-bottom');

                            // Handle edge cases where tooltip might still be clipped
                            if (spaceBelow < tooltipHeight) {
                                const viewportCenter = window.innerHeight / 2;
                                if (rect.top < viewportCenter) {
                                    // Prioritize bottom positioning for upper-half elements
                                    tooltip.style.maxHeight = Math.min(spaceBelow - 10, 200) + 'px';
                                    tooltip.style.overflowY = 'auto';
                                }
                            }
                        } else {
                            tooltip.classList.remove('tooltip-bottom');
                        }

                        // Adjust horizontal positioning to prevent viewport overflow
                        const tooltipWidth = 220;
                        const spaceLeft = rect.left;
                        const spaceRight = window.innerWidth - rect.right;

                        if (spaceLeft < tooltipWidth / 2) {
                            // Align to left edge when insufficient space on left
                            tooltip.style.left = '0';
                            tooltip.style.transform = 'translateX(0)';
                        } else if (spaceRight < tooltipWidth / 2) {
                            // Align to right edge when insufficient space on right
                            tooltip.style.left = 'auto';
                            tooltip.style.right = '0';
                            tooltip.style.transform = 'translateX(0)';
                        } else {
                            // Default center alignment
                            tooltip.style.left = '50%';
                            tooltip.style.right = 'auto';
                            tooltip.style.transform = 'translateX(-50%)';
                        }
                    }
                }
            });
        }

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

                        if (views >= 2000) {
                            badgeVariant = 'article-data-table__badge--views-viral'; // Viral content (2000+)
                        } else if (views >= 500) {
                            badgeVariant = 'article-data-table__badge--views-high'; // High performing (500-1999)
                        } else if (views >= 100) {
                            badgeVariant = 'article-data-table__badge--views-medium'; // Moderate views (100-499)
                        }

                        return '<span class="article-data-table__badge views-tooltip-trigger ' + badgeVariant + '"><i class="fas fa-eye" style="margin-right: 4px;"></i>' + data + '<div class="custom-tooltip custom-tooltip--badge">Loading...</div></span>';
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

                // Populate tooltips for all badges after table draw
                populateAllBadges();
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
            var articleCount = json.recordsTotal || 0;

            // Format numbers to match dashboard exactly
            function formatNumber(num) {
                // Simulate PHP number_format behavior
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            }

            $('#totalViews').text(formatNumber(totalViews));
            // For average, show with 1 decimal place like dashboard
            $('#avgViews').text(avgViews % 1 !== 0 ? avgViews.toFixed(1) : avgViews.toString());

            // Populate statistics tooltip
            populateStatsTooltip(totalViews, avgViews, articleCount);
        }

        /**
         * =========================================================================
         * EVENT LISTENERS
         * Manages dynamic tooltip repositioning on viewport changes
         * =========================================================================
         */

        // Update view statistics when new data is loaded
        table.on('xhr', function(e, settings, json) {
            if (json) {
                updateViewStatistics(json);
            }
        });

        // Debounce timers to optimize performance during rapid events
        let scrollTimeout;
        let resizeTimeout;

        /**
         * Repositions all tooltips to ensure proper visibility
         * Called after viewport changes to maintain tooltip positioning
         */
        function repositionTooltips() {
            populateAllBadges();
        }

        // Handle window scroll events with debouncing for performance
        $(window).on('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(repositionTooltips, 100); // 100ms delay
        });

        // Handle window resize events to maintain tooltip positioning
        $(window).on('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(repositionTooltips, 100); // 100ms delay
        });

        // Handle table-specific scroll events for tooltip visibility
        $('.table-responsive').on('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(repositionTooltips, 100); // 100ms delay
        });
    </script>
@endsection
