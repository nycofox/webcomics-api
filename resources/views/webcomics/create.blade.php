<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('webcomics.index') }}">Webcomics</a> -
            Create a new Webcomic
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{ route('webcomics.store') }}">
            @csrf

               @include('webcomics._form')

                <x-button>
                    Add Webcomic
                </x-button>

            </form>
        </x-card>
    </div>
</x-app-layout>
