<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900">
                    {{ __("You're logged in!") }}
                    <div class="mt-4">
                        <x-primary-button class="ml-3">
                            <a href="{{ route('user_cv.create') }}" class="text-blue-500 hover:underline">Upload your
                                CV</a>

                        </x-primary-button>
                    </div>
                    <div class="mt-4">
                    </div>
                    <x-primary-button class="ml-3">
                        <a href="{{ route('user_cv.index') }}" class="text-blue-500 hover:underline">List of the user's
                            CV</a>

                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
