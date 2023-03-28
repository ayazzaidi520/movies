<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ Str::title($film->name) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col rounded-lg bg-white shadow-lg dark:bg-neutral-700  md:flex-row">
                    <img class="  rounded-t-lg object-cover h-[300px] w-[300px] md:rounded-none md:rounded-l-lg"
                        src="{{ $film->media ? $film->media->url : asset('assets/images/not-found.png') }}"
                        alt="" />
                    <div class="flex flex-col justify-start p-6">
                        <h5 class="mb-2 text-xl font-medium text-neutral-800 dark:text-neutral-50">
                            {{ Str::title($film->name) }}
                        </h5>
                        <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                            {!! nl2br(e($film->description)) !!}
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Release Date: {{ $film->release_date }}
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Ticket Price: @money($film->ticket_price)
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Rating: {{ $film->rating }}
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Country: {{ $film->country }}
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Genre: {{ $film->genre }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="py-2 ">
                <h1 class="text-xl font-bold">Comments</h1>
                @foreach ($film->comments as $comment)
                    <div class="py-1 bg-white px-4 rounded-xl my-2">
                        <div class="flex gap-2 items-center justify-between">
                            <h2 class="text-sm font-bold">{{ Str::title($comment->user->name) }}</h2>
                            <p class="font-normal text-gray-600 text-sm">{{ now()->parse($comment->created_at)->format('Y-m-d h:i a') }}</p>
                        </div>
                        <p class="text-sm px-4">
                            {!! nl2br(e($comment->comment)) !!}
                        </p>
                    </div>
                @endforeach
            </div>
            <form method="post" action="{{ route('comments.store') }}" class="mt-6 space-y-6" x-data="submitForm()"
                @submit.prevent="onSubmitPost">
                @csrf
                @method('post')
                <div>
                    <input type="hidden" name="film_id" value="{{ $film->id }}" />
                    <x-input-label for="comment" :value="__('Comments')" />
                    <x-textarea id="comment" name="comment" class="mt-1 block w-full" autocomplete="comment"
                        :disabled="!auth()->check()" />
                    <x-error-message class="mt-2" x-text="errorMessages.comment" />
                    @guest
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            If you want to comment, you need to login first.
                        </p>
                    @endguest
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button :disabled="!auth()->check()">{{ __('Save') }}</x-primary-button>
                    <p x-show="isSuccess" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
