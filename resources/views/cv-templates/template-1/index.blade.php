<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dahye's CV</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex justify-center content-center">
<!-- outer container -->
<div class="border border-gray-300 rounded-sm shadow-lg py-10 px-10 mt-10 mb-10">
    <!-- header (profile) -->
    <header>
        <!-- social icons-->
        <ul class="flex flex-wrap justify-end gap-2">
            <!-- linkedin -->
            @if($profile->social_linkedin)
                <li>
                    <a href="{{ $profile->social_linkedin }}"
                       class="bg-blue-600 p-2 font-semibold text-white inline-flex items-center space-x-2 rounded"
                       target=”_blank”>
                        <svg class="w-5 h-5 fill-current" role="img" viewBox="0 0 256 256"
                             xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="M218.123122,218.127392 L180.191928,218.127392 L180.191928,158.724263 C180.191928,144.559023 179.939053,126.323993 160.463756,126.323993 C140.707926,126.323993 137.685284,141.757585 137.685284,157.692986 L137.685284,218.123441 L99.7540894,218.123441 L99.7540894,95.9665207 L136.168036,95.9665207 L136.168036,112.660562 L136.677736,112.660562 C144.102746,99.9650027 157.908637,92.3824528 172.605689,92.9280076 C211.050535,92.9280076 218.138927,118.216023 218.138927,151.114151 L218.123122,218.127392 Z M56.9550587,79.2685282 C44.7981969,79.2707099 34.9413443,69.4171797 34.9391618,57.260052 C34.93698,45.1029244 44.7902948,35.2458562 56.9471566,35.2436736 C69.1040185,35.2414916 78.9608713,45.0950217 78.963054,57.2521493 C78.9641017,63.090208 76.6459976,68.6895714 72.5186979,72.8184433 C68.3913982,76.9473153 62.7929898,79.26748 56.9550587,79.2685282 M75.9206558,218.127392 L37.94995,218.127392 L37.94995,95.9665207 L75.9206558,95.9665207 L75.9206558,218.127392 Z M237.033403,0.0182577091 L18.8895249,0.0182577091 C8.57959469,-0.0980923971 0.124827038,8.16056231 -0.001,18.4706066 L-0.001,237.524091 C0.120519052,247.839103 8.57460631,256.105934 18.8895249,255.9977 L237.033403,255.9977 C247.368728,256.125818 255.855922,247.859464 255.999,237.524091 L255.999,18.4548016 C255.851624,8.12438979 247.363742,-0.133792868 237.033403,0.000790807055">
                                </path>
                            </g>
                        </svg>
                    </a>
                </li>
            @endif
            @if($profile->social_github)
                <li>
                    <!-- github -->
                    <a href="{{ $profile->social_github }}"
                       class="bg-gray-700 p-2 font-medium text-white inline-flex items-center space-x-2 rounded"
                       target=”_blank”>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             aria-hidden="true" role="img" class="w-5" preserveAspectRatio="xMidYMid meet"
                             viewBox="0 0 24 24">
                            <g fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385c.6.105.825-.255.825-.57c0-.285-.015-1.23-.015-2.235c-3.015.555-3.795-.735-4.035-1.41c-.135-.345-.72-1.41-1.23-1.695c-.42-.225-1.02-.78-.015-.795c.945-.015 1.62.87 1.845 1.23c1.08 1.815 2.805 1.305 3.495.99c.105-.78.42-1.305.765-1.605c-2.67-.3-5.46-1.335-5.46-5.925c0-1.305.465-2.385 1.23-3.225c-.12-.3-.54-1.53.12-3.18c0 0 1.005-.315 3.3 1.23c.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23c.66 1.65.24 2.88.12 3.18c.765.84 1.23 1.905 1.23 3.225c0 4.605-2.805 5.625-5.475 5.925c.435.375.81 1.095.81 2.22c0 1.605-.015 2.895-.015 3.3c0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"
                                      fill="currentColor" />
                            </g>
                        </svg>
                    </a>
                </li>
            @endif
            @if($profile->website)
                <li>
                    <!-- tech blog -->
                    <a href="{{ $profile->website }}"
                       class="bg-black p-2 font-medium text-white inline-flex items-center space-x-2 rounded"
                       target=”_blank”>
                        <svg class="w-5 h-5" role="img" aria-hidden="true" preserveAspectRatio="xMidYMid meet"
                             viewBox="0 32 447.99999999999994 448" xmlns="http://www.w3.org/2000/svg" width="2500"
                             height="2321">
                            <g fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M120.12 208.29c-3.88-2.9-7.77-4.35-11.65-4.35H91.03v104.47h17.45c3.88 0 7.77-1.45 11.65-4.35s5.82-7.25 5.82-13.06v-69.65c-.01-5.8-1.96-10.16-5.83-13.06zM404.1 32H43.9C19.7 32 .06 51.59 0 75.8v360.4C.06 460.41 19.7 480 43.9 480h360.2c24.21 0 43.84-19.59 43.9-43.8V75.8c-.06-24.21-19.7-43.8-43.9-43.8zM154.2 291.19c0 18.81-11.61 47.31-48.36 47.25h-46.4V172.98h47.38c35.44 0 47.36 28.46 47.37 47.28zm100.68-88.66H201.6v38.42h32.57v29.57H201.6v38.41h53.29v29.57h-62.18c-11.16.29-20.44-8.53-20.72-19.69V193.7c-.27-11.15 8.56-20.41 19.71-20.69h63.19zm103.64 115.29c-13.2 30.75-36.85 24.63-47.44 0l-38.53-144.8h32.57l29.71 113.72 29.57-113.72h32.58z"
                                      fill="currentColor" />
                            </g>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
        <div class="flex justify-between items-center">
            <div>
                    <img src="/uploads/{{ $profile->avatar }}" class="rounded-full h-52 w-52" alt="">
            </div>
            <div class="grid justify-items-end">
                <h1 class="text-7xl font-extrabold">{{ $profile->fullname }}</h1>
                <p class="text-xl mt-5">{{ $profile->position }}</p>
            </div>
        </div>
    </header>
    <!-- detailed info -->
    <main class="flex gap-x-10 mt-10">
        <div class="w-2/6">
            <!-- contact details -->
            <strong class="text-xl font-medium">Contact Details</strong>
            <ul class="mt-2 mb-10">
                <li class="px-2 mt-1"><strong class="mr-1">Phone </strong>
                    <a href="tel:+821023456789" class="block">{{ $profile->phone }}</a>
                </li>
                <li class="px-2 mt-1"><strong class="mr-1">E-mail </strong>
                    <a href="mailto:" class="block">{{ $profile->email }}</a>
                </li>
                <li class="px-2 mt-1"><strong class="mr-1">Location</strong><span class="block">{{ $profile->address }}</span></li>
            </ul>


            <!-- categories -->
            @if($profile->skills()->count() > 0)
                <strong class="text-xl font-medium">Categories</strong>
                <ul class="mt-2 mb-10">
                    @foreach($profile->categories()->get() as $category)
                        <li class="px-2 mt-1">{{ $category->name }}</li>
                    @endforeach
                </ul>
            @endif
            <!-- skills -->
            @if($profile->skills()->count() > 0)
                <strong class="text-xl font-medium">Skills</strong>
                <ul class="mt-2 mb-10">
                    @foreach($profile->skills()->get() as $skill)
                        <li class="px-2 mt-1">{{ $skill->name }}</li>
                    @endforeach
                </ul>
            @endif
            <!-- languages -->
            @if($profile->languages()->count() > 0)
                <strong class="text-xl font-medium">Languages</strong>
                <ul class="mt-2 mb-10">
                    @foreach($profile->languages()->get() as $language)
                        <li class="px-2 mt-1">{{ $language->name }}</li>
                    @endforeach
                </ul>
            @endif
            <!-- Tools -->
            @if($profile->languages()->count() > 0)
                <strong class="text-xl font-medium">Tools</strong>
                <ul class="mt-2 mb-10">
                    @foreach($profile->tools()->get() as $tool)
                        <li class="px-2 mt-1">{{ $tool->name }}</li>
                    @endforeach
                </ul>
            @endif
            <!-- Tools -->
            @if($profile->interests()->count() > 0)
                <strong class="text-xl font-medium">Interests</strong>
                <ul class="mt-2 mb-10">
                    @foreach($profile->interests()->get() as $interest)
                        <li class="px-2 mt-1">{{ $interest->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <!-- info -->
        <div class="w-4/6">
            <section>
                <!-- about me -->
                <h2 class="text-2xl pb-1 border-b font-semibold">About</h2>
                <p class="mt-4 text-xs">{{ $profile->bio }}</p>

            </section>
            <!-- education -->
            @if($profile->educations()->count() > 0)
                <section>
                    <h2 class="text-2xl mt-6 pb-1 border-b font-semibold">Education</h2>
                    <ul class="mt-2">
                        @foreach($profile->educations()->get() as $education)
                            <li class="pt-2">
                                <p class="flex justify-between text-sm"><strong class="text-base">{{ $education->school->name ?? '' }}</strong>{{ \Carbon\Carbon::create($education->start_date ?? null)->format('Y') }}-{{ \Carbon\Carbon::create($education->end_date)->format('Y') }}</p>
                                <p class="flex justify-between text-sm">{{ $education->fieldOfStudy->name ?? '' }} - {{ $education->subFieldOfStudy->name ?? '' }}<small>GPA {{ $education->grade }}</small></p>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif
            @if($profile->experiences()->count() > 0)
                <section>
                    <!-- work experiences -->
                    <h2 class="text-2xl mt-6 pb-1 border-b font-semibold">Work Experiences</h2>
                    <ul class="mt-2">
                        @foreach($profile->experiences as $experience)
                            <li class="pt-2">
                                <p class="flex justify-between text-sm"><strong class="text-base">{{ $experience->company }}</strong>{{ \Carbon\Carbon::create($education->start_date)->format('Y') }}-{{ \Carbon\Carbon::create($education->end_date)->format('Y') }}</p>
                                <p class="flex justify-between text-base">{{ $experience->position }}<small></small></p>
                                <p class="text-justify text-xs">
                                    {{ $experience->description }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif
            @if($profile->works()->count() > 0)
                <section>
                    <!-- projects -->
                    <h2 class="text-2xl mt-6 pb-1 border-b font-semibold">Projects</h2>
                    <ul class="mt-1">
                       @foreach($profile->works as $work)
                            <li class="py-2">
                                <div class="flex justify-between my-1">
                                    <strong>{{ $work->title }} - {{ $work->workCategory->name }}</strong>
                                    <p class="flex">
                                        @foreach($work->tools as $tool)
                                            <span class="bg-gray-200 text-gray-600 px-2 py-1 mr-1 text-xs rounded">{{ $tool->name }}</span>
                                        @endforeach
                                </div>
                                <ul class="flex mb-2">
                                    @foreach($work->skills as $skill)
                                        <li class="bg-gray-200 text-gray-600 px-2 py-1 mr-1 text-xs rounded">{{ $skill->name }}</li>
                                    @endforeach
                                </ul>
                                <p class="text-xs">{!! html_entity_decode($work->description) !!}</p>
                            </li>
                       @endforeach
                    </ul>
                </section>
            @endif
        </div>
    </main>
</div>
</body>

</html>
