    {{-- @extends('layouts.app') --}}
    <x-app-layout>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
                    {{ 'Users CV list' }}
                </h2>

        </x-slot>

        @livewire('searchcv')

    </x-app-layout>
