<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('webcomics.index') }}">Webcomics</a> -
            <a href="{{ route('webcomics.show', $webcomic) }}">{{ $webcomic->name }}</a> -
            Edit source <span class="text-gray-500">{{ $source->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{ route('webcomics.sources.update', [$webcomic, $source]) }}">
                @csrf
                @method('PATCH')

                @include('sources._form')

                <div class="mb-2">
                    <input id="active" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="active"
                           @if($source->active) checked @endif>
                    <span class="ml-2 text-sm text-gray-600">Active</span>
                </div>

                <x-button>
                    Update {{ $source->name }}
                </x-button>

            </form>
        </x-card>
    </div>
</x-app-layout>
