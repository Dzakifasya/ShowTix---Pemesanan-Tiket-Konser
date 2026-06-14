@extends('layouts.app')

@section('title')
Dashboard - ShowTix
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-[#003D82] to-[#0052a3] rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="font-display font-bold text-4xl mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-gray-100">Kelola tiket dan transaksi Anda dengan mudah</p>
            </div>
            <div class="text-5xl opacity-20">
                <i class="fas fa-user-circle"></i>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <!-- Total Konser -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#003D82] hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Konser Ditonton</p>
                    <p class="font-display font-bold text-3xl text-gray-800">12</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-[#003D82] text-2xl">
                    <i class="fas fa-music"></i>
                </div>
            </div>
        </div>

        <!-- Total Tiket -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#FF6600] hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Total Tiket</p>
                    <p class="font-display font-bold text-3xl text-gray-800">18</p>
                </div>
                <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center text-[#FF6600] text-2xl">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>

        <!-- Total Belanja -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-green-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Total Belanja</p>
                    <p class="font-display font-bold text-3xl text-gray-800">Rp 5M</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-2xl">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>

        <!-- Konser Mendatang -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-purple-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Konser Mendatang</p>
                    <p class="font-display font-bold text-3xl text-gray-800">3</p>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-2xl">
                    <i class="fas fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex gap-4 border-b border-gray-200">
            <button onclick="switchTab('upcoming')" class="tab-button pb-4 px-4 border-b-2 border-[#003D82] text-[#003D82] font-semibold active">
                <i class="fas fa-calendar-alt mr-2"></i> Konser Mendatang
            </button>
            <button onclick="switchTab('history')" class="tab-button pb-4 px-4 border-b-2 border-transparent text-gray-600 hover:text-[#003D82] transition font-semibold">
                <i class="fas fa-history mr-2"></i> Riwayat
            </button>
            <button onclick="switchTab('settings')" class="tab-button pb-4 px-4 border-b-2 border-transparent text-gray-600 hover:text-[#003D82] transition font-semibold">
                <i class="fas fa-cog mr-2"></i> Pengaturan
            </button>
        </div>
    </div>

    <!-- Tab Content: Upcoming Concerts -->
    <div id="upcoming-tab" class="tab-content">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for($i = 1; $i <= 3; $i++)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition card-concert">
                    <div class="h-40 bg-gradient-to-br from-[#003D82] to-[#FF6600] flex items-center justify-center">
                        <i class="fas fa-music text-white text-5xl opacity-30"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Konser Besar {{ $i }}</h3>
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <p><i class="fas fa-calendar text-[#FF6600] mr-2"></i>20 Juni 2026</p>
                            <p><i class="fas fa-map-marker-alt text-[#FF6600] mr-2"></i>Jakarta</p>
                            <p><i class="fas fa-ticket-alt text-[#FF6600] mr-2"></i>2 Tiket</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 btn-primary text-sm py-2">Lihat Tiket</button>
                            <button class="flex-1 btn-outline-primary text-sm py-2">Tunda</button>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Tab Content: History -->
    <div id="history-tab" class="tab-content hidden">
        <div class="space-y-4">
            @for($i = 1; $i <= 5; $i++)
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-[#003D82] hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">Konser Legend</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600 mb-3">
                                <p><i class="fas fa-calendar mr-2"></i>15 Mei 2026</p>
                                <p><i class="fas fa-map-marker-alt mr-2"></i>Surabaya</p>
                                <p><i class="fas fa-ticket-alt mr-2"></i>2 Tiket</p>
                                <p><i class="fas fa-credit-card mr-2"></i>Rp 500.000</p>
                            </div>
                        </div>
                        <div class="text-right">
                            @if($i == 1)
                                <span class="badge-orange mb-2">Selesai</span>
                            @else
                                <span class="inline-block bg-blue-100 text-[#003D82] px-3 py-1 rounded-full text-xs font-semibold mb-2">Selesai</span>
                            @endif
                            <div class="flex gap-2">
                                <button class="text-[#003D82] hover:text-[#FF6600] transition">
                                    <i class="fas fa-download"></i> Download
                                </button>
                                <button class="text-gray-400 hover:text-gray-600 transition">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Tab Content: Settings -->
    <div id="settings-tab" class="tab-content hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Settings -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="font-bold text-2xl text-gray-800 mb-6 pb-4 border-b">Profil Anda</h2>
                    
                    <form class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" value="{{ auth()->user()->name }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon</label>
                            <input type="tel" placeholder="081234567890" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                            <textarea rows="3" placeholder="Alamat lengkap Anda" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]"></textarea>
                        </div>

                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Security Settings -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="font-bold text-2xl text-gray-800 mb-6 pb-4 border-b">Keamanan</h2>
                    
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                        </div>

                        <button type="submit" class="btn-outline-primary">
                            <i class="fas fa-lock mr-2"></i> Ubah Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Preferences -->
            <div class="bg-white rounded-xl shadow-md p-6 h-fit">
                <h2 class="font-bold text-xl text-gray-800 mb-6 pb-4 border-b">Preferensi</h2>
                
                <div class="space-y-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-5 h-5">
                        <span class="text-gray-700">Notifikasi Email</span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-5 h-5">
                        <span class="text-gray-700">Notifikasi SMS</span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-5 h-5">
                        <span class="text-gray-700">Promo & Penawaran</span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" class="w-5 h-5">
                        <span class="text-gray-700">Newsletter</span>
                    </label>

                    <hr class="my-4">

                    <button class="w-full text-red-500 hover:bg-red-50 px-4 py-2 rounded-lg transition border border-red-500 font-semibold">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    function switchTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        // Remove active state from all buttons
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-[#003D82]', 'text-[#003D82]');
            btn.classList.add('border-transparent', 'text-gray-600');
        });

        // Show selected tab
        document.getElementById(tabName + '-tab').classList.remove('hidden');

        // Add active state to clicked button
        event.target.closest('.tab-button').classList.add('border-[#003D82]', 'text-[#003D82]');
        event.target.closest('.tab-button').classList.remove('border-transparent', 'text-gray-600');
    }
</script>
@endpush
