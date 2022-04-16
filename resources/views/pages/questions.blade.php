<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button class="btn btn-sm btn-secondary" id="add-question">
                        Add question
                    </button>
                    Total mark: {{$quiz->mark}}
                </div>
                <div class="p-2">
                    @if(count($questions))
                        <table border="1px" cellpadding="10" cellspacing="2">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Question</th>
                                <th>Mark</th>
                                <th>Delete question</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($questions as $key => $question)
                                <tr>
                                    <td>{{$question->id}}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ $question->mark }}</td>
                                    <td>
                                        <a href="{{route("delete-question",['id'=>$question->id])}}"
                                           class="btn btn-sm btn-danger">Delete question</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $questions->links() }}
                    @endif
                </div>
            </div>
                <form action="{{route("add-question",["quiz_id"=>$quiz_id])}}" type="post" class="p-6" id="questions-container">
                    <input type="hidden">
                    @csrf
                </form>
                <div class="d-flex justify-content-end p-6">
                    <button id="create-question-button" class="btn btn-success d-none">Create question</button>
                </div>
        </div>
    </div>
    @push("js")
        <script>
            $("#add-question").one("click", () => {
                $("#create-question-button").removeClass("d-none")
                $("#questions-container").append(`<div class="d-flex justify-content-start">
                   <div class="mr-2">
                        <div>Question</div>
                        <input type="text" name="question">
                    </div>
                    <div class="mr-2">
                        <div>Question mark</div>
                        <input type="number" name="mark">
                    </div>
                    <div>
                        <div>Question type</div>
                        <select name="type" id="question-type">
                            <option value="optional">Optional</option>
                            <option value="written">Written</option>
                        </select>
                    </div>
                </div>
                <div>
                 <div class="add-answer btn btn-outline-secondary mt-2 mb-2">Add answers</div>
                </div>
                `)
                let key = 1;
                $(".add-answer").click(() => {
                    $("#questions-container").append(`<div class="mb-1 d-flex justify-content-start align-items-center">
                        <span class="mr-2">${key}</span>
                        <input value="${key}" class="mr-2" type="radio" name="right_answer">
                        <input class="mr-2" type="text" name="answer_${key}"/>
                        <div class="delete-answer btn btn-sm btn-danger mb-0">Delete answer</div>
                    </div>`)
                    $(".delete-answer").click((el) => {
                        $(el.target).parent().remove()
                    })
                    key++;
                })
            })
            $("#create-question-button").one("click",()=>{
                $("#questions-container").submit()
            })
        </script>
    @endpush
</x-app-layout>
