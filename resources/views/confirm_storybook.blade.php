@extends('layouts.app')

@section('title', 'Confirm Storybook')

<script>
    function confirmStorybook() {
        // Helper: block navigation during upload
        window.addEventListener('beforeunload', function(e) {
            if (window.uploadingStorybook) {
                e.preventDefault();
                e.returnValue = '';
                return '';
            }
        });
        return {
            storybook: JSON.parse(sessionStorage.getItem('storybook')) || {},
            pages: JSON.parse(sessionStorage.getItem('pages')) || [],
            editModalOpen: false,
            selectedEditPage: null,
            showUploadModal: false,
            uploading: false,
            errorMessage: '',
            successMessage: '',
            async startUpload() {
                this.errorMessage = '';
                this.successMessage = '';
                this.uploading = true;
                window.uploadingStorybook = true;
                try {
                    // Deep copy data from sessionStorage
                    let storybook = JSON.parse(JSON.stringify(this.storybook));
                    let pages = JSON.parse(JSON.stringify(this.pages));

                    // Upload background/profile images using bgKey/profileKey from sessionStorage
                    if (storybook.bgKey) {
                        const bgBase64 = sessionStorage.getItem(storybook.bgKey);
                        if (bgBase64 && bgBase64.startsWith('data:')) {
                            storybook.background_image = await cloudinaryUploadImage(bgBase64);
                        }
                    }
                    if (storybook.profileKey) {
                        const profileBase64 = sessionStorage.getItem(storybook.profileKey);
                        if (profileBase64 && profileBase64.startsWith('data:')) {
                            storybook.storybook_profile = await cloudinaryUploadImage(profileBase64);
                        }
                    }

                    // Upload all panel images
                    for (const page of pages) {
                        for (const panel of page.panels.panels_content) {
                            if (panel.image && panel.image.startsWith('data:')) {
                                panel.image = await cloudinaryUploadImage(panel.image);
                            }
                        }
                    }

                    // Prepare payload
                    const payload = {
                        storybook,
                        pages,
                        background_image: storybook.background_image || null,
                        storybook_profile: storybook.storybook_profile || null,
                    };

                    // Send to backend
                    const res = await fetch('/api/upload-storybook', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify(payload)
                    });
                    const result = await res.json();
                    if (result.success) {
                        this.successMessage = 'Storybook uploaded successfully! Redirecting...';
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1800);
                    } else {
                        this.errorMessage = result.message || 'Upload failed.';
                    }
                } catch (error) {
                    this.errorMessage = error.message || 'An error occurred during upload.';
                } finally {
                    this.uploading = false;
                    window.uploadingStorybook = false;
                    this.showUploadModal = false;
                }
            },
            openEditModal(idx) {
                this.selectedEditPage = idx;
                this.editModalOpen = true;
            },
            goToPanelEditor(pageIdx) {
                sessionStorage.setItem('currentPage', pageIdx);
                window.location.href = '/panel-editor-storybook';
            }
        }
        async function cloudinaryUploadImage(base64) {
            const cloudName = 'duxzvvi98';
            const unsignedPreset = 'storybook_images';
            const url = `https://api.cloudinary.com/v1_1/${cloudName}/upload`;
            const formData = new FormData();
            formData.append('file', base64);
            formData.append('upload_preset', unsignedPreset);
            const res = await fetch(url, {
                method: 'POST',
                body: formData
            });
            if (!res.ok) throw new Error('Cloudinary upload failed');
            const data = await res.json();
            return data.secure_url;
        }
    }
</script>

