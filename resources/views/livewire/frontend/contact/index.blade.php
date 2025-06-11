<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-[160px] pb-28 relative overflow-hidden">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <div class="flex items-center gap-3 mb-3">
                        <a href="" class="text-head-color text-sm">{{ __('general.home') }}</a>
                        <span class="text-gray-3 text-sm">/</span>
                        <span class="text-b-color text-sm">{{ __('general.contact.page-title') }}</span>
                    </div>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.contact.page-title') }}</h2>
                </div>
                <div class="w-6/12">
                    <img src="assets/images/banner_4.png" alt="image"
                         class="absolute h-full bottom-0 end-[16%] hidden lg:block">
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->


    <!-- Form -->
    <div class="pt-24 pb-24">
        <div class="container">
            <div class="text-center mb-9">
                <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.contact.send-us-a-message') }}</h2>
                <p>{{ __('general.contact.note') }} *
                </p>
            </div>
            <div class="flex justify-center">
                <div class="w-full lg:w-8/12">
                    <form wire:submit.prevent="submit">
                        <div class="grid grid-cols-12 gap-4 lg:gap-6">
                            <div class="col-span-full lg:col-span-6">
                                <label for="name" class="block text-sm font-semibold mb-2">
                                    {{ __('general.contact.full-name') }}: <span class="text-primary-2">*</span>
                                </label>
                                <input type="text" id="name" wire:model.defer="name"
                                       class="bg-white bg-opacity-50 w-full px-6 py-4 border border-gray-1 rounded-lg">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-span-full lg:col-span-6">
                                <label for="email" class="block text-sm font-semibold mb-2">
                                    {{ __('general.contact.email') }}: <span class="text-primary-2">*</span>
                                </label>
                                <input type="email" id="email" wire:model.defer="email"
                                       class="bg-white bg-opacity-50 w-full px-6 py-4 border border-gray-1 rounded-lg">
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-span-full lg:col-span-6">
                                <label for="subject" class="block text-sm font-semibold mb-2">
                                    {{ __('general.contact.subject') }}:
                                </label>
                                <input type="text" id="subject" wire:model.defer="subject"
                                       class="bg-white bg-opacity-50 w-full px-6 py-4 border border-gray-1 rounded-lg">
                            </div>

                            <div class="col-span-full lg:col-span-6">
                                <label for="phone" class="block text-sm font-semibold mb-2">
                                    {{ __('general.contact.phone-number') }}:
                                </label>
                                <input type="text" id="phone" wire:model.defer="phone"
                                       class="bg-white bg-opacity-50 w-full px-6 py-4 border border-gray-1 rounded-lg">
                            </div>

                            <div class="col-span-full">
                                <label for="message" class="block text-sm font-semibold mb-2">
                                    {{ __('general.contact.message') }}:
                                </label>
                                <textarea id="message" wire:model.defer="message"
                                          class="bg-white bg-opacity-50 w-full px-6 py-4 border border-gray-1 rounded-lg min-h-[150px]"
                                          placeholder="{{ __('general.contact.message-placeholder') }}"></textarea>
                                @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-span-full">
                                <div class="flex justify-center">
                                    <button type="submit"
                                            class="px-8 py-3 rounded-full text-head-color font-medium bg-black text-white">
                                        {{ __('general.contact.submit') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if (session()->has('success'))
                            <div class="mt-4 text-green-600 text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- /Form -->

    <!-- Map -->
    <div class="mb-[-80px]">
        <div class="mapswrapper">
            <iframe width="100%" height="550" loading="lazy" allowfullscreen
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8&q=New%20York&zoom=10&maptype=roadmap"></iframe>
            <a href="https://www.lawod.com/squad-busters-tier-list/">Squad Busters Tier List</a>
            <style>.mapswrapper {
                    background: #fff;
                    position: relative
                }

                .mapswrapper iframe {
                    border: 0;
                    position: relative;
                    z-index: 2
                }

                .mapswrapper a {
                    color: rgba(0, 0, 0, 0);
                    position: absolute;
                    left: 0;
                    top: 0;
                    z-index: 0
                }</style>
        </div>
    </div>
    <!-- /Map -->

</div>
