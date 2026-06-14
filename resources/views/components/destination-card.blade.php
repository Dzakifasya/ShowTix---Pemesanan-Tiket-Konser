<!-- Destination Card Component -->
<div class="relative h-64 rounded-2xl overflow-hidden group cursor-pointer">
    <!-- Background Image -->
    <img src="{{ $destination['image'] }}" alt="{{ $destination['name'] }}" 
         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <!-- Content -->
    <div class="absolute inset-0 flex flex-col justify-end p-6 text-white">
        <h3 class="text-2xl font-bold mb-2">{{ $destination['name'] }}</h3>
        <p class="text-sm text-gray-200 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            {{ $destination['featured_event'] }}
        </p>
        <button class="self-start px-4 py-2 bg-secondary-900 text-white rounded-lg hover:bg-secondary-800 transition-colors text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            Jelajahi
        </button>
    </div>
</div>
