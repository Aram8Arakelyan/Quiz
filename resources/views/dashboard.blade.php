<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-auto">
                    <div class="p-2">
                        <p>Create new quiz</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#create-quiz-modal">
                            New quiz
                        </button>

                        <div class="modal fade" id="create-quiz-modal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create quiz</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('create-quiz')}}" type="post">
                                            @csrf
                                            <label for="">
                                                <div>Name</div>
                                                <input class="w-100" type="text" name="name">
                                            </label>
                                            <label for="">
                                                <div>Total mark</div>
                                                <input class="w-100" type="number" min="1" name="mark">
                                            </label>
                                            <label for="">
                                                <div>Quiz times</div>
                                                <input style="width: 400px" id="quiz-time" type="text" name="time">
                                            </label>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-success">
                                                    Create
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container mb-2">
                        @if(count($quizzes))
                            <table border="1px" cellpadding="10" cellspacing="2">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Mark</th>
                                    <th>Started at</th>
                                    <th>Finished at</th>
                                    <th>Add questions</th>
                                    <th>Delete</th>
                                    <th class="text-nowrap">Send to students</th>
                                    <th class="text-nowrap">Show results</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($quizzes as $key => $quiz)
                                    <tr>
                                        <td>{{$quiz->id}}</td>
                                        <td>{{ $quiz->name }}</td>
                                        <td>{{ $quiz->mark }}</td>
                                        <td class="text-nowrap">{{ $quiz->started_at ?? "-" }}</td>
                                        <td class="text-nowrap">{{ $quiz->finished_at ?? "-" }}</td>
                                        <td>
                                            <a href="{{route('question',['id'=>$quiz->id])}}"
                                               class="btn btn-sm btn-primary mr-2 text-nowrap">Add questions</a>
                                        </td>
                                        <td>
                                            <a href="{{route("delete-quiz",['id'=>$quiz->id])}}"
                                               class="btn btn-sm btn-danger text-nowrap">Delete quiz</a>
                                        </td>
                                        <td>
                                            <button data-id="{{$quiz->id}}"
                                                    class="btn btn-sm btn-success send-to-students">Send
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{route("show-results",['id'=>$quiz->id])}}"
                                               class="btn btn-sm btn-danger text-nowrap">Delete quiz</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    {{ $quizzes->links() }}
                    <div class="modal fade" id="send-modal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create quiz</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('send-students')}}" type="post">
                                        @csrf
                                        <input name="quiz_id" type="hidden" id="quiz-id">
                                        <input type="text" name="emails"/>
                                        <button class="btn btn-sm btn-success">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push("js")
        <script>
            $(".send-to-students").click((el) => {
                $('#quiz-id').val($(el.target).data("id"))
                $("#send-modal").modal("show")
            })
        </script>
    @endpush
</x-app-layout>