@section('content')
    <div x-data="confirmStorybook()" class="min-h-screen bg-[#f8f9fa] flex flex-col items-center pt-8">
        <div class="flex justify-center gap-8 mb-8">
            <template x-for="(page, pageIdx) in pages" :key="pageIdx">
                <div @click="openEditModal(pageIdx)"
                    class="rounded-3xl border-8 border-[#23232B] w-[220px] h-[460px] flex flex-col justify-between items-center bg-[#f4f4fa] relative overflow-hidden cursor-pointer hover:shadow-2xl transition">
                    <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-4 bg-[#23232B] rounded-b-2xl"></div>
                    <div class="flex flex-col w-full h-full justify-between py-8">
                        <template x-for="(panel, idx) in page.panels.panels_content" :key="idx">
                            <div
                                class="flex-1 flex flex-col justify-center items-center border-b border-[#bdb6e6] last:border-b-0 px-4 py-2">
                                <template x-if="panel.image">
                                    <img :src="panel.image" class="object-cover w-full h-24 rounded-lg mb-2"
                                        alt="Panel Image" />
                                </template>
                                <template x-if="!panel.image">
                                    <div class="w-full h-24 bg-[#ececfa] flex items-center justify-center rounded-lg mb-2">
                                        <svg class="w-10 h-10 text-[#bdb6e6]" fill="none" viewBox="0 0 24 24">
                                            <path d="M12 16V8m0 0l-4 4m4-4l4 4" stroke="#bdb6e6" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <rect x="3" y="3" width="18" height="18" rx="2" stroke="#bdb6e6"
                                                stroke-width="2" />
                                        </svg>
                                    </div>
                                </template>
                                <span class="text-xs text-[#9F9CCC] text-center">Click here to edit your panels</span>
                            </div>
                        </template>
                    </div>
                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 text-[#23232B] font-bold"> <span
                            x-text="(pageIdx+1) + '/' + pages.length"></span></div>
                </div>
            </template>
            <template x-if="editModalOpen">
                <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                    <div class="bg-white rounded-xl shadow-lg p-8 min-w-[320px] flex flex-col items-center">
                        <div class="text-xl font-bold mb-4">Edit Page?</div>
                        <div class="flex gap-6 mt-2">
                            <button @click="editModalOpen=false"
                                class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-bold">No</button>
                            <button @click="goToPanelEditor(selectedEditPage)"
                                class="px-6 py-2 rounded-lg bg-[#9F9CCC] text-white font-bold">Yes</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="text-2xl font-bold text-[#23232B] mb-2" x-text="storybook.title || 'Untitled Storybook'"></div>
        <div class="text-[#9F9CCC] mb-8" x-text="storybook.description"></div>
        <button @click="showUploadModal = true"
            class="px-8 py-3 rounded-lg bg-[#9F9CCC] text-white font-bold text-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition">Upload
            Storybook</button>

        <!-- Upload Confirmation Modal -->
        <template x-if="showUploadModal">
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
                <div
                    class="relative bg-[#353347] rounded-2xl shadow-2xl p-10 w-full max-w-lg flex flex-col items-center animate-fade-in">
                    <button @click="!uploading && (showUploadModal = false)"
                        class="absolute top-6 right-6 text-white text-3xl font-bold focus:outline-none"
                        :disabled="uploading">&times;</button>
                    <div class="text-3xl font-bold text-white mb-3 mt-2">Upload Storybook?</div>
                    <div class="text-[#e1e1fa] text-lg mb-1">Please double check your Storybook,</div>
                    <div class="font-bold text-red-500 mb-4">YOU CAN NOT MODIFY YOUR STORYBOOK AFTER UPLOAD</div>
                    <div class="w-full flex flex-col gap-1 mb-6">
                        <div class="flex justify-between text-white text-lg"><span>Title:</span> <span
                                x-text="storybook.title"></span></div>
                        <div class="flex justify-between text-white text-lg"><span>Description:</span> <span
                                x-text="storybook.description"></span></div>
                        <div class="flex justify-between text-white text-lg"><span>Pages:</span> <span
                                x-text="pages.length"></span></div>
                    </div>
                    <template x-if="uploading">
                        <div class="flex flex-col items-center w-full">
                            <svg class="animate-spin h-10 w-10 text-[#bdb6e6] mb-4" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="#bdb6e6" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                            <div class="text-[#bdb6e6] text-lg font-bold">Uploading, please wait...</div>
                        </div>
                    </template>
                    <template x-if="!uploading">
                        <button @click="startUpload"
                            class="mt-4 px-8 py-3 rounded-lg bg-[#bdb6e6] text-white font-bold text-2xl shadow-md transition disabled:opacity-60"
                            :disabled="uploading">Upload Storybook</button>
                    </template>
                    <template x-if="errorMessage">
    <div class="mt-4 w-full text-center text-red-500 font-semibold" x-text="errorMessage"></div>
</template>
                </div>
            </div>
        </template>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endsection
