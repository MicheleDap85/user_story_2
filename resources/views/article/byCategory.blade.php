<x-layout title="{{ $category->name }} - PRESTO">
    <section class="container py-5">
        <h1 class="h3 mb-4">Annunci in {{ $category->name }}</h1>

        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted mb-0">Non ci sono ancora annunci in questa categoria.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    </section>
</x-layout>
