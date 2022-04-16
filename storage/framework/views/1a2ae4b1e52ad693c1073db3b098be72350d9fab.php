<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Questions')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button class="btn btn-sm btn-secondary" id="add-question">
                        Add question
                    </button>
                    Total mark: <?php echo e($quiz->mark); ?>

                </div>
                <div class="p-2">
                    <?php if(count($questions)): ?>
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
                            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($question->id); ?></td>
                                    <td><?php echo e($question->question); ?></td>
                                    <td><?php echo e($question->mark); ?></td>
                                    <td>
                                        <a href="<?php echo e(route("delete-question",['id'=>$question->id])); ?>"
                                           class="btn btn-sm btn-danger">Delete question</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php echo e($questions->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
                <form action="<?php echo e(route("add-question",["quiz_id"=>$quiz_id])); ?>" type="post" class="p-6" id="questions-container">
                    <input type="hidden">
                    <?php echo csrf_field(); ?>
                </form>
                <div class="d-flex justify-content-end p-6">
                    <button id="create-question-button" class="btn btn-success d-none">Create question</button>
                </div>
        </div>
    </div>
    <?php $__env->startPush("js"); ?>
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
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/quiz.loc/resources/views/pages/questions.blade.php ENDPATH**/ ?>