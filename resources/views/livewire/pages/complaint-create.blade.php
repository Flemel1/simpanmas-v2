@section('styles')
    <style>
        .scrolling-images-track {
            display: flex;
            align-items: center;
            overflow: hidden;
            gap: 1rem;
            /* 6 images, each at 100% width of the viewport = 600% total track width */
            width: 300%;

            animation: scroll-images 30s linear infinite;
        }

        .scrolling-header-images-track {
            width: 400%;

            animation: scroll-images 30s linear infinite;
        }

        .running-text-track {
            width: 100%;
            height: 100%;
            overflow: hidden;
            opacity: 0.5;
            animation: scroll-images 30s linear infinite;
        }

        .scrolling-images-track img {
            /* Each image takes up 100% of the track's width */
            width: 400px;
            height: 300px;
            opacity: 0.1;
            /* Very subtle to not distract from the form */
        }

        .scrolling-header-images-track img {
            /* Each image takes up 100% of the track's width */
            width: 300px;
            height: 150px;
            opacity: 0.8;
            /* Very subtle to not distract from the form */
        }

        @keyframes scroll-images {
            0% {
                transform: translateX(20%);
            }

            100% {
                /* Move the track left by the width of the first 3 images for a seamless loop */
                transform: translateX(-50%);
            }
        }
    </style>
@endsection

