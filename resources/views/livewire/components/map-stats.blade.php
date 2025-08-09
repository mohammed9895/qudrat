<div>
    <div id="container-s"></div>
    @push('scripts')
        <script>
            document.addEventListener('livewire:init', () => {
                const dataSet = @json($mapData);

                const dataMap = new Datamap({
                    element: document.querySelector('#container-s'),
                    projection: 'mercator',
                    responsive: true,
                    fills: {
                        defaultFill: '#8284c7',
                        MAJOR: '#2e3192'
                    },
                    data: dataSet,
                    geographyConfig: {
                        borderColor: 'rgba(0, 0, 0, .09)',
                        highlightFillColor: '#3cc7bc',
                        highlightBorderColor: '#3cc7bc',
                        popupTemplate: function (geo, data) {
                            if (!data) return `<div class="p-2 text-sm text-gray-500">${geo.properties.name}</div>`;

                            return `
                            <div class="bg-white rounded shadow w-[150px] p-3">
                                <div class="flex mb-1">
                                    <div class="me-2">
                                        <div class="size-4 rounded-full bg-no-repeat bg-center bg-cover" style="background-image: url('/assets/images/flag-icons-main/${data.short}.svg')"></div>
                                    </div>
                                    <span class="text-sm font-medium">${data.customName || geo.properties.name}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-500">Talent:</span>
                                    <span class="text-sm font-medium ms-1">${data.active.value}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-500">Expert:</span>
                                    <span class="text-sm font-medium ms-1">${data.new.value}</span>
                                </div>
                            </div>`;
                        }
                    }
                });

                window.addEventListener('resize', () => {
                    dataMap.resize();
                });
            });
        </script>
    @endpush
</div>
