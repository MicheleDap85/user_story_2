<x-layout title="{{ $article->title }} - PRESTO">
    <section class="container py-5">
        <div class="row g-4">
            <div class="col-lg-7">
                <div id="articleCarousel" class="carousel slide shadow-sm rounded overflow-hidden" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @for ($i = 0; $i < 4; $i++)
                            <button type="button" data-bs-target="#articleCarousel" data-bs-slide-to="{{ $i }}"
                                class="{{ $i === 0 ? 'active' : '' }}"
                                aria-current="{{ $i === 0 ? 'true' : 'false' }}"
                                aria-label="Foto {{ $i + 1 }}"></button>
                        @endfor
                    </div>
                    <div class="carousel-inner">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="carousel-item {{ $i === 1 ? 'active' : '' }}">
                                <img
                                    src="https://picsum.photos/seed/article-{{ $article->id }}-{{ $i }}/900/560"
                                    class="d-block w-100 article-carousel-image"
                                    alt="Foto segnaposto {{ $i }} di {{ $article->title }}"
                                >
                            </div>
                        @endfor
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#articleCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Precedente</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#articleCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Successiva</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-5">
                <p class="mb-2">
                    <a href="{{ route('article.byCategory', $article->category) }}" class="badge text-bg-light text-decoration-none border">
                        {{ $article->category->name }}
                    </a>
                </p>
                <h1 class="h3">{{ $article->title }}</h1>
                <p class="display-6 fw-semibold text-success">{{ number_format($article->price, 2, ',', '.') }} €</p>
                <p class="text-muted">Pubblicato da {{ $article->user->name }} il {{ $article->created_at->format('d/m/Y') }}</p>
                <hr>
                <h2 class="h5">Descrizione</h2>
                <p>{{ $article->description }}</p>
                <a href="{{ route('article.index') }}" class="btn btn-outline-secondary">Torna agli annunci</a>
            </div>
        </div>
    </section>
</x-layout>
