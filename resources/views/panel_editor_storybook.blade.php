@extends('layouts.app')

@section('title', 'Panel Editor Storybook')

@section('content')
    <div x-data="panelEditor()" class="flex h-screen w-full overflow-hidden bg-[#292838]">
        <!-- Left Panel Editor -->
        <div class="w-full max-w-xl h-full overflow-y-auto px-8 py-10 flex flex-col gap-6">
            <template x-if="panels.length > 0">
                <div>
                    <div class="mb-6">
                        <label class="block mb-2 font-bold text-white">Edit Panel <span
                                x-text="selectedPanelIdx+1"></span></label>
                    </div>
                    <!-- Image Upload -->
                    <div class="mb-4">
                        <button @click="toggleImg" type="button"
                            class="w-full flex items-center justify-between px-4 py-3 rounded-lg bg-gradient-to-b from-slate-400/10 to-slate-400 text-white font-semibold text-left shadow-md">
                            Panel Image
                            <svg :class="{ 'rotate-90': imgOpen }" class="transition-transform duration-300 w-6 h-6 ml-2"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="imgOpen" x-transition class="mt-2 bg-[#bdb6e6]/30 rounded-lg p-4 relative">
                            <label
                                class="flex flex-col items-center justify-center h-40 border-2 border-dashed border-[#a3a3c2] rounded-lg cursor-pointer hover:bg-[#e1e1fa] transition">
                                <input type="file" class="hidden" @change="uploadImg($event)" accept="image/*">
                                <template x-if="!panels[selectedPanelIdx].image">
                                    <>
                                        <svg class="w-16 h-16 mb-2 text-[#a3a3c2]" fill="none" viewBox="0 0 24 24">
                                            <path d="M12 16V8m0 0l-4 4m4-4l4 4" stroke="#a3a3c2" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <rect x="3" y="3" width="18" height="18" rx="2" stroke="#a3a3c2"
                                                stroke-width="2" />
                                        </svg>
                                        <span class="font-semibold text-center text-[#23232B]">Upload your image, or drag it
                                            here.<br><span class="text-xs">The image should be 1920x1080, 960x1080, or
                                                640x1080 px.</span></span>
                                    </>
                                </template>
                                <template x-if="panels[selectedPanelIdx].image">
                                    <img :src="panels[selectedPanelIdx].image" alt="Panel Image Preview"
                                        class="object-cover w-full h-32 rounded-lg" />
                                </template>
                            </label>
                            <button x-show="panels[selectedPanelIdx].image" @click="removeImg" type="button"
                                class="absolute bottom-2 right-2 bg-[#ff5e5e] hover:bg-[#e53e3e] text-white rounded-full p-2 shadow-md transition"
                                title="Remove image">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Text Inputs -->
                    <div class="mb-3">
                        <label class="block text-white">Upper Text
                            <input type="text" x-model="panels[selectedPanelIdx].top_text" @input="savePanels"
                                placeholder="Leave empty if none."
                                class="mt-1 w-full rounded-lg px-4 py-2 bg-[#ECECFA] text-[#30313E] placeholder:text-[#9F9CCC] placeholder:font-light focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]" />
                        </label>
                        <select x-model="panels[selectedPanelIdx].top_text_align" @change="savePanels"
                            class="mt-1 w-full rounded-lg px-4 py-2 bg-[#ECECFA] text-[#30313E] focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]">
                            <option value="TextAlign.left">Left</option>
                            <option value="TextAlign.center">Middle</option>
                            <option value="TextAlign.right">Right</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block text-white">Middle Text
                            <input type="text" x-model="panels[selectedPanelIdx].middle_text" @input="savePanels"
                                placeholder="Leave empty if none."
                                class="mt-1 w-full rounded-lg px-4 py-2 bg-[#ECECFA] text-[#30313E] placeholder:text-[#9F9CCC] placeholder:font-light focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]" />
                        </label>
                        <select x-model="panels[selectedPanelIdx].middle_text_align" @change="savePanels"
                            class="mt-1 w-full rounded-lg px-4 py-2 bg-[#ECECFA] text-[#30313E] focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]">
                            <option value="TextAlign.left">Left</option>
                            <option value="TextAlign.center">Middle</option>
                            <option value="TextAlign.right">Right</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block text-white">Lower Text
                            <input type="text" x-model="panels[selectedPanelIdx].bottom_text" @input="savePanels"
                                placeholder="Leave empty if none."
                                class="mt-1 w-full rounded-lg px-4 py-2 bg-[#ECECFA] text-[#30313E] placeholder:text-[#9F9CCC] placeholder:font-light focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]" />
                        </label>
                        <select x-model="panels[selectedPanelIdx].bottom_text_align" @change="savePanels"
                            class="mt-1 w-full rounded-lg px-4 py-2 bg-[#ECECFA] text-[#30313E] focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]">
                            <option value="TextAlign.left">Left</option>
                            <option value="TextAlign.center">Middle</option>
                            <option value="TextAlign.right">Right</option>
                        </select>
                    </div>
                </div>
            </template>
            <div class="mt-8 flex flex-row justify-between">
                <button @click="backToPageEditor"
                    class="px-6 py-3 rounded-lg bg-white text-[#23232B] font-bold text-md shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition">Back
                    to Page Editor</button>
                <template x-if="currentPage === storybook.pages - 1">
                    <button
                        :disabled="!canFinishStorybook()"
                        @click="canFinishStorybook() ? finishStorybook() : null"
                        class="px-6 py-3 rounded-lg font-bold text-lg shadow-lg transition"
                        :class="canFinishStorybook() ? 'bg-[#9F9CCC] text-white hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40' : 'bg-gray-300 text-gray-400 cursor-not-allowed opacity-60'"
                    >Finish Storybook</button>
                </template>
                <template x-if="currentPage !== storybook.pages - 1">
                    <button
                        @click="nextPage"
                        class="px-6 py-3 rounded-lg bg-[#9F9CCC] text-white font-bold text-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition"
                    >Next
                        Page</button>
                </template>
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
                    <div
                        class="rounded-3xl border-8 border-[#23232B] w-[200px] h-[420px] flex flex-col justify-between items-center bg-[#f4f4fa] relative overflow-hidden">
                        <template x-for="(panel, idx) in panels" :key="idx">
                            <div @click="selectPanel(idx)"
                                :class="'flex-1 w-full flex flex-col items-center justify-center border-b last:border-b-0 border-[#23232B] cursor-pointer group relative overflow-hidden ' +
                                (selectedPanelIdx === idx ? 'bg-[#ececfa]' : '')"
                                style="min-height:0;">
                                <template x-if="panel.image">
                                    <img :src="panel.image"
                                        class="absolute top-0 left-0 w-full h-full object-cover z-0"
                                        style="border-radius:0;" />
                                </template>
                                <div class="relative z-10 w-full h-full flex flex-col justify-between">
                                    <!-- Panel text: top, middle, bottom layout -->
                                    <div class="relative w-full h-full">
                                        <template x-if="panel.top_text">
                                            <div :class="'absolute px-2 left-0 right-0 top-2 text-[#23232B] font-bold w-full'"
                                                :style="'text-align:' + textAlignCss(panel.top_text_align)">
                                                <span x-text="panel.top_text" :class="'storybook-panel-text storybook-panel-text-rows-' + panels.length"></span>
                                            </div>
                                        </template>
                                        <template x-if="panel && panel.middle_text">
                                            <div :class="'absolute px-2 left-0 right-0 top-1/2 -translate-y-1/2 text-[#23232B] font-semibold w-full'"
                                                :style="'text-align:' + textAlignCss(panel.middle_text_align)">
                                                <span x-text="panel.middle_text" :class="'storybook-panel-text storybook-panel-text-rows-' + panels.length"></span>
                                            </div>
                                        </template>
                                        <template x-if="panel && panel.bottom_text">
                                            <div :class="'absolute px-2 left-0 right-0 bottom-2 text-[#23232B] font-medium w-full'"
                                                :style="'text-align:' + textAlignCss(panel.bottom_text_align)">
                                                <span x-text="panel.bottom_text" :class="'storybook-panel-text storybook-panel-text-rows-' + panels.length"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <template x-if="panel && !panel.top_text && !panel.middle_text && !panel.bottom_text && !panel.image">
                                    <span class="text-[#9F9CCC] text-center font-semibold">Click here to edit your panels</span>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
                <button @click="nextPage" :disabled="currentPage === storybook.pages - 1"
                    class="ms-4 px-6 py-6 rounded-4xl bg-[#30313E] h-4 w-4 relative disabled:opacity-50 disabled:cursor-not-allowed">
                    <p class="text-white font-extrabold left-0 right-0 top-3 absolute">&gt;</p>
                </button>
            </div>
            <div class="mt-4 text-lg font-bold text-[#23232B]" x-text="(currentPage+1) + '/' + storybook.pages + ' Page'">
            </div>
            <div class="mt-2 text-2xl font-bold text-[#23232B]" x-text="storybook.title || 'Aku Kian Satang'"></div>
        </div>
    </div>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function panelEditor() {
            // Load state
            let pages = JSON.parse(sessionStorage.getItem('pages')) || [];
            let currentPage = Number(sessionStorage.getItem('currentPage')) || 0;
            // Always enforce panels_number >= 1
            if (!pages[currentPage].panels.panels_number || pages[currentPage].panels.panels_number < 1) {
                pages[currentPage].panels.panels_number = 1;
            }
            let panelCount = pages[currentPage].panels.panels_number;
            let panels = (pages[currentPage].panels.panels_content && Array.isArray(pages[currentPage].panels.panels_content))
                ? pages[currentPage].panels.panels_content.slice(0, panelCount)
                : [];
            // Fill up with blanks if not enough
            while (panels.length < panelCount) {
                panels.push({
                    image: '',
                    top_text: '',
                    top_text_align: 'TextAlign.left',
                    middle_text: '',
                    middle_text_align: 'TextAlign.left',
                    bottom_text: '',
                    bottom_text_align: 'TextAlign.left'
                });
            }
            return {
                username: sessionStorage.getItem('username') || '',
                storybook: JSON.parse(sessionStorage.getItem('storybook')) || {
                    title: '',
                    pages: 1
                },
                currentPage: currentPage,
                pages: pages,
                panels: panels,
                selectedPanelIdx: 0,
                imgOpen: false,
                toggleImg() {
                    this.imgOpen = !this.imgOpen;
                },
                uploadImg(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        const img = new Image();
                        img.onload = () => {
                            const canvas = document.createElement('canvas');
                            canvas.width = img.width;
                            canvas.height = img.height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0);
                            // Compress to JPEG at quality 0.35
                            const compressed = canvas.toDataURL('image/jpeg', 0.35);
                            this.panels[this.selectedPanelIdx].image = compressed;
                            this.savePanels();
                        };
                        img.src = ev.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                removeImg() {
                    this.panels[this.selectedPanelIdx].image = '';
                    this.savePanels();
                },
                savePanels() {
                    // Save current panels to the correct page in the pages array
                    this.pages[this.currentPage].panels.panels_content = JSON.parse(JSON.stringify(this.panels));
                    try {
                        sessionStorage.setItem('pages', JSON.stringify(this.pages));
                    } catch (e) {
                        if (e.name === 'QuotaExceededError' || e.code === 22) {
                            alert('You have exceeded the browser storage limit. Please use smaller images or reduce the number of panels.');
                        } else {
                            throw e;
                        }
                    }
                },
                selectPanel(idx) {
                    this.selectedPanelIdx = idx;
                },
                textAlignCss(align) {
                    // Map Flutter to CSS
                    if (align === 'TextAlign.left') return 'left';
                    if (align === 'TextAlign.center') return 'center';
                    if (align === 'TextAlign.right') return 'right';
                    return 'left';
                },
                nextPage() {
                    this.savePanels();
                    let totalPages = this.storybook.pages || 1;
                    if (this.currentPage < totalPages - 1) {
                        this.currentPage++;
                        let page = this.pages[this.currentPage];
                        // Always enforce panels_number >= 1
                        if (!page.panels.panels_number || page.panels.panels_number < 1) {
                            page.panels.panels_number = 1;
                        }
                        let panelCount = page.panels.panels_number;
                        let panels = (page.panels.panels_content && Array.isArray(page.panels.panels_content))
                            ? page.panels.panels_content.slice(0, panelCount)
                            : [];
                        while (panels.length < panelCount) {
                            panels.push({
                                image: '',
                                top_text: '',
                                top_text_align: 'TextAlign.left',
                                middle_text: '',
                                middle_text_align: 'TextAlign.left',
                                bottom_text: '',
                                bottom_text_align: 'TextAlign.left'
                            });
                        }
                        this.panels = panels;
                        this.selectedPanelIdx = 0;
                        sessionStorage.setItem('currentPage', this.currentPage);
                    }
                },
                canFinishStorybook() {
                    // Check if every panel in every page has an image
                    return this.pages.every(page =>
                        page.panels.panels_content.length === page.panels.panels_number &&
                        page.panels.panels_content.every(panel => panel.image && panel.image !== '')
                    );
                },
                finishStorybook() {
                    this.savePanels();
                    window.location.href = '/confirm-storybook';
                },
                prevPage() {
                    this.savePanels();
                    if (this.currentPage > 0) {
                        this.currentPage--;
                        let page = this.pages[this.currentPage];
                        // Always enforce panels_number >= 1
                        if (!page.panels.panels_number || page.panels.panels_number < 1) {
                            page.panels.panels_number = 1;
                        }
                        let panelCount = page.panels.panels_number;
                        let panels = (page.panels.panels_content && Array.isArray(page.panels.panels_content))
                            ? page.panels.panels_content.slice(0, panelCount)
                            : [];
                        while (panels.length < panelCount) {
                            panels.push({
                                image: '',
                                top_text: '',
                                top_text_align: 'TextAlign.left',
                                middle_text: '',
                                middle_text_align: 'TextAlign.left',
                                bottom_text: '',
                                bottom_text_align: 'TextAlign.left'
                            });
                        }
                        this.panels = panels;
                        this.selectedPanelIdx = 0;
                        sessionStorage.setItem('currentPage', this.currentPage);
                    }
                },
                backToPageEditor() {
                    this.savePanels();
                    window.location.href = '/page-editor-storybook';
                },
                uploadToCloudinary(base64, folder) {
                    return new Promise((resolve, reject) => {
                        const cloudName = 'duxzvvi98';
                        const unsignedPreset = 'storybook_images';
                        const url = `https://api.cloudinary.com/v1_1/${cloudName}/image/upload`;
                        fetch(url, {
                                method: 'POST',
                                body: JSON.stringify({
                                    file: `data:image/png;base64,${base64}`,
                                    upload_preset: unsignedPreset,
                                    folder: folder
                                }),
                                headers: {
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => resolve(data.secure_url))
                            .catch(reject);
                    });
                }
            }
        }
    </script>
@endsection
