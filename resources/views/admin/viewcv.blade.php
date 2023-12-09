    {{-- @extends('layouts.app') --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
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
                    {{-- <x-primary-button class="ml-3" id="postYourAdd" onclick="postYourAdd()">
                        {{ __('VIEW CV') }} &nbsp;<i class="fa fa-eye"></i>
                    </x-primary-button> --}}

                </div>
            </div>

        </div>
        <div class="row justify-content-center p-4" >
            <iframe  src="{{ asset('storage/cv/' . $userCVs['document']) }}"  
                height="1000" width="100%"></iframe>
        </div><br><br>

        </div>
        {{-- <script>
            function postYourAdd() {
                var iframe = $("#forPostyouradd");
                iframe.attr("src", iframe.data("src"));
                iframe.removeClass("hidden");
                $("#removeYourAdd").removeClass("hidden");
                $("#postYourAdd").addClass("hidden");
            }
        </script> --}}


    </x-app-layout>
