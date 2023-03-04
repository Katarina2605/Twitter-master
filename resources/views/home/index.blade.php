<x-guest-layout>

    <div>
        <ul class="flex flex-col space-y-4">
            @foreach ($tweets as $tweet)
                <li class="flex flex-col ">
                    <x-tweet-card :tweet="$tweet" />
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $tweets->links() }}
        </div>
    </div>

</x-guest-layout>
