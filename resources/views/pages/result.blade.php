<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Result') }}
        </h2>
    </x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3 mb-3 p-5 text-center">
        <h1>Congretulations!</h1>
        <h2>Mark: {{$mark}}/{{$total}}</h2>
    </div>
</x-app-layout>
