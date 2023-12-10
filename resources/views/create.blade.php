<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 leading-tight">
            Create User CV
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- form goes here -->
                <form action="{{ route('user_cv.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                        <input type="text" name="name" id="name" class="border rounded w-full py-2 px-3"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone:</label>
                        <input type="text" name="phone" id="phone" class="border rounded w-full py-2 px-3">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" class="border rounded w-full py-2 px-3"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="references" class="block text-gray-700 text-sm font-bold mb-2">References:</label>
                        <textarea name="references" id="references" class="border rounded w-full py-2 px-3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="technology" class="block text-gray-700 text-sm font-bold mb-2">Technology:</label>
                        <input type="text" name="technology" id="technology" class="border rounded w-full py-2 px-3">
                    </div>

                    <div class="mb-4">
                        <label for="level" class="block text-gray-700 text-sm font-bold mb-2">Level:</label>
                        <select name="level" id="level" class="border rounded w-full py-2 px-3">
                            <option value="Junior">Junior</option>
                            <option value="Mid">Mid</option>
                            <option value="Senior">Senior</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="salary_expectation" class="block text-gray-700 text-sm font-bold mb-2">Salary
                            Expectation:</label>
                        <input type="text" name="salary_expectation" id="salary_expectation"
                            class="border rounded w-full py-2 px-3">
                    </div>

                    <div class="mb-4">
                        <label for="experience" class="block text-gray-700 text-sm font-bold mb-2">Experience (in
                            years):</label>
                        <input type="text" name="experience_years" id="experience" class="border rounded w-full py-2 px-3">
                    </div>
                    <div class="mb-4">
                        <label for="document" class="block text-gray-700 text-sm font-bold mb-2">Document (PDF):</label>
                        <input type="file" name="document" id="document" accept=".pdf" class="border rounded w-full py-2 px-3">
                    </div>
{{-- 
                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-black py-2 px-4 rounded">Create CV</button>
                    </div> --}}
                    <x-primary-button class="ml-3">
                        Upload CV
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
