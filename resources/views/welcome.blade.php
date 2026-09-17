<x-layout title="PRESTO - Homepage">
    <section class="container py-5">
        <div class="hero-presto p-4 p-lg-5 mb-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3">Dai una seconda vita a ciò che non usi più</h1>
                    <p class="fs-5 mb-4">
                        PRESTO è il portale per comprare e vendere oggetti usati in modo semplice e veloce.
                    </p>
                    <a href="{{ route('article.create') }}" class="btn btn-light btn-lg me-2">
                        Inserisci annuncio
                    </a>
                    <a href="{{ route('article.index') }}" class="btn btn-outline-light btn-lg">
                        Tutti gli annunci
                    </a>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 mb-0">Ultimi annunci</h2>
            <a href="{{ route('article.index') }}" class="small">Vedi tutti</a>
        </div>

        <div class="row g-4 mb-5">
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted mb-0">Non ci sono ancora annunci. Pubblica il primo!</p>
                </div>
            @endforelse
        </div>

        @isset($categories)
            <h2 class="h4 mb-3">Categorie</h2>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <a href="{{ route('article.byCategory', compact('category')) }}" class="category-pill text-decoration-none text-dark">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endisset
    </section>
</x-layout>
