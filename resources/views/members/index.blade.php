<x-guest-layout>
    <h1 class="font-bold text-xl mb-4 dark:text-gray-100">Membres</h1>
    <ul class="grid sm:grid-cols-2 gap-8">
        @foreach ($members as $member)
            <li>
                <a href="{{ route('profile.show', $member) }}" class="flex text-gray-500 bg-white rounded shadow p-4">
                    <div class="flex justify-center items-center">
                        <x-avatar :user="$member" class="w-24 h-24" />
                    </div>
                    <dl class="mt-6 space-y-6">
                        <div class="flex space-x-4">
                            <dt class="text-sm font-medium text-gray-500 w-20 text-right">
                                Nom
                            </dt>
                            <dd class="text-sm text-gray-900">
                                {{ $member->name }}
                            </dd>
                        </div>
                        <div class="flex space-x-4">
                            <dt class="text-sm font-medium text-gray-500 w-20 text-right">
                                Email
                            </dt>
                            <dd class="text-sm text-gray-900">
                                {{ $member->email }}
                            </dd>
                        </div>
                        <div class="flex space-x-4">
                            <dt class="text-sm font-medium text-gray-500 w-20 text-right">
                                Rôle
                            </dt>
                            <dd class="text-sm text-gray-900">
                                {{ $member->role->name }}
                            </dd>
                        </div>
                    </dl>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="flex mt-4 w-full">
        {{$members->links()}}
    </div>
</x-guest-layout>
