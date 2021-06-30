<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Webcomics Index
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card>
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Author</th>
                        <th class="py-3 px-6 text-left">Sources</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($webcomics as $webcomic)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <a href="{{ route('webcomics.show', $webcomic) }}">{{ $webcomic->name }}</a>
                            </td>
                            <td class="py-3 px-6 text-left">{{ $webcomic->author }}</td>
                            <td class="py-3 px-6 text-left">{{ $webcomic->sources->count() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div><a href="{{ route('webcomics.create') }}"><i class="fa fa-plus"></i> Add new webcomic</a></div>
        </x-card>
    </div>
</x-app-layout>