<div class="bg-gray-100 min-h-screen font-sans">
    <div class="w-full text-white">
        <div class="w-full bg-[#0000FF] ">
            <div class="pt-2 overflow-hidden">
                <div class="scrolling-header-images-track">
                    <img src="{{ asset('images/logo-simpanmas.png') }}" alt="Logo Simpanmas">
                </div>
            </div>
            <div class="flex flex-col items-center md:flex-row">
                <div class="w-1/4 h-full flex flex-col items-center justify-center mb-auto pt-8">
                    <img class="h-[350px]" src="{{ asset('images/bupati.png') }}" alt="Foto Bupati">
                    <span class="text-xl">Dr. H. Anton Achmad Saragih</span>
                    <span>Bupati Kabupaten Simalungun</span>
                </div>
                <div class="w-3/4 h-full mb-auto pt-8">
                    {{-- <img src="{{ asset('images/logo.png') }}" width="300" height="200" alt="Logo Aplikasi"
                        class="mx-auto mt-4"> --}}
                    <div class="my-2 mx-auto w-1/2 text-white text-center font-bold">
                        <h3 class="my-2 text-2xl">Visi</h3>
                        <p class="text-xl text-center">Bersama Semangat Baru Simalungun Menuju Simalungun Baru</p>
                        <h3 class="my-2 text-2xl">Misi</h3>
                        <p class="text-md text-center">Mewujudkan Transformasi Tata Kelola Pemerintahan Yang
                            Berintegritas</p>
                        <h3 class="my-2 text-2xl">Moto Pelayanan</h3>
                        <p class="text-md text-center">Wujudkan Simalungun Maju Melalui Tata Kelola Pemerintahan Yang
                            Berintegritas Dengan Pendekatan Benahi, Awasi, Dampingi, Solusi dan Sinergi</p>
                    </div>
                </div>

                <div class="w-1/4 h-full flex flex-col items-center justify-center mb-auto pt-8">
                    <img class="h-[350px]" src="{{ asset('images/wabup.png') }}" alt="Foto Wakil Bupati">
                    <span class="text-xl">Benny Gusman Sinaga S. T</span>
                    <span>Wakil Bupati Kabupaten Simalungun</span>
                </div>

            </div>
            {{-- <div class="w-full h-4 bg-green-600">
                <span>test</span>
            </div> --}}
            {{-- How to Report Section --}}
            {{-- <div class="container">
                <div class="text-center py-5">
                    <h2 class="font-weight-bold">BAGAIMANA CARA MELAPOR?</h2>
                    <div class="row mt-5">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 p-4">
                                <i class="fas fa-user-plus step-icon mb-3"></i>
                                <h4 class="font-weight-bold">1. DAFTARKAN AKUN Pelapor</h4>
                                <p class="text-muted">Daftarkan diri Pelapor untuk membuat akun baru dan memulai.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 p-4">
                                <i class="fas fa-sign-in-alt step-icon mb-3"></i>
                                <h4 class="font-weight-bold">2. LOGIN MENGGUNAKAN AKUN</h4>
                                <p class="text-muted">Masuk ke sistem menggunakan akun yang telah Pelapor daftarkan.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 p-4">
                                <i class="fas fa-bullhorn step-icon mb-3"></i>
                                <h4 class="font-weight-bold">3. ASPIRASI & ADUAN</h4>
                                <p class="text-muted">Sampaikan aspirasi atau aduan Pelapor secara jelas dan lengkap.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="relative">
        <!-- Red background wave -->
        <div class="absolute top-0 left-0 w-full h-48 bg-[#0000FF]" style="clip-path: ellipse(80% 60% at 50% 40%);">
        </div>
    </div>

    <div class="w-full py-8 px-4 relative overflow-hidden">
        <div class="h-full absolute inset-0 z-0 scrolling-images-track">
            <!-- Original images -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo 1">
            <img src="{{ asset('images/bpkp-logo.png') }}" alt="Logo 2">
            <img src="{{ asset('images/kpk-logo.png') }}" alt="Logo 3">
            <img src="{{ asset('images/logo-bangga-melayani-bangsa.png') }}" alt="Logo 4">
            <img src="{{ asset('images/logo-berakhlak.png') }}" alt="Logo 5">
            <img src="{{ asset('images/logo-berani-jujur-hebat.png') }}" alt="Logo 6">
        </div>

        <div class="relative mx-auto max-w-3xl bg-white rounded-lg z-10 shadow-2xl">
            <header class="bg-green-600 p-4 text-white text-lg font-bold">
                Sampaikan Laporan Anda
            </header>

            <div class="p-6 sm:p-8">

                <form wire:submit.prevent="save" class="space-y-6">
                    <!-- Classification -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Klasifikasi Laporan</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach (['pengaduan', 'aspirasi', 'permintaan informasi'] as $category)
                                <button type="button" wire:click="$set('form.report_category', '{{ $category }}')"
                                    class="px-4 py-2 text-sm font-medium capitalize border rounded-md transition-colors duration-200
                                    {{ $form->report_category === $category ? 'bg-[#0000FF] text-white border-red-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                                    {{ $category }}
                                </button>
                            @endforeach
                        </div>
                        @error('form.report_category')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Agency Dropdown -->
                    <div>
                        <select wire:model.lazy="form.destination_agency"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">Pilih Instansi Tujuan *</option>
                            @foreach ($agencies as $agency)
                                <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                @if ($loop->last)
                                    <option value="Lainnya">Lainnya</option>
                                @endif
                            @endforeach
                        </select>
                        @error('form.destination_agency')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($form->destination_agency === 'Lainnya')
                        <!-- Name -->
                        <div>
                            <label for="new_destination_agency">Nama Instansi Tujuan *</label>
                            <input id="new_destination_agency" type="text"
                                wire:model.lazy="form.new_destination_agency" placeholder="Ketik Instansi Tujuan *"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                            @error('form.new_destination_agency')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Name -->
                    <div>
                        <label for="name">Nama Pelapor *</label>
                        <input id="name" type="text" wire:model.lazy="form.name"
                            placeholder="Ketik Nama Pelapor *"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                        @error('form.name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload KTP --}}
                    <div>
                        <label for="identity_photo"
                            class="flex items-center gap-2 text-blue-600 hover:text-blue-800 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium">Upload KTP *</span>
                        </label>
                        <input type="file" id="identity_photo" wire:model.lazy="form.identity_photo" class="hidden">
                        {{-- Show filename and remove button after upload --}}
                        @if ($form->identity_photo)
                            <div class="mt-2 flex items-center text-sm text-gray-700 bg-gray-100 px-3 py-1 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="truncate">{{ $form->identity_photo->getClientOriginalName() }}</span>
                                <button type="button" wire:click="$set('form.identity_photo', null)"
                                    class="ml-2 font-bold text-red-500 hover:text-red-700"
                                    title="Remove file">&times;</button>
                            </div>
                        @endif

                        @error('form.identity_photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number">Nomor HP Pelapor *</label>
                        <input id="phone_number" type="text" wire:model.lazy="form.phone_number"
                            placeholder="Ketik Nomor HP Pelapor *"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                        @error('form.phone_number')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Incident Date -->
                    <div>
                        <label for="incident_date">Tanggal *</label>
                        <input id="incident_date" type="date" wire:model.lazy="form.incident_date"
                            placeholder="Masukkan Tanggal *"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                        @error('form.incident_date')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title">Judul Laporan *</label>
                        <input id="title" type="text" wire:model.lazy="form.title"
                            placeholder="Ketik Judul Laporan Pelapor *"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                        @error('form.title')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description">Isi Laporan *</label>
                        <textarea id="description" wire:model.lazy="form.description" rows="5"
                            placeholder="Ketik Isi Laporan Pelapor *"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                        @error('form.description')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Attachment -->
                    <div>
                        <label for="attachment"
                            class="flex items-center gap-2 text-blue-600 hover:text-blue-800 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium">Upload Berkas Laporan</span>
                        </label>
                        <input type="file" id="attachment" wire:model.lazy="form.attachment" class="hidden">
                        {{-- Show filename and remove button after upload --}}
                        @if ($form->attachment && !$errors->has('form.attachment'))
                            <div class="mt-2 flex items-center text-sm text-gray-700 bg-gray-100 px-3 py-1 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="truncate">{{ $form->attachment->getClientOriginalName() }}</span>
                                <button type="button" wire:click="$set('form.attachment', null)"
                                    class="ml-2 font-bold text-red-500 hover:text-red-700"
                                    title="Remove file">&times;</button>
                            </div>
                        @endif

                        @error('form.attachment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bottom Section: Attachment & Privacy -->
                    <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-gray-200">
                        <!--  Submit -->
                        <button type="submit"
                            class="px-6 py-2 bg-[#0000FF] text-white font-bold rounded-md hover:bg-[#0000FF] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-transform transform hover:scale-105"
                            wire:target="form.attachment, form.identity_photo" wire:loading.attr="disabled">
                            LAPOR!
                        </button>
                    </div>

                    {{-- Success Message --}}
                    <div x-data="{ show: false, type: 'success', message: '' }"
                        x-on:show-toast.window="
                                show = true;
                                type = $event.detail.type;
                                message = $event.detail.message;
                                setTimeout(() => show = false, 5000);"
                        x-show="show" x-transition:enter="transform ease-out duration-300 transition"
                        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed top-5 right-5 z-50 max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
                        style="display: none;">
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <!-- Success Icon -->
                                    <svg x-show="type === 'success'" class="h-6 w-6 text-green-400"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <!-- Error Icon -->
                                    <svg x-show="type === 'error'" class="h-6 w-6 text-red-400"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-gray-900" x-text="message"></p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button @click="show = false"
                                        class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
