<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.pages.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $gambar = $request->file('gambar');
        $gambarPath = $gambar->store('articles', 'public');
        //$gambarUrl = 'storage/' . $gambarPath;

        Article::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'gambar' => $gambarPath, // simpan path dengan awalan 'storage/'
            'status' => $request->status,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Article $article)
    {
        return view('admin.pages.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'status' => $request->status
        ];

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($article->gambar) {
                Storage::disk('public')->delete($article->gambar);
            }
            
            // Store new image
            $gambar = $request->file('gambar');
            $data['gambar'] = $gambar->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Article $article)
    {
        if ($article->gambar) {
            Storage::disk('public')->delete($article->gambar);
        }
        
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil dihapus');
    }

    public function show(Article $article)
    {
        return view('admin.pages.articles.show', compact('article'));
    }
}
