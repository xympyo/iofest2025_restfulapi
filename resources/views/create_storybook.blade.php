@extends('layouts.app')

@section('title', 'Create Storybook')

@section('content')
    <div x-data="storybookForm()" class="flex h-screen w-full overflow-hidden bg-[#292838]">
        <!-- Left Scrollable Form -->
        <div class="w-full max-w-xl h-full overflow-y-auto px-8 py-10 flex flex-col gap-6">
            <label class="block mb-2 font-normal text-white">Storybook Title
                <input type="text" x-model="title" placeholder="Your storybook title here..."
                    class="mt-1 w-full rounded-lg px-4 text-[#30313E] placeholder:text-[#9F9CCC] placeholder:font-light py-2 bg-[#ECECFA] focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]" />
            </label>
            <label class="block mb-2 font-normal text-white">Storybook Description
                <input type="text" x-model="description" placeholder="Your storybook description here..."
                    class="mt-1 w-full rounded-lg px-4 text-[#30313E] py-2 placeholder:text-[#9F9CCC] placeholder:font-light bg-[#ECECFA] focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]" />
            </label>
            <label class="block mb-2 font-normal text-white">Pages in your Storybook
                <input type="number" min="1" max="6" x-model.number="pages" placeholder="Maximum page is 6."
                    class="mt-1 w-full rounded-lg px-4 text-[#30313E] py-2 placeholder:text-[#9F9CCC] placeholder:font-light bg-[#ECECFA] focus:outline-none focus:ring-2 focus:ring-[#bdb6e6]" />
            </label>
            <!-- Storybook Background -->
            <div class="mb-4">
                <button @click="toggleBg" type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg bg-gradient-to-b from-slate-400/10 to-slate-400 text-white font-semibold text-left shadow-md">
                    Storybook Background
                    <svg :class="{ 'rotate-90': bgOpen }" class="transition-transform duration-300 w-6 h-6 ml-2"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="bgOpen" x-transition class="mt-2 bg-[#bdb6e6]/30 rounded-lg p-4 relative">
                    <label
                        class="flex flex-col items-center justify-center h-40 border-2 border-dashed border-[#a3a3c2] rounded-lg cursor-pointer hover:bg-[#e1e1fa] transition">
                        <input type="file" class="hidden" @change="uploadBg($event)" accept="image/*">
                        <template x-if="!bgPreview">
                            <>
                                <svg class="w-16 h-16 mb-2 text-[#a3a3c2]" fill="none" viewBox="0 0 24 24">
                                    <path d="M12 16V8m0 0l-4 4m4-4l4 4" stroke="#a3a3c2" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <rect x="3" y="3" width="18" height="18" rx="2" stroke="#a3a3c2"
                                        stroke-width="2" />
                                </svg>
                                <span class="font-semibold text-center text-[#23232B]">Upload your image, or drag it
                                    here.<br><span class="text-xs">The image should be in 1920 x 1080 px.</span></span>
                            </>
                        </template>
                        <template x-if="bgPreview">
                            <img :src="bgPreview" alt="Background Preview"
                                class="object-cover w-full h-32 rounded-lg" />
                        </template>
                    </label>
                    <button x-show="bgPreview" @click="removeBg" type="button"
                        class="absolute bottom-2 right-2 bg-[#ff5e5e] hover:bg-[#e53e3e] text-white rounded-full p-2 shadow-md transition"
                        title="Remove background">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Storybook Profile Image -->
            <div class="mb-4">
                <button @click="toggleProfile" type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg bg-gradient-to-b from-slate-400/10 to-slate-400 text-white font-semibold text-left shadow-md">
                    Storybook Profile Image
                    <svg :class="{ 'rotate-90': profileOpen }" class="transition-transform duration-300 w-6 h-6 ml-2"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="profileOpen" x-transition class="mt-2 bg-[#bdb6e6]/30 rounded-lg p-4">
                    <label
                        class="flex flex-col items-center justify-center h-40 border-2 border-dashed border-[#a3a3c2] rounded-lg cursor-pointer hover:bg-[#e1e1fa] transition">
                        <input type="file" class="hidden" @change="uploadProfile($event)" accept="image/*">
                        <template x-if="!profilePreview">
                            <>
                                <svg class="w-16 h-16 mb-2 text-[#a3a3c2]" fill="none" viewBox="0 0 24 24">
                                    <path d="M12 16V8m0 0l-4 4m4-4l4 4" stroke="#a3a3c2" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <rect x="3" y="3" width="18" height="18" rx="2" stroke="#a3a3c2"
                                        stroke-width="2" />
                                </svg>
                                <span class="font-semibold text-center text-[#23232B]">Upload your image, or drag it
                                    here.<br><span class="text-xs">The image should be in 1920 x 1080 px.</span></span>
                            </>
                        </template>
                        <template x-if="profilePreview">
                            <img :src="profilePreview" alt="Profile Preview"
                                class="object-cover w-20 h-20 rounded-full" />
                        </template>
                    </label>
                </div>
            </div>
            <button @click="goToPageEditor"
                class="mt-8 w-full px-6 py-3 rounded-lg bg-[#9F9CCC] text-white font-bold text-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition">Continue
                to Page Editor</button>
        </div>
        <!-- Right Phone Preview -->
        <div class="flex-1 flex flex-col items-center justify-center relative bg-white">
            <div class="absolute top-10 right-10 flex items-center gap-4">
                <span class="text-[#30313E] text-xl font-bold" x-text="username"></span>
                <button class="px-6 py-2 rounded-lg bg-[#bdb6e6] text-white font-bold text-sm shadow-md">Finish
                    Storybook</button>
            </div>
            <div class="flex flex-row items-center">
                <button class="me-4 px-6 py-6 rounded-4xl bg-[#30313E] h-4 w-4 relative">
                    <p class="text-white font-extrabold left-0 right-0 top-3 absolute">
                        < </p>
                </button>
                <div class="mt-12 flex flex-col items-center">
                    <div class="rounded-3xl border-8 border-[#23232B] w-[200px] h-[420px] flex flex-col justify-between items-center bg-[#f4f4fa] relative overflow-hidden"
                        :style="bgPreview ? 'background-image: url(' + bgPreview +
                            '); background-size: cover; background-position: center;' : ''">
                        <!-- Here will be panels later -->
                    </div>
                    <div class="mt-4 text-lg font-bold text-[#23232B]" x-text="'0/' + pages + ' Page'"></div>
                    <div class="mt-2 text-2xl font-bold text-[#23232B]" x-text="title || 'Aku Kian Santang'"></div>
                </div>
                <button class="ms-4 px-6 py-6 rounded-4xl bg-[#30313E] h-4 w-4 relative">
                    <p class="text-white font-extrabold left-0 right-0 top-3 absolute">
                        > </p>
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function storybookForm() {
            return {
                title: sessionStorage.getItem('sb_title') || '',
                description: sessionStorage.getItem('sb_desc') || '',
                pages: Number(sessionStorage.getItem('sb_pages')) || 6,
                bgOpen: false,
                profileOpen: false,
                bgPreview: sessionStorage.getItem('sb_bg') || '',
                profilePreview: sessionStorage.getItem('sb_profile') || '',
                username: '{{ Auth::user() ? Auth::user()->username : '' }}',
                toggleBg() {
                    this.bgOpen = !this.bgOpen;
                },
                removeBg() {
                    this.bgPreview = '';
                    sessionStorage.removeItem('sb_bg');
                },
                toggleProfile() {
                    this.profileOpen = !this.profileOpen;
                },
                goToPageEditor() {
                    // Do NOT upload images to Cloudinary here!
                    // Just save all storybook data to sessionStorage and navigate instantly.
                    // Upload to Cloudinary should happen at the FINAL step (e.g., when the user finishes the storybook).
                    // Only store references (not base64 data) in the storybook object
                    const storybook = {
                        title: this.title,
                        description: this.description,
                        pages: this.pages,
                        bgKey: 'sb_bg', // reference key for background image
                        profileKey: 'sb_profile' // reference key for profile image
                    };
                    sessionStorage.setItem('storybook', JSON.stringify(storybook));
                    // Preserve panel content if reducing page count, and prompt before deleting
                    let prevPages = JSON.parse(sessionStorage.getItem('pages') || '[]');
                    let newCount = this.pages;
                    let arr = [];
                    if (prevPages.length > 0) {
                        if (newCount < prevPages.length) {
                            if (!window.confirm('Reducing the number of pages will delete the last ' + (prevPages.length - newCount) + ' page(s) and their content. Continue?')) {
                                return;
                            }
                        }
                        arr = prevPages.slice(0, newCount);
                        // Add blank pages if increasing
                        for (let i = prevPages.length; i < newCount; i++) {
                            arr.push({
                                id: i + 1,
                                page_information: i + 1,
                                panels: {
                                    id_pages: i + 1,
                                    panels_number: 1,
                                    panels_content: []
                                }
                            });
                        }
                    } else {
                        arr = Array.from({ length: newCount }, (_, i) => ({
                            id: i + 1,
                            page_information: i + 1,
                            panels: {
                                id_pages: i + 1,
                                panels_number: 1,
                                panels_content: []
                            }
                        }));
                    }
                    sessionStorage.setItem('pages', JSON.stringify(arr));
                    window.location.href = '{{ route('page_editor_storybook') }}';
                },
                // Fast preview: just store base64 in sessionStorage, upload to Cloudinary later
                uploadBg(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const img = new Image();
                        img.onload = () => {
                            const canvas = document.createElement('canvas');
                            canvas.width = img.width;
                            canvas.height = img.height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0);
                            // Compress to JPEG at quality 0.35
                            const compressed = canvas.toDataURL('image/jpeg', 0.35);
                            this.bgPreview = compressed;
                            sessionStorage.setItem('sb_bg', compressed);
                        };
                        img.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                uploadProfile(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const img = new Image();
                        img.onload = () => {
                            const canvas = document.createElement('canvas');
                            canvas.width = img.width;
                            canvas.height = img.height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0);
                            // Compress to JPEG at quality 0.35
                            const compressed = canvas.toDataURL('image/jpeg', 0.35);
                            this.profilePreview = compressed;
                            sessionStorage.setItem('sb_profile', compressed);
                        };
                        img.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                // Helper to upload a base64/dataURL image to Cloudinary, returns a Promise with the URL
                uploadToCloudinary(base64, folder) {
                    return new Promise((resolve, reject) => {
                        const cloudName = 'duxzvvi98';
                        const unsignedPreset = 'storybook_images';
                        const url = `https://api.cloudinary.com/v1_1/${cloudName}/image/upload`;
                        // Convert base64 to Blob
                        function dataURLtoBlob(dataurl) {
                            var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1], bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                            while(n--){ u8arr[n] = bstr.charCodeAt(n); }
                            return new Blob([u8arr], {type:mime});
                        }
                        const formData = new FormData();
                        formData.append('file', dataURLtoBlob(base64));
                        formData.append('upload_preset', unsignedPreset);
                        formData.append('folder', folder);
                        fetch(url, {
                            method: 'POST',
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.secure_url) resolve(data.secure_url);
                            else reject('Cloudinary upload failed.');
                        })
                        .catch(() => reject('Failed to upload image to Cloudinary.'));
                    });
                },
                init() {
                    this.$watch('title', v => sessionStorage.setItem('sb_title', v));
                    this.$watch('description', v => sessionStorage.setItem('sb_desc', v));
                    this.$watch('pages', v => sessionStorage.setItem('sb_pages', v));
                }
            }
        }
    </script>
@endsection
