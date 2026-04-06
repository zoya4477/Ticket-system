<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\FAQ;
use App\Models\KbCategories;
use Illuminate\Http\Request;

class KnowledgeBaseController extends Controller
{
    /**
     * List all articles with optional search filtering
     */
    public function index(Request $request) {
        $searchTerm = $request->input('search');

        $articles = Article::where('is_published', true)
            ->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where(function($q) use ($searchTerm) {
                    $q->where('title', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('content', 'LIKE', "%{$searchTerm}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('kb.index', compact('articles', 'searchTerm'));
    }

    /**
     * Show a single article by ID
     */
    public function showArticle($id) {
        $article = Article::findOrFail($id);
        return view('kb.article', compact('article'));
    }

    /**
     * Show FAQs with optional search filtering
     */
    public function faq(Request $request) {
        $searchTerm = $request->input('search');

        $faqs = FAQ::where('is_published', true)
            ->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where(function($q) use ($searchTerm) {
                    $q->where('question', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('answer', 'LIKE', "%{$searchTerm}%");
                });
            })
            ->get();

        return view('kb.faq', compact('faqs', 'searchTerm'));
    }

    /**
     * Global Search for both Articles and FAQs
     */
    public function search(Request $request) {
        // Renamed 'query' to 'search' to match the input name for consistency
        $query = $request->input('search'); 
        
        if (!$query) {
            return redirect()->route('kb.index');
        }

        $articles = Article::where('is_published', true)
                            ->where(function($q) use ($query) {
                                $q->where('title', 'LIKE', "%$query%")
                                  ->orWhere('content', 'LIKE', "%$query%");
                            })
                            ->get();

        $faqs = FAQ::where('is_published', true)
                    ->where(function($q) use ($query) {
                        $q->where('question', 'LIKE', "%$query%")
                          ->orWhere('answer', 'LIKE', "%$query%");
                    })
                    ->get();

        return view('kb.search', compact('articles', 'faqs', 'query'));
    }

    /**
     * Filter Articles by Category
     */
    public function category($id)
    {
        $category = KbCategories::findOrFail($id);

        $articles = Article::where('category_id', $id)
                            ->where('is_published', true)
                            ->latest()
                            ->get();

        return view('kb.category', compact('category', 'articles'));
    }
}