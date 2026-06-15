<x-filament::page>
    <h2 class="text-2xl font-bold mb-4">
        Categories for: {{ $exam->title }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        @foreach($exam->categories as $category)
            <div class="bg-white shadow p-4 rounded-xl">

                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-bold text-lg">{{ $category->name }}</h3>

                    <div class="flex gap-2">
                        <x-filament::button 
                            color="gray"
                            tag="a"
                            href="{{ route('filament.admin.resources.exam-categories.edit', $category) }}">
                            Edit
                        </x-filament::button>

                        <x-filament::button 
                            color="primary"
                            tag="a"
                            href="{{ route('filament.admin.resources.exam-tasks.create', ['category_id' => $category->id]) }}">
                            Add Task
                        </x-filament::button>
                    </div>
                </div>

                <p class="text-sm text-gray-600">
                    {{ $category->tasks->count() }} tasks
                </p>

                <ul class="mt-3 space-y-2">
                    @foreach($category->tasks as $task)
                        <li class="p-2 bg-gray-100 rounded flex justify-between">
                            <span>{{ $task->title }}</span>
                            <a href="{{ route('filament.admin.resources.exam-tasks.edit', $task) }}" class="text-blue-600">
                                Edit
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        @endforeach

    </div>

    <x-filament::button 
        icon="heroicon-o-plus"
        class="mt-6"
        color="success"
        tag="a"
        href="{{ route('filament.admin.resources.exam-categories.create', ['exam_id' => $exam->id]) }}">
        Add New Category
    </x-filament::button>
</x-filament::page>
