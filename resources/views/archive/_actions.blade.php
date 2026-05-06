<div class="flex items-center gap-2 flex-shrink-0">

    {{-- Restore button --}}
    <div class="relative group">
        <form action="{{ route('archive.restore', [$type, $id]) }}" method="POST">
            @csrf
            <button type="submit"
                class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100
                       hover:bg-green-100 hover:text-green-600 text-gray-400 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </button>
        </form>
        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 px-2 py-1 bg-gray-800
                    text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100
                    transition-opacity pointer-events-none z-10">
            Restore record
            <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
        </div>
    </div>

    {{-- Permanent delete button --}}
    <div class="relative group">
        <form action="{{ route('archive.forceDelete', [$type, $id]) }}" method="POST"
              onsubmit="return confirm('Permanently delete this record? This CANNOT be undone.')">
            @csrf @method('DELETE')
            <button type="submit"
                class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100
                       hover:bg-red-100 hover:text-red-600 text-gray-400 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </form>
        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 px-2 py-1 bg-gray-800
                    text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100
                    transition-opacity pointer-events-none z-10">
            Delete permanently
            <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
        </div>
    </div>

</div>