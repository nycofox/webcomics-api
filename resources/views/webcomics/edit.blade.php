<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Webcomics -
            <a href="{{ route('webcomics.show', $webcomic) }}">Edit {{ $webcomic->name }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{ route('webcomics.update', $webcomic) }}">
                @csrf
                @method('PATCH')

                @include('webcomics._form')

                <x-button>
                    Update {{ $webcomic->name }}
                </x-button>

            </form>
        </x-card>
    </div>
</x-app-layout>
