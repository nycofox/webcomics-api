<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('sources.index') }}">Sources</a> -
            Index
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card>
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Homepage</th>
                        <th class="py-3 px-6 text-left">Webcomic</th>
                        <th class="py-3 px-6 text-left">Last Scraped</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($sources as $source)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <a href="{{ route('webcomics.sources.edit', [$source->webcomic, $source]) }}">
                                    {{ $source->name }}
                                </a>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <a href="{{ config('services.dereferer.url') . $source->homepage }}" target="_blank">{{ $source->homepage }}</a>
                            </td>
                            <td class="py-3 px-6 text-left">{{ $source->webcomic->name }}</td>
                            <td class="py-3 px-6 text-left">
                                {{ $source->last_scraped_at ? $source->last_scraped_at->diffForHumans() : 'Never' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>

</x-app-layout>
