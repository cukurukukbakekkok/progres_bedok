<!DOCTYPE html>
<html lang="en">
    <!-- [Head] start -->

    <head>

        <title><?php echo $__env->yieldContent('title'); ?></title>

        <!-- [Meta] -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description"
            content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
        <meta name="keywords"
            content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
        <meta name="author" content="CodedThemes">

        <!-- [Favicon] icon -->
        <link rel="icon" href="<?php echo e(asset('assets/images/favicon.svg')); ?>" type="image/x-icon">
        <!-- [Google Font] Family -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
            id="main-font-link">
        <!-- [Tabler Icons] https://tablericons.com -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
        <!-- [Feather Icons] https://feathericons.com -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
        <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
        <!-- [Material Icons] https://fonts.google.com/icons -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
        <!-- [Template CSS Files] -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-preset.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/landing-modern.css')); ?>">

        <style>
            :root {
                --bs-body-bg: transparent !important;
            }

            body, body.auth-page {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                min-height: 100vh !important;
                background-attachment: fixed !important;
            }

            .auth-page-wrapper {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .auth-page-container {
                width: 100%;
                max-width: 500px;
                padding: 20px;
            }
        </style>

    </head>
    <!-- [Head] end -->
    <!-- [Body] Start -->

    <body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; min-height: 100vh; margin: 0; padding: 0; position: relative; overflow-x: hidden;">
        <!-- Animated Background Shapes -->
        <div style="position: fixed; top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(255, 255, 255, 0.08); border-radius: 50%; animation: float 8s ease-in-out infinite; pointer-events: none; z-index: 0;"></div>
        <div style="position: fixed; bottom: -100px; left: -100px; width: 350px; height: 350px; background: rgba(255, 235, 59, 0.1); border-radius: 50%; animation: float 10s ease-in-out infinite 2s; pointer-events: none; z-index: 0;"></div>
        <div style="position: fixed; top: 50%; right: 10%; width: 200px; height: 200px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; animation: float 12s ease-in-out infinite 1s; pointer-events: none; z-index: 0;"></div>

        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->

        <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; width: 100%; padding: 20px 0; position: relative; z-index: 1; background: transparent !important;">
            <div style="width: 100%; padding: 0 15px; background: transparent !important;">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
        <!-- [ Main Content ] end -->
        <!-- Required Js -->
        <script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/plugins/simplebar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/fonts/custom-font.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/pcoded.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>


        <script>
            layout_change('light');
        </script>

        <script>
            change_box_container('false');
        </script>



        <script>
            layout_rtl_change('false');
        </script>


        <script>
            preset_change("preset-1");
        </script>


        <script>
            font_change("Public-Sans");
        </script>


        <script>
            document.addEventListener("DOMContentLoaded", function() {

                const forms = document.querySelectorAll('form[method="post"]');

                forms.forEach(form => {
                    form.addEventListener("submit", function() {
                        const submitButton = form.querySelector('button[type="submit"]');
                        submitButton.disabled = true;
                        submitButton.innerHTML = "Processing...";
                    });
                });
            });
        </script>

        <?php echo $__env->yieldContent('scripts_content'); ?>

    </body>
    <!-- [Body] end -->

</html>
<?php /**PATH C:\ujian_ukk_ppdb\resources\views/layouts/auth.blade.php ENDPATH**/ ?>