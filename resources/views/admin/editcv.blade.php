    {{-- @extends('layouts.app') --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create CV Status') }}
            </h2>
        </x-slot>

        <div style="width: 100%; margin: 20px;" class="user-cvs-container">
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 125px;"
                class="user-cvs-list">
                <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"
                    class="user-cv-item">
                   
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Id:</strong> {{ $userCVs->id }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Name:</strong> {{ $userCVs->name }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Phone:</strong> {{ $userCVs->phone }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Email:</strong> {{ $userCVs->email }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">References:</strong> {{ $userCVs->references }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Technology:</strong> {{ $userCVs->technology }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Level:</strong> {{ $userCVs->level }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Salary Expectation:</strong>
                        {{ $userCVs->salary_expectation }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Experience:</strong> {{ $userCVs->experience_years }}
                    </div>
                    <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Document:</strong>
                        <img src="{{ $userCVs->document }}" alt="User Document" style="max-width: 100%; height: auto;">
                    </div>
                    {{-- <div style="margin-bottom: 10px;">
                        <strong style="margin-right: 5px;">Created At:</strong>
                        {{ $userCVs->created_at->format('Y-m-d H:i:s') }}
                    </div> --}}

                    <div class="p-6">
                        <form action="{{ route('cv_status.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                {{-- <label for="usercv_id" class="form-label">User CV ID:</label><label>{{ $userCVs->id }} </label> --}}
                                {{-- <input type="text" name="usercv_id" class="form-control" required> --}}
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                    Status:
                                </label>
                                <select name="status" id="status" class="form-select rounded-md shadow-sm">
                                    <option value="shortlisted">Shortlisted</option>
                                    <option value="First Interview">First Interview</option>
                                    <option value="Second Interview">Second Interview</option>
                                    <option value="Third Interview">Third Interview</option>
                                    <option value="Hired">Hired</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="task" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                    Upload Task:
                                </label>
                                <input type="file" name="task" id="task"
                                    class="form-input rounded-md shadow-sm">
                            </div>
                            <div class="mb-4">
                                <label for="interview_date"
                                    class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                    Interview Date:
                                </label>
                                <input type="date" name="interview_date" id="interview_date"
                                    class="form-input rounded-md shadow-sm">
                            </div>
                            <div class="mb-4">
                                <label for="interviewers_list"
                                    class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                    Interviewers List:
                                </label>
                                <select name="interviewers_list" id="interviewers_list"
                                    class="form-select rounded-md shadow-sm">
                                    <option value="Interviewer 1">Interviewer 1</option>
                                    <option value="Interviewer 2">Interviewer 2</option>
                                    <option value="Interviewer 2">Interviewer 3</option>
                                    <option value="Interviewer 2">Interviewer 4</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="remarks" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                    Remarks:
                                </label>
                                <textarea name="remarks" id="remarks" class="form-textarea rounded-md shadow-sm"></textarea>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="bg-blue-500 text-black rounded-md px-4 py-2">
                                    Create CV Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>


    </x-app-layout>
