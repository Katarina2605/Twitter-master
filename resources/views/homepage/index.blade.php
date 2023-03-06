<x-guest-layout>
    <h1 class="font-bold text-xl mb-4 dark:text-gray-100">Derniers articles</h1>
    <ul class="grid sm:grid-cols-2 gap-8">
        @foreach ($articles as $article)
            <li>
                <x-article-card :article="$article" />
            </li>
        @endforeach
    </ul>

    <div class="mt-8 flex items-center justify-center">
        <a href="{{ route('front.articles.index') }}" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow">
            Liste des articles
        </a>
    </div>
</x-guest-layout>
