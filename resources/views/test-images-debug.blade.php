<!DOCTYPE html>
<html>
<head>
    <title>Debug Images</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .article { border: 1px solid #ccc; margin: 10px 0; padding: 15px; }
        .debug-info { background: #f5f5f5; padding: 10px; margin: 5px 0; }
        img { max-width: 200px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h1>Image Debug Page</h1>
    
    @foreach($articles as $article)
    <div class="article">
        <h3>{{ $article->judul }}</h3>
        <div class="debug-info">
            <strong>ID:</strong> {{ $article->id }}<br>
            <strong>Image Path in DB:</strong> {{ $article->gambar }}<br>
            <strong>Asset URL:</strong> {{ asset('storage/' . $article->gambar) }}<br>
            <strong>File Exists:</strong> {{ file_exists(public_path('storage/' . $article->gambar)) ? 'YES' : 'NO' }}
        </div>
        
        @if($article->gambar)
            <div>
                <strong>Image Display Test:</strong><br>
                <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" 
                     onerror="this.alt='IMAGE FAILED TO LOAD: {{ asset('storage/' . $article->gambar) }}'">
            </div>
        @else
            <p><em>No image for this article</em></p>
        @endif
    </div>
    @endforeach
    
    @if($articles->isEmpty())
        <p>No articles found in database.</p>
    @endif
</body>
</html>
