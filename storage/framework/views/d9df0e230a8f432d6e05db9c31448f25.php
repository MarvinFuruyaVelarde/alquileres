 <!-- Vendor JS Files -->
 <script src="<?php echo e(asset('assets/vendor/apexcharts/apexcharts.min.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/chart.js/chart.umd.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/echarts/echarts.min.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/quill/quill.min.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/tinymce/tinymce.min.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/php-email-form/validate.js')); ?>"></script>

 <!-- Template Main JS File -->
 <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/datatables/dataTables.min.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/vendor/select2/select2.min.js')); ?>"></script>
 <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php echo $__env->yieldContent('scripts'); ?><?php /**PATH C:\xampp\htdocs\sistema_alquileres\resources\views/layouts/partials/scripts.blade.php ENDPATH**/ ?>