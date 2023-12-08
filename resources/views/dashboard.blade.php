<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900">
                    {{ __("You're logged in!") }}

                    <form action="{{ route('user_cv.search') }}" method="GET">
                        <input type="text" name="search" placeholder="Search by Status" value="{{ request('search') }}">
                        <button type="submit">Search</button>
                    </form>

                    @if (isset($userCVs) && count($userCVs) > 0)
                        @foreach ($userCVs as $usercv)
                            <div class="user-cv-item">
                                <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"
                                    class="user-cv-item">
                                    <div style="margin-bottom: 10px;">
                                        <strong style="margin-right: 5px;">Name:</strong> {{ $usercv->name }}
                                    </div>
                                    <div style="margin-bottom: 10px;">
                                        <strong style="margin-right: 5px;">Technology:</strong>
                                        {{ $usercv->technology }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="no-results-message" style="margin-top: 20px; color: #555; font-style: italic;">
                            .....NO results found
                        </div>
                    @endif

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
