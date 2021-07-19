<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('webcomics.index') }}">Webcomics</a> - {{ $webcomic->name }}
            <span class="text-gray-500 text-sm">by {{ $webcomic->author }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card>
            <h3 class="font-semibold text-lg text-gray-800">Sources</h3>
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Homepage</th>
                        <th class="py-3 px-6 text-left">Last Scraped</th>
                        <th class="py-3 px-6 text-right">Number of strips</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($sources as $source)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <a href="{{ config('services.dereferer.url') . $source->homepage }}" target="_blank">{{ $source->homepage }}</a>
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $source->last_scraped_at ? $source->last_scraped_at->diffForHumans() : 'Never' }}
                            </td>
                            <td class="py-3 px-6 text-right">{{ $source->strips_count }}</td>
                            <td class="py-3 px-6 text-left">{{ $source->active ? 'Active' : 'Disabled' }}</td>
                            <td class="py-3 px-6 text-left">
                                <a href="{{ route('webcomics.sources.scrape', [$webcomic, $source]) }}">Scrape</a>
                                <a href="{{ route('webcomics.sources.edit', [$webcomic, $source]) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <a href="{{ route('webcomics.sources.create', $webcomic) }}">
                    <i class="fa fa-plus"></i> Add new source
                </a>
            </div>
            <div>
                <a href="{{ route('webcomics.edit', $webcomic) }}">
                    <i class="fa fa-edit"></i> Edit {{ $webcomic->name }}
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
