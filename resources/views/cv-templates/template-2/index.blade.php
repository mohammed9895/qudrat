<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="{{ asset('cv-templates-assets/template-2/dep/normalize.css/normalize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('cv-templates-assets/template-2/dep/Font-Awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('cv-templates-assets/template-2/style.css') }}" />
  </head>
  <body lang="en">
    <section id="main">
      <header id="title">
        <h1>{{ $profile->fullname }}</h1>
        <span class="subtitle">{{ $profile->position }}</span>
      </header>
      @if($profile->experiences()->count() > 0)
        <section class="main-block">
          <h2>
            <i class="fa fa-suitcase"></i> Experiences
          </h2>
          @foreach($profile->experiences as $experience)
            <section class="blocks">
              <div class="date">
                <span>{{ $experience->start_date }}</span><span>{{ $experience->end_date }}</span>
              </div>
              <div class="decorator">
              </div>
              <div class="details">
                <header>
                  <h3>{{ $experience->position }}</h3>
                  <span class="place">{{ $experience->company }}</span>
                  {{-- <span class="location">(remote)</span> --}}
                </header>
                <div>
                  {{ $experience->description }}
                  </div>
              </div>
            </section>
          @endforeach
        </section>
      @endif
      @if($profile->works()->count() > 0)
        <section class="main-block">
          <h2>
            <i class="fa fa-folder-open"></i> Selected Projects
          </h2>
          @foreach($profile->works as $work)
          <section class="blocks">
            <div class="date">
              <span>2015</span><span>2016</span>
            </div>
            <div class="decorator">
            </div>
            <div class="details">
              <header>
                <h3>{{ $work->title }}</h3>
                <span class="place">{{ $work->workCategory->name }}</span>
              </header>
              <div>
                {!! html_entity_decode($work->description) !!}
              </div>
            </div>
          </section>
          @endforeach
        </section>
      @endif
      @if($profile->educations()->count() > 0)
      <section class="main-block concise">
        <h2>
          <i class="fa fa-graduation-cap"></i> Education
        </h2>
        
        @foreach($profile->educations()->get() as $education)
        <section class="blocks">
          <div class="date">
            <span>{{ $education->start_date ? \Carbon\Carbon::create($education->start_date ?? null)->format('Y') : '' }}</span><span>{{ $education->end_date ? \Carbon\Carbon::create($education->end_date ?? null)->format('Y') : '' }}</span>
          </div>
          <div class="decorator">
          </div>
          <div class="details">
            <header>
              <h3>{{ $education->educationType->name ?? '' }}</h3>
              <span class="place">{{ $education->school->name ?? '' }}</span>
            </header>
          </div>
        </section>
        @endforeach
       
      </section>
      @endif
    </section>
    <aside id="sidebar">
      <div class="side-block" id="contact">
        <h1>
          Contact Info
        </h1>
        <ul>
          @if ($profile->website)
            <li><i class="fa fa-globe"></i> {{ $profile->website }}</li>
          @endif
          @if ($profile->social_linkedin)
            <li><i class="fa fa-linkedin"></i> {{ $profile->social_linkedin }}</li>
          @endif
          @if ($profile->email)
          <li><i class="fa fa-envelope"></i> {{ $profile->email }}</li>
          @endif
          @if ($profile->phone)
          <li><i class="fa fa-phone"></i> {{ $profile->phone }}</li>
          @endif
        </ul>
      </div>
      @if($profile->skills()->count() > 0)
        <div class="side-block" id="skills">
          <h1>
            Skills
          </h1>
          <ul>
            @foreach($profile->skills()->get() as $skill)
              <li>{{ $skill->name }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </aside>
  </body>
</html>
