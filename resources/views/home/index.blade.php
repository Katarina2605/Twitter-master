<x-guest-layout>

    <div>
        <ul class="flex flex-col space-y-4">
            @foreach ($articles as $article)
                <li class="flex flex-col ">
                    <x-tweet-card :tweet="$article" />
                </li>
            @endforeach
        </ul>

    </div>

</x-guest-layout>
