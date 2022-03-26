<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-auto">
                    <div class="container mb-2">
                        @if(count($results))
                            <table border="1px" cellpadding="10" cellspacing="2">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Email</th>
                                    <th>Mark</th>
                                    <th>Started at</th>
                                    <th>Finished at</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($results as $key => $result)
                                    <tr>
                                        <td>{{$result->id}}</td>
                                        <td>{{ $result->email }}</td>
                                        <td>{{ $result->mark }}</td>
                                        <td class="text-nowrap">{{ $result->started_at ?? "-" }}</td>
                                        <td class="text-nowrap">{{ $result->finished_at ?? "-" }}</td>
                                        <td>
                                            <a href="{{route("delete-result",['id'=>$result->id])}}"
                                               class="btn btn-sm btn-danger text-nowrap">Delete result</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h2 class="text-center">No results yet</h2>
                        @endif
                    </div>

                    {{ $results->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
