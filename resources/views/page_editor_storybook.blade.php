@extends('layouts.app')

@section('title', 'Page Editor Storybook')

@section('content')
    <div x-data="pageEditor()" class="flex h-screen w-full overflow-hidden bg-[#292838]">
        <!-- Left Panel -->
        <div class="w-full max-w-xl h-full overflow-y-auto px-8 py-10 flex flex-col gap-6">
            <div class="mb-6">
                <label class="block mb-2 font-bold text-white">Set Number of Panels for Each Page</label>
                <template x-for="(page, idx) in pages" :key="idx">
                    <div class="mb-2 flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <span class="text-white" x-text="'Page ' + (idx + 1) + ':'"></span>
                            <input type="number" min="0" max="3" x-model.number="pages[idx].panels.panels_number"
                                @input="handlePanelInput(idx)" @focus="clearError(idx)" placeholder="1-3"
                                class="w-20 rounded-lg px-2 py-1 bg-[#ECECFA] text-[#30313E] focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]" />
                        </div>
                        <template x-if="errors[idx]">
                            <p class="text-red-500 text-xs mt-1" x-text="errors[idx]"></p>
                        </template>
                    </div>
                </template>
                <p class="text-white text-sm mt-2">Set the number of panels for <span x-text="storybook.pages"></span> pages. All must be set (1-3) before continuing.</p>
            </div>
            <div class="mt-8 flex flex-row justify-between">
                <button @click="backToEditor"
                    class="px-6 py-3 rounded-lg bg-white text-[#23232B] font-bold text-md shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition">Back
                    to Storybook Editor</button>
                <button @click="goToPanelEditor" :disabled="!canGoToPanelEditor"
                    class="px-6 py-3 rounded-lg bg-[#9F9CCC] text-white font-bold text-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition disabled:opacity-50 disabled:cursor-not-allowed">Go
                    to Panel Editor</button>
            </div>
        </div>
        <!-- Right Phone Preview -->
        <div class="flex-1 flex flex-col items-center justify-center relative bg-white">
            <div class="absolute top-10 right-10 flex items-center gap-4">
                <span class="text-[#30313E] text-xl font-bold" x-text="username"></span>
                <button class="px-6 py-2 rounded-lg bg-[#bdb6e6] text-white font-bold text-sm shadow-md">Finish
                    Storybook</button>
            </div>
            <div class="flex flex-row items-center">
                <button @click="prevPage" :disabled="currentPage === 0"
                    class="me-4 px-6 py-6 rounded-4xl bg-[#30313E] h-4 w-4 relative disabled:opacity-50 disabled:cursor-not-allowed">
                    <p class="text-white font-extrabold left-0 right-0 top-3 absolute">&lt;</p>
                </button>
                <div class="mt-12 flex flex-col items-center">
                    <div class="rounded-3xl border-8 border-[#23232B] w-[200px] h-[420px] flex flex-col justify-between items-center bg-[#f4f4fa] relative overflow-hidden"
                        :style="storybook.bg ? 'background-image: url(' + storybook.bg +
                            '); background-size: cover; background-position: center;' : ''">
                        <!-- Panels dynamically rendered -->
                        <template x-for="i in pages[currentPage].panels.panels_number" :key="i">
                            <div
                                class="p-4 flex-1 w-full flex flex-col items-center justify-center border-b last:border-b-0 border-[#23232B] cursor-pointer group">
                                <svg class="w-10 h-10 text-[#9F9CCC] mx-auto" fill="none" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3" stroke="#9F9CCC" stroke-width="2" />
                                </svg>
                                <span class="text-[#9F9CCC] text-center font-semibold">Click here to edit your panels</span>
                            </div>
                        </template>
                    </div>
                    <div class="mt-4 text-lg font-bold text-[#23232B]"
                        x-text="(currentPage+1) + '/' + storybook.pages + ' Page'"></div>
                    <div class="mt-2 text-2xl font-bold text-[#23232B]" x-text="storybook.title || 'Aku Kian Santang'">
                    </div>
                </div>
                <button @click="nextPage" :disabled="currentPage === storybook.pages - 1"
                    class="ms-4 px-6 py-6 rounded-4xl bg-[#30313E] h-4 w-4 relative disabled:opacity-50 disabled:cursor-not-allowed">
                    <p class="text-white font-extrabold left-0 right-0 top-3 absolute">&gt;</p>
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function pageEditor() {
            // Load storybook and pages from sessionStorage
            let storybook = JSON.parse(sessionStorage.getItem('storybook')) || {
                title: sessionStorage.getItem('sb_title') || '',
                description: sessionStorage.getItem('sb_desc') || '',
                pages: Number(sessionStorage.getItem('sb_pages')) || 6,
                bg: sessionStorage.getItem('sb_bg') || '',
                profile: sessionStorage.getItem('sb_profile') || '',
            };
            let pages = JSON.parse(sessionStorage.getItem('pages'));
            if (!pages) {
                pages = Array.from({
                    length: storybook.pages
                }, (_, i) => ({
                    id: i + 1,
                    page_information: i + 1,
                    panels: {
                        id_pages: i + 1,
                        panels_number: 0,
                        panels_content: []
                    }
                }));
                sessionStorage.setItem('pages', JSON.stringify(pages));
            }
            return {
                storybook: storybook,
                username: '{{ Auth::user() ? Auth::user()->username : '' }}',
                currentPage: 0,
                pages: pages,
                errors: [],
                savePages() {
                    sessionStorage.setItem('pages', JSON.stringify(this.pages));
                },
                handlePanelInput(idx) {
                    // If value > 3, set to 3 and show error
                    if (this.pages[idx].panels.panels_number > 3) {
                        this.pages[idx].panels.panels_number = 3;
                        this.errors[idx] = `The maximum is 3, so we automatically puts the Panel of Page ${idx+1} to 3.`;
                    } else {
                        this.errors[idx] = '';
                    }
                    this.savePages();
                },
                clearError(idx) {
                    this.errors[idx] = '';
                },
                get canGoToPanelEditor() {
                    return this.pages.every(page => page.panels.panels_number >= 1 && page.panels.panels_number <= 3);
                },
                goToPanelEditor() {
                    if (!this.canGoToPanelEditor) {
                        alert('Please set the number of panels (1-3) for all pages before continuing.');
                        return;
                    }
                    sessionStorage.setItem('pages', JSON.stringify(this.pages));
                    sessionStorage.setItem('currentPage', 0);
                    window.location.href = '/panel-editor-storybook';
                },
                prevPage() {
                    if (this.currentPage > 0) {
                        this.currentPage--;
                    }
                },
                nextPage() {
                    if (this.currentPage < this.storybook.pages - 1) {
                        this.savePanels();
                        this.currentPage++;
                        this.panelsNumber = this.pages[this.currentPage].panels.panels_number;
                    }
                },
                savePanels() {
                    this.pages[this.currentPage].panels.panels_number = this.panelsNumber;
                    sessionStorage.setItem('pages', JSON.stringify(this.pages));
                },
                backToEditor() {
                    this.savePanels();
                    window.location.href = '{{ route('create_storybook') }}';
                },
                $watch: {
                    panelsNumber(value) {
                        this.pages[this.currentPage].panels.panels_number = value;
                        sessionStorage.setItem('pages', JSON.stringify(this.pages));
                    }
                }
            };
        }
    </script>
@endsection
