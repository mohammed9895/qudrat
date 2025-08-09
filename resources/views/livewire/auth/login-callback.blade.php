<div  class="flex justify-center items-center min-h-screen">
    @if ($loading)
        <div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 animate-spin h-8 w-8 text-blue-500 mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            <p class="mt-3 text-gray-600">{{ __('general.loading-info') }}</p>
        </div>
        @endif
    @if ($error)
        <div class="text-center text-red-600">
            <p>{{ $error }}</p>
        </div>
        <div class="text-center mt-3">
             <button class="bg-slate-600 text-slate-100 p-3" onclick="location.reload();" c>{{ __('general.reload') }}</button>
        </div>
    @endif
</div>
