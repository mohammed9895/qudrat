<div wire:init="processLogin" class="flex justify-center items-center min-h-screen">
    @if ($loading)
        <div class="text-center">
            <svg class="animate-spin h-8 w-8 text-blue-500 mx-auto" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <p class="mt-3 text-gray-600">Loading your account...</p>
        </div>
    @elseif ($error)
        <div class="text-center text-red-600">
            <p>{{ $error }}</p>
        </div>
    @endif
</div>
