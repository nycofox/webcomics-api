<!-- Name -->
<div class="mb-2">
    <x-label for="name" value="Name"/>
    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $webcomic->name ?? old('name')}}"
             required autofocus/>
</div>

<!-- Author -->
<div class="mb-2">
    <x-label for="author" value="Author"/>
    <x-input id="author" class="block mt-1 w-full" type="text" name="author"
             value="{{ $webcomic->author ?? old('author')}}"/>
</div>
