@extends('admin.layout.main')

@section('title', 'Detail Artikel')

@section('link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <!-- Article Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="material-icons-round" style="vertical-align: middle; margin-right: 8px;">article</i>
                        {{ $article->title }}
                        <small class="ml-3">
                            <a href="/article-edit/{{ $article->id }}" class="btn btn-sm btn-light">
                                <i class="material-icons-round" style="font-size: 16px; vertical-align: middle;">edit</i>
                                Edit
                            </a>
                            <a href="/artikel/{{ $article->slug }}" target="_blank" class="btn btn-sm btn-light">
                                <i class="material-icons-round" style="font-size: 16px; vertical-align: middle;">visibility</i>
                                Preview
                            </a>
                        </small>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <small class="text-muted">Author</small>
                            <p class="font-weight-bold">{{ $article->author }}</p>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted">Posted by</small>
                            <p class="font-weight-bold">{{ $article->user->name }}</p>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted">Posted on</small>
                            <p class="font-weight-bold">{{ $article->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted">Category</small>
                            <p class="font-weight-bold">{{ $article->articleCategory->name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <!-- Material Design Tabs -->
                <div class="card-header p-0">
                    <ul class="nav nav-tabs nav-fill border-bottom-0" id="articleTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active d-flex align-items-center justify-content-center py-3"
                               id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="true">
                                <i class="material-icons-round mr-2" style="font-size: 20px;">description</i>
                                Content
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link d-flex align-items-center justify-content-center py-3"
                               id="analytics-tab" data-toggle="tab" href="#analytics" role="tab" aria-controls="analytics" aria-selected="false">
                                <i class="material-icons-round mr-2" style="font-size: 20px;">analytics</i>
                                Analytics
                                <span class="ml-2 badge badge-primary">{{ number_format($analytics['currentArticle']['views']) }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link d-flex align-items-center justify-content-center py-3"
                               id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">
                                <i class="material-icons-round mr-2" style="font-size: 20px;">search</i>
                                SEO
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link d-flex align-items-center justify-content-center py-3"
                               id="related-tab" data-toggle="tab" href="#related" role="tab" aria-controls="related" aria-selected="false">
                                <i class="material-icons-round mr-2" style="font-size: 20px;">share</i>
                                Related
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="card-body p-0">
                    <div class="tab-content" id="articleTabContent">
                        <!-- Content Tab -->
                        <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                            <div class="p-4">
                                <div class="row mb-4">
                                    <div class="col-md-4 text-center">
                                        <h6 class="text-muted mb-2">Thumbnail</h6>
                                        @if($article->thumbnail)
                                            <img src="{{ asset("images/article/thumbnails/$article->thumbnail") }}"
                                                 class="img-fluid rounded shadow-sm"
                                                 style="max-height: 200px;"
                                                 alt="Article thumbnail">
                                        @else
                                            <div class="bg-light rounded p-4 text-center">
                                                <i class="material-icons-round text-muted" style="font-size: 48px;">image</i>
                                                <p class="text-muted mt-2">No thumbnail</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-6">
                                                <small class="text-muted">Slug</small>
                                                <p class="font-weight-bold text-primary">{{ $article->slug }}</p>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Total Views</small>
                                                <p class="font-weight-bold text-success">{{ number_format($article->views) }}</p>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Reading Time</small>
                                                <p class="font-weight-bold">{{ $analytics['currentArticle']['reading_time'] }}</p>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Word Count</small>
                                                <p class="font-weight-bold">{{ $analytics['currentArticle']['word_count'] }} words</p>
                                            </div>
                                        </div>
                                        <hr>
                                        @if($article->tags->count() > 0)
                                            <small class="text-muted">Tags</small>
                                            <div class="mt-2">
                                                @foreach($article->tags as $tag)
                                                    <span class="badge badge-info mr-1">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            <small class="text-muted">Tags</small>
                                            <p class="text-muted">No tags assigned</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="article-content">
                                    <h6 class="mb-3">Article Content</h6>
                                    <div class="content-preview p-3 border rounded bg-light">
                                        {!! $article->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Analytics Tab -->
                        <div class="tab-pane fade" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
                            <div class="p-4">
                                <!-- Performance Overview -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Views</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($analytics['currentArticle']['views']) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Views/Day</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $analytics['trends']['views_per_day'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rank Overall</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $analytics['performance']['rank_overall']['rank'] }}/{{ $analytics['performance']['rank_overall']['total'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Performance</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $analytics['trends']['performance_grade'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Performance Comparison -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Performance Comparison</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <span>vs Category Average</span>
                                                        <span class="font-weight-bold {{ $analytics['performance']['vs_category'] >= 0 ? 'text-success' : 'text-danger' }}">
                                                            {{ $analytics['performance']['vs_category'] >= 0 ? '+' : '' }}{{ $analytics['performance']['vs_category'] }}%
                                                        </span>
                                                    </div>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar {{ $analytics['performance']['vs_category'] >= 0 ? 'bg-success' : 'bg-danger' }}"
                                                             role="progressbar"
                                                             style="width: {{ min(100, max(0, 50 + $analytics['performance']['vs_category'])) }}%">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted">Category Average: {{ number_format($analytics['performance']['category_average'], 1) }} views</small>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <span>vs Overall Average</span>
                                                        <span class="font-weight-bold {{ $analytics['performance']['vs_overall'] >= 0 ? 'text-success' : 'text-danger' }}">
                                                            {{ $analytics['performance']['vs_overall'] >= 0 ? '+' : '' }}{{ $analytics['performance']['vs_overall'] }}%
                                                        </span>
                                                    </div>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar {{ $analytics['performance']['vs_overall'] >= 0 ? 'bg-success' : 'bg-danger' }}"
                                                             role="progressbar"
                                                             style="width: {{ min(100, max(0, 50 + $analytics['performance']['vs_overall'])) }}%">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted">Overall Average: {{ number_format($analytics['performance']['overall_average'], 1) }} views</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Ranking</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <h6 class="text-secondary">In Category</h6>
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span>Rank</span>
                                                        <span class="font-weight-bold">#{{ $analytics['performance']['rank_in_category']['rank'] }} of {{ $analytics['performance']['rank_in_category']['total'] }}</span>
                                                    </div>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                             style="width: {{ $analytics['performance']['rank_in_category']['percentile'] }}%">
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ $analytics['performance']['rank_in_category']['percentile'] }}th percentile</small>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="text-secondary">Overall</h6>
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span>Rank</span>
                                                        <span class="font-weight-bold">#{{ $analytics['performance']['rank_overall']['rank'] }} of {{ $analytics['performance']['rank_overall']['total'] }}</span>
                                                    </div>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                             style="width: {{ $analytics['performance']['rank_overall']['percentile'] }}%">
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ $analytics['performance']['rank_overall']['percentile'] }}th percentile</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content Analysis -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Content Analysis</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3 text-center">
                                                        <div class="mb-2">
                                                            <h4 class="text-primary font-weight-bold mb-0">{{ $analytics['currentArticle']['reading_time'] }}</h4>
                                                            <small class="text-muted">Reading Time</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center">
                                                        <div class="mb-2">
                                                            <h4 class="text-success font-weight-bold mb-0">{{ number_format($analytics['currentArticle']['word_count']) }}</h4>
                                                            <small class="text-muted">Words</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center">
                                                        <div class="mb-2">
                                                            <h4 class="text-info font-weight-bold mb-0">{{ number_format($analytics['currentArticle']['content_length']) }}</h4>
                                                            <small class="text-muted">Characters</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center">
                                                        <div class="mb-2">
                                                            <h4 class="text-warning font-weight-bold mb-0">{{ $analytics['trends']['publication_age'] }}</h4>
                                                            <small class="text-muted">Published</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comparison Charts -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Top Performing Articles</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart-container" style="position: relative; height: 250px;">
                                                    <canvas id="topPerformingChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Category Distribution</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart-container" style="position: relative; height: 250px;">
                                                    <canvas id="categoryChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Tab -->
                        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                            <div class="p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">SEO Analysis</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <h6 class="text-secondary">Title</h6>
                                                    <p class="mb-1">{{ $article->title }}</p>
                                                    <small class="text-muted">
                                                        Length: {{ strlen($article->title) }} characters
                                                        @php
                                                        $titleLength = strlen($article->title);
                                                        if ($titleLength >= 30 && $titleLength <= 60) {
                                                            $titleStatus = '✅ Optimal';
                                                        } elseif ($titleLength < 30) {
                                                            $titleStatus = '⚠️ Too short';
                                                        } else {
                                                            $titleStatus = '⚠️ Too long';
                                                        }
                                                        @endphp
                                                        ({{ $titleStatus }})
                                                    </small>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="text-secondary">URL Slug</h6>
                                                    <p class="mb-1 text-primary">{{ $article->slug }}</p>
                                                    <small class="text-muted">
                                                        Clean and URL-friendly ✅
                                                    </small>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="text-secondary">Content Length</h6>
                                                    <p class="mb-1">{{ $analytics['currentArticle']['word_count'] }} words</p>
                                                    <small class="text-muted">
                                                        {{ $analytics['currentArticle']['word_count'] >= 300 ? '✅ Good for SEO' : '⚠️ Consider adding more content' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Performance Metrics</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <h6 class="text-secondary">Performance Grade</h6>
                                                    <div class="display-4 text-center">
                                                        @php
                                                        $grade = $analytics['trends']['performance_grade'];
                                                        $gradeColor = 'danger';
                                                        if ($grade === 'A+') $gradeColor = 'success';
                                                        elseif ($grade === 'A') $gradeColor = 'info';
                                                        elseif ($grade === 'B') $gradeColor = 'primary';
                                                        elseif ($grade === 'C') $gradeColor = 'warning';

                                                        $gradeText = 'Needs improvement';
                                                        if ($grade === 'A+') $gradeText = 'Excellent performance!';
                                                        elseif ($grade === 'A') $gradeText = 'Very good performance';
                                                        elseif ($grade === 'B') $gradeText = 'Good performance';
                                                        elseif ($grade === 'C') $gradeText = 'Average performance';
                                                        @endphp
                                                        <span class="badge badge-{{ $gradeColor }} p-3" style="font-size: 2rem;">
                                                            {{ $grade }}
                                                        </span>
                                                    </div>
                                                    <p class="text-center text-muted">
                                                        {{ $gradeText }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Related Tab -->
                        <div class="tab-pane fade" id="related" role="tabpanel" aria-labelledby="related-tab">
                            <div class="p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Top Performing Articles</h6>
                                            </div>
                                            <div class="card-body">
                                                @if(count($analytics['comparison']['top_performing']) > 0)
                                                    @foreach($analytics['comparison']['top_performing'] as $index => $topArticle)
                                                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 border rounded">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">
                                                                <a href="/artikel/{{ $topArticle['slug'] }}" target="_blank" class="text-decoration-none">
                                                                    {{ Str::limit($topArticle['title'], 50) }}
                                                                </a>
                                                            </h6>
                                                            <small class="text-muted">{{ $topArticle['created_at'] }}</small>
                                                        </div>
                                                        <div class="text-right">
                                                            <span class="badge badge-primary">{{ $topArticle['formatted_views'] }} views</span>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-muted text-center">No top performing articles found</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Recent Trending (30 Days)</h6>
                                            </div>
                                            <div class="card-body">
                                                @if(count($analytics['comparison']['recent_trending']) > 0)
                                                    @foreach($analytics['comparison']['recent_trending'] as $trending)
                                                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 border rounded">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">
                                                                <a href="/artikel/{{ $trending['slug'] }}" target="_blank" class="text-decoration-none">
                                                                    {{ Str::limit($trending['title'], 50) }}
                                                                </a>
                                                            </h6>
                                                            <small class="text-muted">{{ $trending['days_ago'] }}</small>
                                                        </div>
                                                        <div class="text-right">
                                                            <span class="badge badge-success">{{ $trending['formatted_views'] }} views</span>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-muted text-center">No trending articles found</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        // Analytics data from controller
        const analyticsData = @json($analytics);

        // Initialize charts when analytics tab is shown
        document.addEventListener('DOMContentLoaded', function() {
            const analyticsTab = document.getElementById('analytics-tab');
            if (analyticsTab) {
                analyticsTab.addEventListener('shown.bs.tab', function() {
                    setTimeout(initializeCharts, 50);
                });
            }

            // Initialize if analytics tab is already active on page load
            if (analyticsTab && analyticsTab.classList.contains('active')) {
                setTimeout(initializeCharts, 100);
            }
        });

        function initializeCharts() {
            // Top Performing Articles Chart
            const topPerformingCtx = document.getElementById('topPerformingChart');

            if (topPerformingCtx && !topPerformingCtx.chart) {
                const topData = analyticsData?.comparison?.top_performing;

                if (topData && topData.length > 0) {
                    topPerformingCtx.chart = new Chart(topPerformingCtx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: topData.map(article =>
                                article.title.length > 25 ? article.title.substring(0, 25) + '...' : article.title
                            ),
                            datasets: [{
                                label: 'Views',
                                data: topData.map(article => article.views),
                                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            }

            // Category Distribution Chart
            const categoryCtx = document.getElementById('categoryChart');

            if (categoryCtx && !categoryCtx.chart) {
                const categoryData = analyticsData?.comparison?.category_distribution;

                if (categoryData && categoryData.length > 0) {
                    categoryCtx.chart = new Chart(categoryCtx.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: categoryData.map(cat => cat.name),
                            datasets: [{
                                data: categoryData.map(cat => cat.total_views),
                                backgroundColor: categoryData.map(cat => cat.color),
                                borderWidth: 2,
                                borderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                position: 'bottom'
                            }
                        }
                    });
                }
            }
        }
    </script>

    <style>
        /* Tab Styles */
        .nav-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            border-bottom-color: #007bff;
            color: #007bff;
        }

        .nav-tabs .nav-link.active {
            border-bottom-color: #007bff;
            color: #007bff;
            background-color: transparent;
        }

        /* Card Styles */
        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }

        .border-left-danger {
            border-left: 4px solid #e74a3b !important;
        }

        /* Content Preview */
        .content-preview {
            max-height: 400px;
            overflow-y: auto;
        }

        .content-preview::-webkit-scrollbar {
            width: 6px;
        }

        .content-preview::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .content-preview::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        /* Badge Styles - Make more specific to avoid affecting notification badge */
        .article-stats .badge,
        .performance-grade .badge,
        .related-articles .badge {
            font-size: 0.75rem;
        }

        /* Ensure navbar-badge is not affected */
        .navbar-badge {
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24) !important;
        }

        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .nav-tabs .nav-link {
                font-size: 0.9rem;
                padding: 0.75rem 0.5rem;
            }

            .nav-tabs .nav-link i {
                display: block;
                margin-bottom: 0.25rem;
            }
        }

        /* Performance Grades */
        .badge-success {
            background-color: #28a745;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        .badge-primary {
            background-color: #007bff;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
        }

        /* Loading Animation */
        .tab-pane {
            min-height: 300px;
        }

        /* Progress Bar Animation */
        .progress-bar {
            transition: width 0.6s ease;
        }
    </style>
@endsection
