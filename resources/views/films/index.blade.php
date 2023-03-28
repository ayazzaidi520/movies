<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Films Lists') }}
        </h2>
    </x-slot>

    <div class="py-12" id="laravelPagination" data-url="{{ route('api.films.index') }}" x-data="laravelPagination()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <template x-for="item in films" :key="item.id">
                <div class="grid grid-cols-2 gap-4 px-10 flex items-center py-10">
                    <template x-if="item.media?.url === undefined">
                        <div class="rounded"><img class="rounded-xl"
                                src={{ asset('assets/images/not-found.png') }}
                                alt="no logo">
                        </div>
                    </template>
                    <template x-if="item.media?.url !== undefined">
                        <div class="rounded"><img class="rounded-xl"
                                :src=`${item.media?.url}`
                                alt="no logo">
                        </div>
                    </template>
                    <div class="text-left">
                        <a
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out"
                        :href=`films/${item.slug}` href="films/">
                            View Details
                        </a>
                        <h2 class="text-xl font-bold py-2" x-text="item.name"></h2>
                        <p x-text="item.description"></p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Release Date: <span x-text="item.release_date"></span>
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Ticket Price: $<span x-text="item.ticket_price"></span>
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Rating: <span x-text="item.rating"></span>
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Country: <span x-text="item.country"></span>
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-300">
                            Genre: <span x-text="item.genre"></span>
                        </p>
                    </div>
                </div>
                </template>
                <nav class="navbar navbar-expand-lg p-0 mb-5 my-4 flex flex-row justify-center">
                    <ul class="pagination mb-0 flex gap-4 my-4">
                        <li class="page-item" :class="{ 'disabled': 1 == pagination.current_page }">
                            <a href="javascript:void(0)" class="page-link" aria-label="Previous"
                                @click.prevent="changePage(pagination.current_page - 1)">
                                <span class="bg-blue-300 text-white font-bold p-2 rounded-xl">Previous</span>
                            </a>
                        </li>
                        <template x-for="page in pagesNumber()">
                            <li class="page-item" :class="{ 'active': page == current_page }">
                                <a href="javascript:void(0)" class="page-link focus:bg-blue-300 p-2 rounded-xl"
                                    @click.prevent="changePage(page)" x-text="page"></a>
                            </li>
                        </template>
                        <li class="page-item"
                            :class="{ 'disabled': pagination.last_page == pagination.current_page }">
                            <a href="javascript:void(0)" aria-label="Next" class="page-link"
                                @click.prevent="changePage(pagination.current_page + 1)">
                                <span aria-hidden="true"
                                    class="bg-blue-300 text-white font-bold p-2 rounded-xl">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    @pushOnce('script')
        <script>
            function laravelPagination() {
                return {
                    path: document.getElementById('laravelPagination').dataset.url,
                    films: [],
                    pagination: {},
                    offset: 4,
                    pages: [],
                    goto: null,
                    search: null,
                    gotopages() {
                        if (this.goto && this.goto <= this.pagination.last_page) {
                            this.changePage(this.goto);
                        }
                    },
                    pagesNumber() {
                        if (!this.pagination.to) {
                            return [];
                        }
                        let from = this.pagination.current_page - this.offset;
                        if (from < 1) {
                            from = 1;
                        }
                        let to = from + (this.offset * 2);
                        if (to >= this.pagination.last_page) {

                            to = this.pagination.last_page;
                        }
                        let pagesArray = [];
                        for (let page = from; page <= to; page++) {
                            pagesArray.push(page);
                        }

                        return pagesArray;
                    },
                    changePage(number) {
                        let self = this;
                        number = number ? number : localStorage.getItem('current_page', number);
                        return fetch(`${this.path}?page=${number}`).then(function(response) {
                            return response.json();
                        }).then(function(res) {
                            self.pagination = res;
                            self.current_page = res.current_page;
                            self.films = res.data;
                            self.pages = self.pagesNumber();
                            self.goto = null;
                            localStorage.setItem('current_page', number);

                            return res;

                        }).catch(console.error);

                    },
                    buildUrl(page = 1) {
                        const params = new URLSearchParams({
                            page: page,
                            search: this.search,
                        });

                        return params.toString();
                    },
                    init() {
                        let self = this;
                        this.changePage(this.pagination.current_page);
                    }
                }
            }
        </script>
    @endpushOnce
</x-app-layout>
