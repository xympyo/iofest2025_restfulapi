@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="min-h-screen bg-[#f8f9fa] flex flex-col" x-data="adminDashboard()">
    <!-- Header/Navbar -->
    <nav class="flex justify-between items-center px-6 py-4 bg-white shadow-sm sticky top-0 z-30">
        <div class="flex items-center">
            <img src="{{ asset('logo.png') }}" alt="TappyTale Forge Logo" class="h-7 mr-2">
            <a href="{{ url('/') }}">
                <span class="text-xl font-bold text-[#F8B6B6]">TappyTale</span><span class="text-xl font-bold text-[#30313E] ml-1">Forge</span>
            </a>
            <span class="ml-4 px-3 py-1 rounded bg-[#9F9CCC]/20 text-[#9F9CCC] font-semibold text-sm">Admin Dashboard</span>
        </div>
        <div class="flex items-center gap-6">
            @auth
                <span class="font-semibold text-[#30313E]">{{ Auth::user()->username }}</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-[#ff5e5e] text-white font-bold text-md shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#ffbaba]/40 transition">
                        Log Out
                    </button>
                </form>
            @endauth
        </div>
    </nav>
    <!-- Section Title & Controls -->
    <div class="w-full max-w-5xl mx-auto mt-8 mb-4 px-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#23232B]">Manage Storybooks</h1>
                <div class="h-1 w-20 bg-[#F8B6B6] rounded mt-2"></div>
            </div>
            <!-- Sorting & Filtering Controls -->
            <div class="flex gap-4 flex-wrap">
                <select class="rounded-lg border border-[#e1e1fa] px-4 py-2 focus:ring-2 focus:ring-[#9F9CCC]/30" x-model="sortOrder">
                    <option value="unapproved_first">Unapproved First</option>
                    <option value="approved_first">Approved First</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                </select>
                <select class="rounded-lg border border-[#e1e1fa] px-4 py-2 focus:ring-2 focus:ring-[#9F9CCC]/30" x-model="filterStatus">
                    <option value="all">All Status</option>
                    <option value="unapproved">Unapproved Only</option>
                    <option value="approved">Approved Only</option>
                </select>
                <template x-if="genreOptions.length">
                    <select class="rounded-lg border border-[#e1e1fa] px-4 py-2 focus:ring-2 focus:ring-[#9F9CCC]/30" x-model="filterGenre">
                        <option value="all">All Genres</option>
                        <template x-for="g in genreOptions" :key="g">
                            <option x-text="g"></option>
                        </template>
                    </select>
                </template>
            </div>
        </div>
    </div>
    <!-- Storybook Cards -->
    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-8 px-4 pb-16">
        <template x-for="sb in filteredStorybooks" :key="sb.id">
    <div class="relative rounded-3xl shadow-xl overflow-hidden group cursor-pointer bg-white hover:shadow-2xl hover:-translate-y-1 transition-all border border-[#e1e1fa]" @click="openStorybook(sb.id)">
        <!-- Gradient overlay (does not block content) -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#23232Bcc] to-transparent z-10 pointer-events-none"></div>
        <img :src="sb.background_image" alt="bg" class="w-full h-64 object-cover">
        <!-- Badge -->
        <div class="absolute top-4 right-4 z-20">
            <span :class="sb.is_approved ? 'bg-green-500' : 'bg-gray-400'" class="px-3 py-1 rounded-full text-xs font-bold text-white shadow">
                <span x-text="sb.is_approved ? 'Approved' : 'Unapproved'"></span>
            </span>
        </div>
        <div class="absolute bottom-0 left-0 right-0 p-6 z-20 flex flex-col gap-2">
            <div class="flex items-center gap-4 mb-2">
                <img :src="sb.storybook_profile" class="w-14 h-14 rounded-full border-4 border-white shadow-lg">
                <div>
                    <div class="text-xl font-bold text-white drop-shadow" x-text="sb.title"></div>
                    <div class="text-sm text-[#e1e1fa] drop-shadow" x-text="sb.genres.map(g => g.name).join(', ')"></div>
                </div>
            </div>
            <div class="text-[#e1e1fa] mb-2 drop-shadow" x-text="sb.description"></div>
            <div class="flex flex-wrap gap-4 text-[#bdb6e6] text-sm">
                <div>Words: <span class="font-bold" x-text="sb.storybook_words"></span></div>
                <div>Read Time: <span class="font-bold" x-text="sb.read_time + ' min'"></span></div>
                <div>Pages: <span class="font-bold" x-text="sb.pages_number"></span></div>
            </div>
            <div class="mt-2">
                <button
                    @click.stop="approveStorybook(sb.id, $event, !sb.is_approved)"
                    :class="sb.is_approved ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700'"
                    class="px-6 py-2 rounded-lg font-bold text-white shadow-md transition-all"
                >
                    <span x-text="sb.is_approved ? 'Disapprove' : 'Approve'"></span>
                </button>
            </div>
        </div>
    </div>
</template>
        <!-- Fallback for no storybooks -->
        <template x-if="!filteredStorybooks.length">
            <div class="col-span-2 text-center text-gray-400 py-16 text-lg font-semibold">No storybooks found.</div>
        </template>
    </div>
    <!-- Modal -->
    <template x-if="showModal">
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" @click.self="closeModal">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl p-8 overflow-y-auto max-h-[90vh] animate-fade-in">
                <button @click="closeModal" class="absolute top-4 right-4 text-3xl font-bold text-gray-600 hover:text-gray-900">&times;</button>
                <template x-if="modalStorybook">
                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <img :src="modalStorybook.storybook_profile" class="w-16 h-16 rounded-full border-4 border-[#9F9CCC]">
                            <div>
                                <div class="text-2xl font-bold" x-text="modalStorybook.title"></div>
                                <div class="text-sm text-[#9F9CCC]" x-text="modalStorybook.genres.map(g => g.name).join(', ')"></div>
                            </div>
                        </div>
                        <div class="mb-2 text-gray-700" x-text="modalStorybook.description"></div>
                        <div class="flex flex-wrap gap-4 text-[#9F9CCC] text-sm mb-4">
    <div>Words: <span class="font-bold" x-text="modalStorybook.storybook_words"></span></div>
    <div>Read Time: <span class="font-bold" x-text="modalStorybook.read_time + ' min'"></span></div>
    <div>Pages: <span class="font-bold" x-text="modalStorybook.pages_number"></span></div>
</div>
                        <template x-for="(page, pIdx) in modalStorybook.pages" :key="pIdx">
                            <div class="mb-6">
                                <div class="font-bold text-lg mb-2">Page <span x-text="pIdx + 1"></span></div>
                                <template x-for="(panel, paIdx) in page.panels" :key="paIdx">
                                    <div class="mb-2 p-4 rounded-lg bg-[#f4f4fa] shadow">
                                        <div class="font-semibold text-[#23232B] mb-1">Panel <span x-text="paIdx + 1"></span></div>
                                        <template x-for="(content, cIdx) in panel.panels_content" :key="cIdx">
                                            <div class="flex gap-4 items-center mb-1">
                                                <img :src="content.image" class="w-16 h-16 object-cover rounded-lg border">
                                                <div class="flex-1">
                                                    <div class="text-xs text-gray-500">Top: <span x-text="content.top_text"></span> <span class="ml-2">(<span x-text="content.top_text_align"></span>)</span></div>
                                                    <div class="text-xs text-gray-500">Middle: <span x-text="content.middle_text"></span> <span class="ml-2">(<span x-text="content.middle_text_align"></span>)</span></div>
                                                    <div class="text-xs text-gray-500">Bottom: <span x-text="content.bottom_text"></span> <span class="ml-2">(<span x-text="content.bottom_text_align"></span>)</span></div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>
<!-- CSRF token for AJAX (if not already in your layout) -->
@if (!request()->hasHeader('X-CSRF-TOKEN'))
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endif
<script>
    window.__storybooks = @json($storybooks);
</script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function adminDashboard() {
    // Get all genres for filter dropdown
    const allGenres = (window.__storybooks || []).flatMap(sb => sb.genres.map(g => g.name));
    const uniqueGenres = Array.from(new Set(allGenres));
    return {
        showModal: false,
        modalStorybook: null,
        approvedIds: [],
        storybooks: window.__storybooks,
        sortOrder: 'unapproved_first',
        filterStatus: 'all',
        filterGenre: 'all',
        genreOptions: uniqueGenres,
        get filteredStorybooks() {
            let arr = this.storybooks.slice();
            // Filter by approval
            if (this.filterStatus === 'approved') arr = arr.filter(sb => sb.is_approved);
            else if (this.filterStatus === 'unapproved') arr = arr.filter(sb => !sb.is_approved);
            // Filter by genre
            if (this.filterGenre !== 'all') arr = arr.filter(sb => sb.genres.some(g => g.name === this.filterGenre));
            // Sort
            if (this.sortOrder === 'unapproved_first') arr.sort((a, b) => a.is_approved - b.is_approved || new Date(b.created_at) - new Date(a.created_at));
            else if (this.sortOrder === 'approved_first') arr.sort((a, b) => b.is_approved - a.is_approved || new Date(b.created_at) - new Date(a.created_at));
            else if (this.sortOrder === 'newest') arr.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            else if (this.sortOrder === 'oldest') arr.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            return arr;
        },
        openStorybook(id) {
            const sb = this.storybooks.find(s => s.id === id);
            if (sb) {
                this.modalStorybook = JSON.parse(JSON.stringify(sb));
                this.showModal = true;
            }
        },
        closeModal() {
            this.showModal = false;
            this.modalStorybook = null;
        },
        approveStorybook(id, event, approve) {
            event.stopPropagation();
            fetch('/admin/approve', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ id, approve })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    const idx = this.storybooks.findIndex(s => s.id === id);
                    if (idx !== -1) this.storybooks[idx].is_approved = data.is_approved;
                }
            });
        },
    }
}
document.addEventListener('alpine:init', () => { Alpine.data('adminDashboard', adminDashboard); });
</script>
