<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Results')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-auto">
                    <div class="container mb-2">
                        <?php if(count($results)): ?>
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
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($result->id); ?></td>
                                        <td><?php echo e($result->email); ?></td>
                                        <td><?php echo e($result->mark); ?></td>
                                        <td class="text-nowrap"><?php echo e($result->started_at ?? "-"); ?></td>
                                        <td class="text-nowrap"><?php echo e($result->finished_at ?? "-"); ?></td>
                                        <td>
                                            <a href="<?php echo e(route("delete-result",['id'=>$result->id])); ?>"
                                               class="btn btn-sm btn-danger text-nowrap">Delete result</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>

                    <?php echo e($results->links()); ?>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/quiz.loc/resources/views/pages/results.blade.php ENDPATH**/ ?>