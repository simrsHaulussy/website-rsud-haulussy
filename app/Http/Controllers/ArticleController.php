<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $category = "article";
        if ($request->ajax()) {
            $data = Post::select('*')->where('category', '=', $category);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($article) {
                    $actionBtn = '
                    <div class="row">
                    <a href="/article/' . $article->id . '" class="mr-1 mt-1 detail btn btn-primary btn-sm">Detail</a>
                    <a href="/article-edit/' . $article->id . '" class="mr-1 mt-1 edit btn btn-success btn-sm">Edit</a>

                    <button type="button" class="mr-1 mt-1 delete btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteArticleModal' . $article->id . '">
                       Hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteArticleModal' . $article->id . '" tabindex="-1" role="dialog" aria-labelledby="deleteArticleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="deleteArticleModalLabel">Hapus Artikel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Apakah anda ingin menghapus artikel dibawah ini?
                                <p>
                                   <strong>' . $article->title . '</strong>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="cancelDeleteArticle' . $article->id . '" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                <form id="formDeleteArticle' . $article->id . '">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                    <button type="button" onclick="deleteArticle(' . $article->id . ')" class="btn btn-danger" id="deleteArticleButton' . $article->id . '">Hapus</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    ';

                    return $actionBtn;
                })
                ->addColumn('views_formatted', function ($article) {
                    $views = $article->views ?? 0;
                    if ($views >= 1000) {
                        return number_format($views / 1000, 1) . 'K';
                    }
                    return number_format($views);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.article.article');
    }

    public function create()
    {
        $categories = \App\Models\ArticleCategory::active()->ordered()->get();
        return view('admin.article.article-add', compact('categories'));
    }

    public function store(Request $request)
    {
        $description = $request->description;

        libxml_use_internal_errors(true);

        $dom = new DOMDocument();

        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/images/article/" . time() . $key . '.png';
                file_put_contents(public_path() . $image_name, $data);

                $img->removeAttribute("src");
                $img->setAttribute("src", $image_name);
            }
        }

        $description = $dom->saveHTML();
        $slug = Str::random(10);


        $thumbnail = "";
        if ($request->file("thumbnail")) {
            $thumbnail  = time() . "." . $request->file("thumbnail")->extension();
        }

        $article = Post::create([
            'title' => $request->title,
            'author' => $request->author,
            'thumbnail' => $thumbnail,
            'description' => $description,
            'slug' => $slug,
            'user_id' => $request->user_id,
            'category' => $request->category,
            'category_id' => $request->category_id, // NEW: Category relationship
        ]);

        $file = $request->file('thumbnail');
        $file->storeAs('images/article/thumbnails/', $thumbnail);

        // Handle tags
        if ($request->filled('tags')) {
            $this->attachTagsToArticle($article, $request->tags);
        }

        if ($article) {
            return response()->json(['redirect_url' => '/article']);
        }

        return response()->json(['message' => 'Gagal Menambahkan Artikel'], 401);
    }

    public function show($id)
    {
        $article = Post::with(['user', 'articleCategory', 'tags'])->findOrFail($id);
        $analytics = $this->getArticleAnalytics($id);

        return view('admin.article.article-detail', [
            'article' => $article,
            'analytics' => $analytics
        ]);
    }

    public function edit($id)
    {
        $article = Post::with(['articleCategory', 'tags'])->findOrFail($id);
        $categories = \App\Models\ArticleCategory::active()->ordered()->get();
        return view('admin.article.article-edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $article = Post::findOrFail($id);

            // Validasi data yang diterima
            if (!$request->has('title') || trim($request->title) === '') {
                return response()->json(['message' => 'Judul artikel tidak boleh kosong'], 422);
            }

            if (!$request->has('author') || trim($request->author) === '') {
                return response()->json(['message' => 'Pembuat artikel tidak boleh kosong'], 422);
            }

            $description = $request->description;

            // Validasi description
            if (empty($description)) {
                return response()->json(['message' => 'Konten artikel tidak boleh kosong'], 422);
            }

            // Proses HTML dan gambar
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML('<?xml encoding="utf-8" ?>' . $description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = "/images/article/" . time() . $key . '.png';
                    file_put_contents(public_path() . $image_name, $data);

                    $img->removeAttribute("src");
                    $img->setAttribute("src", $image_name);
                }
            }

            $description = $dom->saveHTML();

            // Data untuk update artikel
            $updateData = [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $description,
                'category_id' => $request->category_id, // NEW: Category relationship
            ];

            // Handle thumbnail jika ada
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');

                // Validasi file
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                if (!in_array(strtolower($file->getClientOriginalExtension()), $allowedExtensions)) {
                    return response()->json(['message' => 'Thumbnail harus memiliki ekstensi JPG, JPEG, atau PNG'], 422);
                }

                if ($file->getSize() > 1048576) { // 1MB = 1048576 bytes
                    return response()->json(['message' => 'Ukuran thumbnail maksimal 1024 KB'], 422);
                }

                // Hapus thumbnail lama jika ada
                $oldThumbnailPath = public_path() . "/images/article/thumbnails/" . $article->thumbnail;
                if ($article->thumbnail && File::exists($oldThumbnailPath)) {
                    File::delete($oldThumbnailPath);
                }

                // Generate nama file baru dan simpan
                $thumbnail = time() . "." . $file->getClientOriginalExtension();
                $file->storeAs('images/article/thumbnails/', $thumbnail);

                // Tambahkan ke data update
                $updateData['thumbnail'] = $thumbnail;
            }

            // Update artikel
            $editArticle = $article->update($updateData);

            if ($editArticle) {
                // Handle tags update
                if ($request->has('tags')) {
                    $this->attachTagsToArticle($article, $request->tags);
                }
                
                return response()->json(['message' => 'Artikel berhasil diperbarui', 'redirect_url' => '/article']);
            }

            return response()->json(['message' => 'Gagal mengedit artikel'], 500);
        } catch (\Exception $e) {
            error_log('Error update article: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        $article = Post::findOrFail($id);

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $article->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD); // menggantkan prmeter 9
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $pathThumbnail = public_path() . "/images/article/thumbnails/" . $article->thumbnail;
        if (File::exists($pathThumbnail)) {
            File::delete($pathThumbnail);
        }

        $deleteArticle = $article->delete();
        if ($deleteArticle) {
            return response()->json(['status' => 'success', 'message' => 'Berhasil Menghapus Data.']);
        }

        return response()->json(['message' => 'Gagal Menghapus Data'], 401);
    }

    // Artikel (VisitorSection)
    public function indexArtikel(Request $request)
    {
        $query = Post::with(['articleCategory', 'tags'])->where('category', '=', 'article');

        // Pencarian artikel berdasarkan judul dan penulis
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('author', 'LIKE', "%{$searchTerm}%");
            });
        }

        $articles = $query->orderByDesc('created_at')->paginate(6);

        // Mempertahankan parameter pencarian pada pagination
        if ($request->has('search')) {
            $articles->appends(['search' => $request->search]);
        }

        // Jika request AJAX, mengmblikan hanya HTML yang diperlukan
        if ($request->ajax() || $request->has('ajax')) {
            $html = '';
            $count = $articles->total();

            if ($articles->count() > 0) {
                foreach ($articles as $article) {
                    $html .= view('visitor.informasi._article_card', [
                        'article' => $article
                    ])->render();
                }
            } else {
                $html = '<div class="col-12 text-center py-5">
                    <div class="no-results">
                        <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                        <h3 class="mb-3">Tidak ada artikel ditemukan</h3>
                        <p class="text-muted mb-4">Maaf, tidak ada artikel yang sesuai dengan pencarian "' . $request->search . '"</p>
                        <button type="button" id="backToAllArticles" class="btn btn-primary">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke semua artikel
                        </button>
                    </div>
                </div>';
            }

            $pagination = $articles->appends(['search' => $request->search])->links()->toHtml();

            return response()->json([
                'html' => $html,
                'count' => $count,
                'pagination' => $pagination
            ]);
        }

        return view('visitor.informasi.daftar-artikel', [
            'articles' => $articles,
            'searchTerm' => $request->search ?? ''
        ]);
    }

    public function showArtikel($slug)
    {
        // Load artikel dengan category dan tags relationships
        $article = Post::with(['user', 'articleCategory', 'tags'])->where('slug', '=', $slug)->first();
        
        if (!$article) {
            return abort(404);
        }

        // Smart Related Articles System dengan 3 jenis
        $relatedArticles = $this->getSmartRelatedArticles($article, $slug);

        // Mekanisme anti-spam untuk view counter
        $sessionKey = 'article_' . $article->id . '_viewed';

        if (!session()->has($sessionKey)) {
            // Increment view counter hanya jika artikel belum dilihat dalam session ini
            $article->increment('views');

            // Set session untuk mencatat bahwa artikel ini sudah dilihat
            // Session akan berakhir saat browser ditutup atau setelah 24 jam
            session()->put($sessionKey, true);
            session()->save();
        }

        return view('visitor.informasi.baca-artikel', [
            'article' => $article,
            'artikelTerkait' => $relatedArticles['terkait'],
            'artikelPopuler' => $relatedArticles['populer'], 
            'artikelTerbaru' => $relatedArticles['terbaru']
        ]);
    }

    /**
     * Get smart related articles dengan 3 jenis
     *
     * @param Post $currentArticle
     * @param string $currentSlug
     * @return array
     */
    private function getSmartRelatedArticles($currentArticle, $currentSlug)
    {
        $baseQuery = Post::with(['articleCategory', 'tags'])
            ->where([['slug', '!=', $currentSlug], ['category', '=', 'article']]);

        // 1. ARTIKEL TERKAIT (4 items) - Same category + shared tags
        $artikelTerkait = $this->getRelatedByCategoryAndTags($baseQuery, $currentArticle, 4);

        // 2. ARTIKEL POPULER (2 items) - Most viewed in last 30 days  
        $artikelPopuler = $this->getPopularArticles($baseQuery, $currentSlug, 2);

        // 3. ARTIKEL TERBARU (2 items) - Latest articles, excluding above
        $excludeIds = array_merge(
            $artikelTerkait->pluck('id')->toArray(),
            $artikelPopuler->pluck('id')->toArray(),
            [$currentArticle->id]
        );
        $artikelTerbaru = $this->getLatestArticles($baseQuery, $excludeIds, 2);

        return [
            'terkait' => $artikelTerkait,
            'populer' => $artikelPopuler,
            'terbaru' => $artikelTerbaru
        ];
    }

    /**
     * Get articles by same category and shared tags
     */
    private function getRelatedByCategoryAndTags($baseQuery, $currentArticle, $limit)
    {
        $query = clone $baseQuery;
        
        // Priority 1: Same category
        if ($currentArticle->category_id) {
            $query->orderByRaw('category_id = ? DESC', [$currentArticle->category_id]);
        }

        // Priority 2: Shared tags (if article has tags)
        if ($currentArticle->tags && $currentArticle->tags->count() > 0) {
            $tagIds = $currentArticle->tags->pluck('id')->toArray();
            $query->orderByRaw(
                '(SELECT COUNT(*) FROM article_tag WHERE post_id = posts.id AND tag_id IN (' . implode(',', $tagIds) . ')) DESC'
            );
        }

        // Priority 3: Latest
        $query->orderByDesc('created_at');

        return $query->limit($limit)->get();
    }

    /**
     * Get popular articles based on views (last 30 days)
     */
    private function getPopularArticles($baseQuery, $currentSlug, $limit)
    {
        $query = clone $baseQuery;
        
        return $query->where('created_at', '>=', now()->subDays(30))
                    ->orderByDesc('views')
                    ->orderByDesc('created_at') // Secondary sort for same view count
                    ->limit($limit)
                    ->get();
    }

    /**
     * Get latest articles excluding specific IDs
     */
    private function getLatestArticles($baseQuery, $excludeIds, $limit)
    {
        $query = clone $baseQuery;
        
        if (!empty($excludeIds)) {
            $query->whereNotIn('id', $excludeIds);
        }

        return $query->orderByDesc('created_at')
                    ->limit($limit)
                    ->get();
    }

    /**
     * Helper method to attach tags to article
     */
    private function attachTagsToArticle($article, $tagsString)
    {
        if (empty($tagsString)) {
            // If tags empty, remove all tags
            $article->tags()->detach();
            return;
        }

        // Parse tags from comma-separated string
        $tagNames = array_map('trim', explode(',', $tagsString));
        $tagIds = [];

        foreach ($tagNames as $tagName) {
            if (empty($tagName)) continue;

            // Generate slug for tag
            $tagSlug = \Illuminate\Support\Str::slug($tagName);
            
            // Find or create tag
            $tag = \App\Models\ArticleTag::firstOrCreate(
                ['slug' => $tagSlug],
                ['name' => $tagName]
            );
            
            $tagIds[] = $tag->id;
        }

        // Sync tags (this will remove old tags and add new ones)
        $article->tags()->sync($tagIds);

        // Update usage count for all tags
        foreach ($tagIds as $tagId) {
            $tag = \App\Models\ArticleTag::find($tagId);
            if ($tag) {
                $tag->refreshUsageCount();
            }
        }
    }

    /**
     * API endpoint for tag search (autocomplete)
     */
    public function searchTags(Request $request)
    {
        $search = $request->get('q', '');

        if (empty($search)) {
            return response()->json([]);
        }

        $tags = \App\Models\ArticleTag::search($search)
                    ->take(10)
                    ->get(['id', 'name', 'slug', 'usage_count'])
                    ->map(function($tag) {
                        return [
                            'id' => $tag->id,
                            'text' => $tag->name,
                            'usage_count' => $tag->usage_count,
                        ];
                    });

        return response()->json($tags);
    }

    /**
     * API endpoint for article autocomplete search
     */
    public function autocompleteSearch(Request $request)
    {
        try {
            $search = trim($request->get('search', ''));

            // Validation: minimum 2 characters
            if (strlen($search) < 2) {
                return response()->json([]);
            }

            // Build query with error handling
            $query = Post::where('category', '=', 'article');

            // Search in title and author fields
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%");
            });

            // Smart sorting: relevance first, then popularity, then newest
            $articles = $query->selectRaw('*,
                CASE
                    WHEN title LIKE ? THEN 1
                    WHEN author LIKE ? THEN 2
                    ELSE 3
                END as relevance_score',
                ["%{$search}%", "%{$search}%"]
            )
            ->orderBy('relevance_score')
            ->orderByDesc('views')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get(['id', 'title', 'slug', 'thumbnail', 'author', 'views', 'created_at']);

            // Transform and return results
            $results = $articles->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'thumbnail' => $article->thumbnail,
                    'author' => $article->author,
                    'views' => (int)($article->views ?? 0),
                    'created_at' => $article->created_at->format('d M Y'),
                    'url' => "/artikel/{$article->slug}",
                    'relevance_score' => (int)($article->relevance_score ?? 3)
                ];
            });

            return response()->json($results);

        } catch (\Illuminate\Database\QueryException $e) {
            // Database query errors
            \Log::error('Article autocomplete database error: ' . $e->getMessage());
            return response()->json(['error' => 'Database query failed'], 500);

        } catch (\Exception $e) {
            // General errors
            \Log::error('Article autocomplete error: ' . $e->getMessage());
            return response()->json(['error' => 'Search failed'], 500);
        }
    }

    /**
     * Get comprehensive analytics data for a specific article
     */
    private function getArticleAnalytics($articleId)
    {
        $article = Post::findOrFail($articleId);

        return [
            'currentArticle' => [
                'id' => $article->id,
                'title' => $article->title,
                'views' => $article->views,
                'created_at' => $article->created_at,
                'category' => $article->articleCategory->name ?? 'Uncategorized',
                'reading_time' => $this->estimateReadingTime($article->description),
                'content_length' => strlen(strip_tags($article->description)),
                'word_count' => str_word_count(strip_tags($article->description))
            ],
            'performance' => [
                'category_average' => $this->getCategoryAverageViews($article->category_id),
                'overall_average' => $this->getOverallAverageViews(),
                'vs_category' => $this->calculatePerformanceVsCategory($article->views, $article->category_id),
                'vs_overall' => $this->calculatePerformanceVsOverall($article->views),
                'rank_in_category' => $this->getArticleRankInCategory($articleId, $article->category_id),
                'rank_overall' => $this->getArticleRankOverall($articleId)
            ],
            'trends' => [
                'publication_age' => $article->created_at->diffForHumans(),
                'views_per_day' => $this->calculateViewsPerDay($article->views, $article->created_at),
                'performance_grade' => $this->getPerformanceGrade($article->views, $article->created_at)
            ],
            'comparison' => [
                'top_performing' => $this->getTopPerformingArticles(5),
                'recent_trending' => $this->getRecentTrending(5),
                'category_distribution' => $this->getCategoryViewDistribution()
            ]
        ];
    }

    /**
     * Estimate reading time in minutes
     */
    private function estimateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $wordsPerMinute = 200; // Average reading speed
        $minutes = max(1, ceil($wordCount / $wordsPerMinute));

        return $minutes . ' min read';
    }

    /**
     * Get average views for articles in the same category
     */
    private function getCategoryAverageViews($categoryId)
    {
        if (!$categoryId) return 0;

        return Post::where('category', 'article')
            ->where('category_id', $categoryId)
            ->avg('views') ?? 0;
    }

    /**
     * Get overall average views for all articles
     */
    private function getOverallAverageViews()
    {
        return Post::where('category', 'article')
            ->avg('views') ?? 0;
    }

    /**
     * Calculate performance vs category average
     */
    private function calculatePerformanceVsCategory($articleViews, $categoryId)
    {
        $categoryAvg = $this->getCategoryAverageViews($categoryId);
        if ($categoryAvg == 0) return 0;

        return round((($articleViews - $categoryAvg) / $categoryAvg) * 100, 1);
    }

    /**
     * Calculate performance vs overall average
     */
    private function calculatePerformanceVsOverall($articleViews)
    {
        $overallAvg = $this->getOverallAverageViews();
        if ($overallAvg == 0) return 0;

        return round((($articleViews - $overallAvg) / $overallAvg) * 100, 1);
    }

    /**
     * Get article rank within its category
     */
    private function getArticleRankInCategory($articleId, $categoryId)
    {
        if (!$categoryId) {
            return [
                'rank' => 1,
                'total' => 1,
                'percentile' => 100
            ];
        }

        $rank = Post::where('category', 'article')
            ->where('category_id', $categoryId)
            ->where('views', '>', function($query) use ($articleId) {
                $query->select('views')
                    ->from('posts')
                    ->where('id', $articleId);
            })
            ->count() + 1;

        $total = Post::where('category', 'article')
            ->where('category_id', $categoryId)
            ->count();

        return [
            'rank' => $rank,
            'total' => $total,
            'percentile' => round((($total - $rank + 1) / $total) * 100, 1)
        ];
    }

    /**
     * Get article rank overall
     */
    private function getArticleRankOverall($articleId)
    {
        $rank = Post::where('category', 'article')
            ->where('views', '>', function($query) use ($articleId) {
                $query->select('views')
                    ->from('posts')
                    ->where('id', $articleId);
            })
            ->count() + 1;

        $total = Post::where('category', 'article')->count();

        return [
            'rank' => $rank,
            'total' => $total,
            'percentile' => round((($total - $rank + 1) / $total) * 100, 1)
        ];
    }

    /**
     * Calculate average views per day
     */
    private function calculateViewsPerDay($totalViews, $createdAt)
    {
        $daysSincePublished = $createdAt->diffInDays(now());
        if ($daysSincePublished < 1) $daysSincePublished = 1;

        return round($totalViews / $daysSincePublished, 1);
    }

    /**
     * Get performance grade based on views and publication age
     */
    private function getPerformanceGrade($views, $createdAt)
    {
        $daysSincePublished = $createdAt->diffInDays(now());
        $viewsPerDay = $this->calculateViewsPerDay($views, $createdAt);

        if ($viewsPerDay >= 10) return 'A+';
        if ($viewsPerDay >= 5) return 'A';
        if ($viewsPerDay >= 3) return 'B';
        if ($viewsPerDay >= 1) return 'C';
        if ($viewsPerDay >= 0.5) return 'D';
        return 'F';
    }

    /**
     * Get top performing articles
     */
    private function getTopPerformingArticles($limit = 5)
    {
        return Post::where('category', 'article')
            ->where('views', '>', 0)
            ->orderBy('views', 'desc')
            ->limit($limit)
            ->get(['id', 'title', 'slug', 'views', 'created_at'])
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'views' => $article->views,
                    'formatted_views' => number_format($article->views),
                    'created_at' => $article->created_at->format('d M Y')
                ];
            });
    }

    /**
     * Get recent trending articles (last 30 days)
     */
    private function getRecentTrending($limit = 5)
    {
        return Post::where('category', 'article')
            ->where('created_at', '>=', now()->subDays(30))
            ->where('views', '>', 0)
            ->orderBy('views', 'desc')
            ->limit($limit)
            ->get(['id', 'title', 'slug', 'views', 'created_at'])
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'views' => $article->views,
                    'formatted_views' => number_format($article->views),
                    'created_at' => $article->created_at->format('d M Y'),
                    'days_ago' => $article->created_at->diffForHumans()
                ];
            });
    }

    /**
     * Get category view distribution
     */
    private function getCategoryViewDistribution()
    {
        return \DB::table('posts as p')
            ->select(
                'ac.name as category_name',
                'ac.color as category_color',
                \DB::raw('COUNT(p.id) as article_count'),
                \DB::raw('SUM(p.views) as total_views'),
                \DB::raw('ROUND(AVG(p.views), 1) as avg_views')
            )
            ->leftJoin('article_categories as ac', 'p.category_id', '=', 'ac.id')
            ->where('p.category', 'article')
            ->whereNotNull('p.category_id')
            ->groupBy('ac.id', 'ac.name', 'ac.color')
            ->orderBy('total_views', 'desc')
            ->get()
            ->map(function ($stat) {
                return [
                    'name' => $stat->category_name,
                    'color' => $stat->category_color ?: '#6c757d',
                    'article_count' => $stat->article_count,
                    'total_views' => $stat->total_views,
                    'avg_views' => round($stat->avg_views, 1),
                    'formatted_total_views' => number_format($stat->total_views)
                ];
            });
    }
}
