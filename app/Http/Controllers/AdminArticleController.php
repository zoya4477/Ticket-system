<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\KbCategory;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{

    // Show All Articles
    public function index()
    {
        $articles = Article::with('category')->latest()->get();

        return view('admin.articles.index', compact('articles'));
    }


    // Show Create Article Form
    public function create()
    {
        $categories = KbCategory::all();

        return view('admin.articles.create', compact('categories'));
    }


    // Store Article
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:kb_categories,id',
            'content' => 'required',
        ]);

        Article::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'is_published' => true,
        ]);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Article created successfully.');
    }


    // Edit Article
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = KbCategory::all();

        return view('admin.articles.edit', compact('article','categories'));
    }


    // Update Article
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:kb_categories,id',
            'content' => 'required',
        ]);

        $article = Article::findOrFail($id);

        $article->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.articles.index')
                         ->with('success','Article updated successfully');
    }


    // Delete Article
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return redirect()->route('admin.articles.index')
                         ->with('success','Article deleted successfully');
    }

}