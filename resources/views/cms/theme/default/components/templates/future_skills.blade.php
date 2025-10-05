@props(['layout', 'page' => null])
@php
    use SolutionForest\FilamentCms\Dto\CmsPageData;use SolutionForest\FilamentCms\Facades\FilamentCms;

    /** @var array $layout */
    /** @var ?CmsPageData $page */

    $theme = FilamentCms::getCurrentTheme();
@endphp

<x-dynamic-component
    component="filament-cms::{{$theme}}.page"
    :layout="$layout">

<script defer src="//unpkg.com/alpinejs" ></script>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-14 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <div class="flex items-center gap-3 mb-3">
                        <a href="" class="text-head-color text-sm">{{ __('general.navigation.home') }}</a>
                        <span class="text-gray-3 text-sm">/</span>
                        <span class="text-b-color text-sm">{{ $page->title }}</span>
                    </div>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->title }}</h2>
                    <h3 class="mt-5 text-xl">{{ __('general.future-skills.sub-title') }}</h3>
                </div>
                <div class="w-6/12">
                    <div class="flex justify-end">
                        <img src="assets/images/banner_6.png" alt="images" class="hidden md:block">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Card -->
    <div class="pt-24 pb-12">
        <div class="container">
            <div class="flex justify-center mb-9">
                <div class="lg:w-6/12">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['main_title'] }}</h2>
                        <p>{{ $page->data['main_description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4">
                @foreach($page->data['categories'] as $category)
                    <a href="{{ $category['link'] }}" class="col-span-full lg:col-span-4">
                        <div class="group bg-white hover:bg-brand-blue transition-all px-4 py-6 rounded-2xl h-full">
                            <div class="text-center flex items-center justify-center flex-col">
                                <x-icon name="{{ $category['icon'] }}" class="size-28 text-brand-green mb-5"/>
                                <h4 class="text-2xl font-medium group-hover:text-white">{{ $category['title'] }}</h4>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Card -->

    <!-- Feature Skills -->
    <div class="py-12">
        <div class="container">
            <div class="flex mb-9">
                <div class="lg:w-7/12">
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['recommendation_title'] }}</h2>
                    <p>{{ $page->data['recommendation_description'] }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4">
                @foreach($page->data['recommendation_items'] as $item)
                    <div class="col-span-full lg:col-span-6 xl:col-span-3">
                        <div class="bg-white p-5 rounded-xl shadow-default">
                            <img src="assets/images/blog_1.png" alt="images" class="w-full mb-4">
                            <a href=""
                               class="inline-block text-2xl font-medium mb-3 hover:text-primary-1">{{ $item['title'] }}</a>
                            {!!  substr($item['content'], 0 ,100)  !!}
                            <a href="{{ $item['link'] }}"
                               class="inline-block px-8 py-3 mt-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">{{ __('general.future-skills.know-more') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Feature Skills -->

    <!-- Chart -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <header class="mb-8 text-center">
      <h1 class="text-3xl sm:text-4xl font-semibold">Core skills of 2025</h1>
      <p class="mt-2 text-gray-600">Share of employees surveyed (%) — IT & organizational skills</p>
    </header>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-4 sm:p-6">
      <!-- X-axis (top) -->
      <div class="hidden sm:flex justify-between text-xs text-gray-500 px-28 mb-2">
        <span>0%</span><span>25%</span><span>50%</span><span>75%</span><span>100%</span>
      </div>

      <div class="relative">
        <!-- Grid lines -->
        <div class="pointer-events-none absolute inset-x-0 top-0 bottom-0 px-28 hidden sm:block">
          <div class="h-full relative">
            <div class="absolute inset-y-0 left-0 w-px bg-gray-200"></div>
            <div class="absolute inset-y-0 left-[25%] w-px bg-gray-200"></div>
            <div class="absolute inset-y-0 left-[50%] w-px bg-gray-200"></div>
            <div class="absolute inset-y-0 left-[75%] w-px bg-gray-200"></div>
            <div class="absolute inset-y-0 left-[100%] w-px bg-gray-200"></div>
          </div>
        </div>

        <!-- Chart bars -->
        <div id="skills-chart" class="space-y-3" role="list" aria-label="Core skills of 2025 ranked by share of employees surveyed">
          <!-- injected via JS -->
        </div>
      </div>

      <!-- X-axis (bottom) -->
      <div class="mt-4 flex justify-between text-xs text-gray-500 px-28">
        <span>0%</span><span>25%</span><span>50%</span><span>75%</span><span>100%</span>
      </div>
    </div>
  </section>

  <script>
    const skills = [
      { label: 'AI/ML literacy', value: 68 },
      { label: 'Data analysis & BI', value: 66 },
      { label: 'Cloud fundamentals', value: 64 },
      { label: 'Cybersecurity', value: 62 },
      { label: 'APIs & microservices', value: 58 },
      { label: 'DevOps & CI/CD', value: 56 },
      { label: 'Software engineering fundamentals', value: 55 },
      { label: 'SQL & databases', value: 54 },
      { label: 'JavaScript/TypeScript', value: 52 },
      { label: 'Python', value: 51 },
      { label: 'Testing & QA', value: 49 },
      { label: 'Containerization (Docker/K8s)', value: 47 },
      { label: 'Observability & monitoring', value: 45 },
      { label: 'UX awareness', value: 44 },
      { label: 'Agile ways of working', value: 43 },
      { label: 'Privacy & data protection', value: 41 },
      { label: 'Technical writing', value: 40 },
    ];

    skills.sort((a, b) => b.value - a.value);

    const colors = [
      '#2E3192', '#17B26A', '#EAAA08', '#66C61C', '#875BF7',
      '#2563EB', '#F97316', '#10B981', '#A855F7', '#EA580C'
    ];

    const container = document.getElementById('skills-chart');

    skills.forEach((s, i) => {
      const row = document.createElement('div');
      row.className = 'grid grid-cols-12 items-center gap-3 sm:gap-4';

      const label = document.createElement('div');
      label.className = 'col-span-12 sm:col-span-3 text-sm sm:text-[15px] text-gray-800';
      label.textContent = s.label;

      const barCell = document.createElement('div');
      barCell.className = 'col-span-12 sm:col-span-9 relative';

      const wrapper = document.createElement('div');
      wrapper.className = 'relative h-4 sm:h-5 bg-gray-100 rounded-full overflow-hidden ring-1 ring-gray-200 group';

      const bar = document.createElement('div');
      bar.className = 'h-full transition-all duration-700 ease-out flex items-center justify-end pr-2';
      bar.style.width = `${s.value}%`;
      bar.style.backgroundColor = colors[i % colors.length];

      // Percentage inside the colored bar
      const value = document.createElement('span');
      value.className = 'text-[11px] sm:text-xs font-medium text-white';
      value.textContent = `${s.value}%`;

      bar.appendChild(value);
      wrapper.appendChild(bar);

      // Tooltip (optional)
      const tooltip = document.createElement('div');
      tooltip.className = 'absolute -top-8 right-0 opacity-0 group-hover:opacity-100 transition-opacity duration-200';
      tooltip.innerHTML = `<div class="px-2 py-1 text-xs bg-gray-900 text-white rounded shadow">${s.label}: ${s.value}%</div>`;
      wrapper.appendChild(tooltip);

      barCell.appendChild(wrapper);
      row.appendChild(label);
      row.appendChild(barCell);
      container.appendChild(row);
    });
  </script>
    <!-- /Chart -->

</x-dynamic-component>
