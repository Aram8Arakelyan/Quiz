<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        <!-- Icons -->
        <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

        <!-- Scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
        <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
        <?php echo $__env->yieldPushContent("css"); ?>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>

            <!-- Page Content -->
            <main>
                <?php echo e($slot); ?>

            </main>
        </div>
        <script src="<?php echo e(mix('js/app.js')); ?>"></script>
        <?php if($errors->any()): ?>
            <script>
                toastr.error("<?php echo implode('', $errors->all(':message')); ?>")
            </script>
        <?php endif; ?>
        <?php if(session()->has('success')): ?>
            <script>
                toastr.success("<?php echo session()->get("success"); ?>")
            </script>
        <?php endif; ?>
        <?php echo $__env->yieldPushContent("js"); ?>
    </body>
</html>
<?php /**PATH /var/www/quiz.loc/resources/views/layouts/app.blade.php ENDPATH**/ ?>