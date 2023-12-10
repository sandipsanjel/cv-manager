    {{-- @extends('layouts.app') --}}
    <x-app-layout>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
                    {{ 'Users CV list' }}
                </h2>
                <form class="col-9 flex items-center">
                    <input type="text" name="search" placeholder="name or status" value="{{$search}}">
                    <x-primary-button class="ml-3">
                        <div type="submit">Search</div>
                    </x-primary-button>
                    <x-primary-button class="ml-3">
                        <a href="{{ route('user_cv.index') }}">Refresh</a>
                    </x-primary-button>
                </form>
            </div>
        </x-slot>

        <div style="width: 100%; margin: 20px;" class="user-cvs-container">
            @if (isset($userCVs) && count($userCVs) > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 125px;"
                    class="user-cvs-list">
                    @foreach ($userCVs as $userCV)
                        <div class="user-cv-item">
                            <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"
                                class="user-cv-item">
                                <div style="margin-bottom: 10px;">
                                    <strong style="margin-right: 5px;">Name:</strong> {{ $userCV->name }}
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <strong style="margin-right: 5px;">Technology:</strong> {{ $userCV->technology }}
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <strong style="margin-right: 5px;">status:</strong>
                                    {{ $userCV->cvStatus->status ?? 'N/A' }}
                                </div>

                                <div style="margin-bottom: 10px;">
                                    <strong style="margin-right: 5px;">Remarks:</strong>
                                    {{ $userCV->cvStatus->remarks ?? 'N/A' }}
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <strong style="margin-right: 5px;">Assigned Interviewer:</strong>
                                    {{ $userCV->cvStatus->interviewers_list ?? 'N/A' }}
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <strong style="margin-right: 5px;">Interview-Date :</strong>
                                    {{ $userCV->cvStatus->interview_date ?? 'N/A' }}
                                </div>
                                <style>
                                    .user-cv-item {
                                        position: relative;
                                    }

                                    .action-buttons {
                                        position: absolute;
                                        top: 0;
                                        right: 0;
                                        margin: 10px;
                                    }

                                    .edit-button,
                                    .list-button,
                                    .delete-button {
                                        margin-right: 5px;
                                        padding: 10px;
                                        border: 1px solid #ddd;
                                        border-radius: 5px;
                                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        cursor: pointer;
                                    }
                                </style>
                                <div class="action-buttons">
                                    <button onclick="window.location.href='cv_status/edit/{{ $userCV->id }}'"
                                        class="edit-button">
                                       Edit
                                    </button>
                                    <button onclick="window.location.href='cv_status/delete/{{ $userCV->id }}'"
                                        class="delete-button">
                                        Delete
                                    </button>
                                    <button onclick="window.location.href='showusers/{{ $userCV->id }}'"
                                        class="list-button">
                                        view
                                    </button>
                                    {{-- <a href="showupsers/{{ $userCV->id }}" class="list-button">
                                        CV-list
                                    </a> --}}
                                </div>
                            </div>
                    @endforeach
                </div>
            @else
                <p>No User CVs available.</p>
            @endif
        </div>


    </x-app-layout>
