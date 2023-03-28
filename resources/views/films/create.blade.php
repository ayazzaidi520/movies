<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Film') }}
                            </h2>
                        </header>

                        <form method="post" action="{{ route('api.films.store') }}" class="mt-6 space-y-6"
                            x-data="submitForm()" @submit.prevent="onSubmitPost" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="name" />
                                <x-error-message class="mt-2" x-text="errorMessages.name" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-textarea id="description" name="description" class="mt-1 block w-full"
                                    autocomplete="description" />
                                <x-error-message class="mt-2" x-text="errorMessages.description" />
                            </div>
                            <div>
                                <x-input-label for="release_date" :value="__('Release Date')" />
                                <x-text-input id="release_date" name="release_date" type="text"
                                    class="mt-1 block w-full" placeholder="YYYY-MM-DD" x-mask="9999-99-99"
                                    autocomplete="release_date" />
                                <x-error-message class="mt-2" x-text="errorMessages.release_date" />
                            </div>
                            <div>
                                <x-input-label for="rating" :value="__('Rating')" />
                                <select id="rating" name="rating"
                                    class="'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select Rating</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <x-error-message class="mt-2" x-text="errorMessages.rating" />
                            <div>
                                <x-input-label for="ticket_price" :value="__('Ticket Price')" />
                                <x-text-input id="ticket_price" name="ticket_price" type="text"
                                    class="mt-1 block w-full" placeholder="100.00"
                                    x-mask:dynamic="$money($input, '.', '')" autocomplete="ticket_price" />
                                <x-error-message class="mt-2" x-text="errorMessages.ticket_price" />
                            </div>
                            <div>
                                <x-input-label for="country" :value="__('Country')" />
                                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full"
                                    autocomplete="country" />
                                <x-error-message class="mt-2" x-text="errorMessages.country" />
                            </div>
                            <div>
                                <x-input-label for="genre" :value="__('Genre')" />
                                <x-textarea id="genre" name="genre" class="mt-1 block w-full"
                                    autocomplete="genre" />
                                <x-error-message class="mt-2" x-text="errorMessages.genre" />
                            </div>
                            <div>
                                <x-input-label for="media" :value="__('Photo')" />
                                <x-text-input id="media" name="media" type="file" class="mt-1 block w-full" />
                                <x-error-message class="mt-2" x-text="errorMessages.media" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button ::disabled='isLoading'>{{ __('Save') }}</x-primary-button>
                                    <p x-show="isSuccess" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
