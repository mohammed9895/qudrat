<div class="flex justify-center items-center min-h-screen">
    @if ($loading)
        <div class="text-center">
            <svg class="animate-spin h-8 w-8 mx-auto text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <p class="mt-2 text-gray-700">Loading your profile, please wait...</p>
        </div>
    @elseif($error)
        <div class="text-center text-red-600">
            <p>{{ $error }}</p>
        </div>
    @endif
</div>