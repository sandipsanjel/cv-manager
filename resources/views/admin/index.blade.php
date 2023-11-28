    {{-- @extends('layouts.app') --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ 'Users CV list' }}
            </h2>
        </x-slot>

        <div style="width: 100%; margin: 20px;" class="user-cvs-container">
            @if (isset($userCVs) && count($userCVs) > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 125px;"
                    class="user-cvs-list">
                    @foreach ($userCVs as $userCV)
                        <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"
                            class="user-cv-item">
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Name:</strong> {{ $userCV->name }}
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Phone:</strong> {{ $userCV->phone }}
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Email:</strong> {{ $userCV->email }}
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">References:</strong> {{ $userCV->references }}
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Technology:</strong> {{ $userCV->technology }}
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Level:</strong> {{ $userCV->level }}
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Salary Expectation:</strong>
                                {{ $userCV->salary_expectation }}
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Experience:</strong> {{ $userCV->experience_years }}
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Document:</strong>
                                <img src="{{ $userCV->document }}" alt="User Document" style="max-width: 100%; height: auto;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <strong style="margin-right: 5px;">Created At:</strong>
                                {{ $userCV->created_at->format('Y-m-d H:i:s') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No User CVs available.</p>
            @endif
        </div>


    </x-app-layout>
