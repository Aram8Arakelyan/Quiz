<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quiz') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="Clock">
            <div id="hour"></div>
            <div id="minute"></div>
            <div id="second"></div>
            <div class="block"></div>
            <div class="numbers twelve">12</div>
            <div class="numbers one">1</div>
            <div class="numbers two">2</div>
            <div class="numbers three">3</div>
            <div class="numbers four">4</div>
            <div class="numbers five">5</div>
            <div class="numbers six">6</div>
            <div class="numbers seven">7</div>
            <div class="numbers eight">8</div>
            <div class="numbers nine">9</div>
            <div class="numbers ten">10</div>
            <div class="numbers eleven">11</div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3 mb-3">
            <div class="container">
                <ul>
                    <li>Quiz Name: {{$quiz->name}}</li>
                    <li>Total mark: {{$quiz->mark}}</li>
                    <li>Started at: {{$quiz->started_at}}</li>
                    <li>Finished at: {{$quiz->finished_at}}</li>
                </ul>
                <div>
                    <form id="quiz-form" method="post" action="{{route("send-result")}}">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        @foreach($quiz->questions as $question)
                            <div>
                                <div>
                                    Question:
                                    {{$question->question}}
                                </div>
                                <div>
                                    Mark: {{$question->data["mark"]}}
                                </div>
                            </div>
                            <hr>
                            @foreach($question->data["answers"] as $key => $answer)
                                @if($key!='right_answer')
                                    <div>
                                        <label for="">
                                            @if($question->data['question_type'] == "optional")
                                                <input type="radio" value="{{$answer}}" name="{{$question->id}}">
                                            @endif
                                            {{$answer}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            <hr>
                            @if($question->data['question_type'] != "optional")
                                <input type="text" name="{{$question->id}}">
                                <hr>
                            @endif
                        @endforeach
                        <div class="flex justify-content-end mb-2">
                            <button class="btn btn-sm btn-success">Send Result</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push("css")
        <style>
            body {
                background: radial-gradient(
                    ellipse at center,
                    rgb(165, 166, 212) 0%,
                    rgb(235, 171, 171) 100%
                );
            }

            .Clock {
                position: absolute;
                right: 20%;
                width: 100px;
                height: 100px;
                background: radial-gradient(
                    circle at center,
                    rgb(8, 8, 0),
                    rgba(12, 6, 6, 0.795)
                );
                transform-origin: left bottom;
                border-radius: 145px;
                border: white solid 2px;
            }

            #hour {
                position: absolute;
                width: 1%;
                height: 25%;
                top: 25%;
                left: 50%;
                transform-origin: bottom;
                background-color: aliceblue;
            }

            #minute {
                position: absolute;
                width: 1%;
                height: 30%;
                top: 20%;
                left: 50%;
                transform-origin: bottom;
                background-color: aliceblue;
                z-index: 0.4;
            }

            #second {
                position: absolute;
                width: 1%;
                height: 35%;
                top: 15%;
                left: 50%;
                background-color: red;
                transform-origin: bottom;
                z-index: 0.5;
            }

            .Clock .block {
                position: absolute;
                width: 9px;
                height: 9px;
                border-radius: 50%;
                background-color: rgb(165, 178, 190);
                transform: translateX(147px) translateY(144px);
                z-index: 1;
            }

            .Clock .numbers {
                --angle: 0;
                position: absolute;
                font-size: 10px;
                font-family: sans-serif;
                color: rgb(250, 249, 245);
                transform: rotate(var(--angle));
                width: 100%;
                height: 100%;
                text-align: center;
            }

            .Clock .one {
                --angle: 30deg;
            }

            .Clock .two {
                --angle: 60deg;
            }

            .Clock .three {
                --angle: 90deg;
            }

            .Clock .four {
                --angle: 120deg;
            }

            .Clock .five {
                --angle: 150deg;
            }

            .Clock .six {
                --angle: 0deg;
                transform: translateY(272px);
            }

            .Clock .seven {
                --angle: 210deg;
            }

            .Clock .eight {
                --angle: 240deg;
            }

            .Clock .nine {
                --angle: 270deg;
            }

            .Clock .ten {
                --angle: 300deg;
            }

            .Clock .eleven {
                --angle: 330deg;
            }

        </style>
    @endpush
    @push("js")
        <script>
            const endDate = new Date("{{$quiz->finished_at}}");
            setInterval(() => {
                const todayDate = new Date();
                console.log(endDate, todayDate)
                if (endDate.toString() === todayDate.toString()) {
                    $("#quiz-form").submit()
                }
                const hourTime = todayDate.getHours();
                const minuteTime = todayDate.getMinutes();
                const secondTime = todayDate.getSeconds();
                const hRotation = 30 * hourTime + minuteTime / 2;
                const mRotation = 6 * minuteTime;
                const sRotation = 6 * secondTime;
                hour.style.transform = `rotate(${hRotation}deg)`;
                minute.style.transform = `rotate(${mRotation}deg)`;
                second.style.transform = `rotate(${sRotation}deg)`;

            }, 1000);

        </script>
    @endpush
</x-app-layout>
