<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome Teacher you are logged in!") }}
                    <br>
                    Please click the link below to add student details to the prediction system.
                    <br>
                    <a href="{{route('student.index')}}" class="text-green-700 hover:text-green-400">Student Page</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
