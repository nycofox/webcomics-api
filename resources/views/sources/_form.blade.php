<!-- Homepage -->
<div class="mb-2">
    <x-label for="homepage" value="Homepage"/>
    <x-input id="homepage" class="block mt-1 w-full" type="text" name="homepage"
             value="{{ $source->homepage ?? old('homepage')}}" required autofocus/>
</div>

<!-- Name -->
<div class="mb-2">
    <x-label for="name" value="Name"/>
    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
             value="{{ $source->name ?? old('name')}}" required/>
</div>

<!-- Searchpage -->
<div class="mb-2">
    <x-label for="searchpage" value="Searchpage"/>
    <x-input id="searchpage" class="block mt-1 w-full" type="text" name="searchpage"
             value="{{ $source->searchpage ?? old('searchpage')}}"/>
</div>

<!-- Scraper -->
<div class="mb-2">
    <x-label for="scraper" value="Scraper"/>
    <select
        name="scraper" id="scraper"
        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @foreach($scrapers as $scraper => $name)
            <option value="{{ $scraper }}"
            @isset($source)
                @if($source->scraper === $scraper) selected @endif
            @endisset
            >{{ $name }}</option>
        @endforeach
        {{--        <option value="\App\Scrapers\SearchScraper">Search</option>--}}
        {{--        <option value="\App\Scrapers\GenerateScraper">Generate</option>--}}
    </select>
</div>

<!-- Searchstring -->
<div class="mb-2">
    <x-label for="searchstring" value="Searchstring"/>
    <x-input id="searchstring" class="block mt-1 w-full" type="text" name="searchstring"
             value="{{ $source->searchstring_comic ?? old('searchstring')}}" required/>
</div>

<!-- Base URL -->
<div class="mb-2">
    <x-label for="baseurl" value="Base URL"/>
    <x-input id="baseurl" class="block mt-1 w-full" type="text" name="baseurl"
             value="{{ $source->baseurl ?? old('baseurl')}}" />
</div>

<!-- Searchstring Title -->
<div class="mb-2">
    <x-label for="searchstring_title" value="Searchstring (title)"/>
    <x-input id="searchstring_title" class="block mt-1 w-full" type="text" name="searchstring_title"
             value="{{ $source->searchstring_title ?? old('searchstring_title')}}"/>
</div>

<!-- Searchstring description -->
<div class="mb-2">
    <x-label for="searchstring_description" value="Searchstring (description)"/>
    <x-input id="searchstring_description" class="block mt-1 w-full" type="text" name="searchstring_description"
             value="{{ $source->searchstring_description ?? old('searchstring_description')}}"/>
</div>

<!-- Searchstring number -->
<div class="mb-2">
    <x-label for="searchstring_number" value="Searchstring (number)"/>
    <x-input id="searchstring_number" class="block mt-1 w-full" type="text" name="searchstring_number"
             value="{{ $source->searchstring_number ?? old('searchstring_number')}}"/>
</div>

<!-- Language -->
<div class="mb-2">
    <x-label for="lang" value="Language"/>
    <select
        name="lang" id="lang"
        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @foreach($locales as $locale => $value)
            <option value="{{ $locale }}"
            @isset($source)
                @if($source->lang === $locale) selected @endif
            @endisset
            >{{ $value }}</option>
        @endforeach
    </select>
</div>

