@props(['item'])

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<a href="{{ $item->url }}" target="_blank" class="block text-current no-underline">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:bg-gray-50 dark:hover:bg-gray-700 dark:bg-gray-800">
        <div class="p-4 flex">
            <div class="flex-none w-16 h-16 mr-4">
                <img onerror="this.src = '{{ default_404_image() }}'"
                     src="{{ $item->image_path ?? resourceUrl($item?->provider?->image_path) }}" alt="Company Logo"
                     class="w-full h-full object-cover rounded-full bg-white">
            </div>
            <div class="flex-grow min-w-0">
                <div class="whitespace-nowrap overflow-x-auto hide-scrollbar">
                    <h3 class="text-lg font-semibold dark:text-white">{{ $item->english_name ?? $item->name }}</h3>
                </div>
                <p class="text-sm text-gray-600">{{ $item->description }}</p>
                <div class="flex flex-nowrap items-center gap-2 mt-2 whitespace-nowrap overflow-x-auto hide-scrollbar">
                    @if($item->city)
                        <span
                            class="text-sm bg-blue-100 dark:bg-gray-600 text-blue-800 dark:text-gray-200 px-3 py-1 rounded-full">{{ $item?->city?->name ?? '' }}</span>
                    @endif
                    <span
                        class="text-sm bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full">{{ $item?->deadline?->format('d.M.Y') ?? 'No Deadline' }}</span>

                    @if ($item->categories->count() > 0)
                        @foreach($item->categories as $category)
                            <span
                                class="text-sm bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full">{{ $category->name }}</span>
                        @endforeach
                    @else
                        <span
                            class="text-sm bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full">{{ $item->provider->name }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</a>
