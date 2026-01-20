<?php $__env->startComponent('mail::message'); ?>
# Reset Password - Kode OTP

Halo,

Anda menerima email ini karena ada permintaan reset password untuk akun Anda di **PPDB Online**.

Gunakan kode OTP berikut untuk melanjutkan:

<?php $__env->startComponent('mail::panel'); ?>
<div style="text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 8px; color: #667eea;">
<?php echo new \Illuminate\Support\EncodedHtmlString($otp); ?>

</div>
<?php echo $__env->renderComponent(); ?>

**Kode ini akan kedaluwarsa dalam 10 menit.**

Jika Anda tidak meminta reset password, abaikan email ini. Akun Anda tetap aman.

Terima kasih,<br>
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>


---
<small style="color: #999;">Email ini dikirim secara otomatis. Mohon jangan membalas email ini.</small>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\ujian_ukk_ppdb\resources\views/emails/reset_otp.blade.php ENDPATH**/ ?>