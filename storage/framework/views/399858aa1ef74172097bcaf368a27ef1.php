<?php $__env->startSection('title', 'Reset Password - PPDB'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 500px; margin: 0 auto; width: 100%; position: relative; z-index: 2;">
        <!-- Decorative Circle Top -->
        <div style="position: absolute; top: -60px; left: -60px; width: 120px; height: 120px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; animation: float 6s ease-in-out infinite; pointer-events: none;"></div>
        <div style="position: absolute; top: -40px; right: -40px; width: 80px; height: 80px; background: rgba(255, 235, 59, 0.15); border-radius: 50%; animation: float 8s ease-in-out infinite 1s; pointer-events: none;"></div>

        <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px);">
            
            <!-- Header dengan Gradient -->
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 50px 30px; text-align: center; position: relative; overflow: hidden;">
                <!-- Decorative shapes in header -->
                <div style="position: absolute; top: 10px; right: 20px; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; opacity: 0.5;"></div>
                <div style="position: absolute; bottom: 20px; left: 30px; width: 40px; height: 40px; background: rgba(255, 235, 59, 0.2); border-radius: 50%; opacity: 0.5;"></div>
                
                <div style="position: relative; z-index: 2;">
                    <div style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                        <i class="ti ti-shield-check" style="font-size: 36px; color: white;"></i>
                    </div>
                    <h2 class="text-white mb-2" style="font-weight: 700; margin: 0; letter-spacing: -0.5px;">Verifikasi OTP</h2>
                    <p class="text-white" style="margin: 0; opacity: 0.9; font-size: 14px; font-weight: 300;">Kode dikirim ke: <b><?php echo e($email ?? 'email@unknown.com'); ?></b></p>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('password.update.otp')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="email" value="<?php echo e($email); ?>">
                
                <div style="padding: 40px 30px;">
                    <?php if(session('success')): ?>
                        <div style="background: linear-gradient(135deg, #dff0d8 0%, #d0e8d0 100%); border-radius: 12px; padding: 15px; margin-bottom: 20px; border-left: 4px solid #28a745; color: #155724;">
                            <i class="ti ti-check-circle"></i> <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div style="background: linear-gradient(135deg, #fee 0%, #fdd 100%); border-radius: 12px; padding: 15px; margin-bottom: 20px; border-left: 4px solid #dc3545; color: #721c24;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div style="margin: 5px 0;"><i class="ti ti-alert-circle"></i> <?php echo e($error); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <!-- OTP Input -->
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333; font-size: 14px; text-align: center;">Masukkan 6 Digit Kode OTP</label>
                        <div style="display: flex; border-radius: 12px; overflow: hidden; border: 2px solid #e0e0e0; transition: all 0.3s ease; background: #f8f9fa;">
                            <span style="background: transparent; border: none; padding: 14px 16px; color: #667eea; font-size: 18px;">
                                <i class="ti ti-key"></i>
                            </span>
                            <input type="text" class="form-control" name="otp" maxlength="6"
                                placeholder="123456" required
                                style="background: transparent; border: none; padding: 10px 0; flex: 1; font-size: 24px; letter-spacing: 8px; text-align: center; font-weight: 700;"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                onfocus="this.parentElement.style.borderColor='#667eea'; this.parentElement.style.background='#f0f2ff';"
                                onblur="this.parentElement.style.borderColor='#e0e0e0'; this.parentElement.style.background='#f8f9fa';">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333; font-size: 14px;">Password Baru</label>
                        <div style="display: flex; border-radius: 12px; overflow: hidden; border: 2px solid #e0e0e0; transition: all 0.3s ease; background: #f8f9fa;">
                            <span style="background: transparent; border: none; padding: 14px 16px; color: #667eea; font-size: 18px;">
                                <i class="ti ti-lock"></i>
                            </span>
                            <input type="password" class="form-control" name="password" 
                                placeholder="Minimal 8 karakter" required
                                style="background: transparent; border: none; padding: 10px 0; flex: 1; font-size: 15px;"
                                onfocus="this.parentElement.style.borderColor='#667eea'; this.parentElement.style.background='#f0f2ff';"
                                onblur="this.parentElement.style.borderColor='#e0e0e0'; this.parentElement.style.background='#f8f9fa';">
                        </div>
                    </div>

                    <!-- Confirm Password Input -->
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333; font-size: 14px;">Konfirmasi Password</label>
                        <div style="display: flex; border-radius: 12px; overflow: hidden; border: 2px solid #e0e0e0; transition: all 0.3s ease; background: #f8f9fa;">
                            <span style="background: transparent; border: none; padding: 14px 16px; color: #667eea; font-size: 18px;">
                                <i class="ti ti-lock-check"></i>
                            </span>
                            <input type="password" class="form-control" name="password_confirmation" 
                                placeholder="Ulangi password baru" required
                                style="background: transparent; border: none; padding: 10px 0; flex: 1; font-size: 15px;"
                                onfocus="this.parentElement.style.borderColor='#667eea'; this.parentElement.style.background='#f0f2ff';"
                                onblur="this.parentElement.style.borderColor='#e0e0e0'; this.parentElement.style.background='#f8f9fa';">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div style="margin-bottom: 18px;">
                        <button type="submit" style="width: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; padding: 14px 20px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; font-size: 15px; box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);" 
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 35px rgba(102, 126, 234, 0.4)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(102, 126, 234, 0.3)';">
                            <i class="ti ti-check"></i> Reset Password
                        </button>
                    </div>

                    <!-- Divider -->
                    <div style="text-align: center; margin-bottom: 18px; position: relative;">
                        <span style="color: #999; font-size: 13px; background: white; padding: 0 10px; position: relative;">Belum terima kode?</span>
                        <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #e0e0e0; z-index: -1;"></div>
                    </div>

                    <!-- Resend OTP -->
                    <div>
                        <form action="<?php echo e(route('password.email')); ?>" method="POST" id="resendForm" style="margin: 0;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="email" value="<?php echo e($email); ?>">
                            <button type="submit" id="resendBtn" disabled
                                style="width: 100%; display: block; text-align: center; background: rgba(102, 126, 234, 0.08); color: #667eea; border-radius: 12px; border: 2px solid rgba(102, 126, 234, 0.2); padding: 14px 20px; font-weight: 600; transition: all 0.3s ease; cursor: not-allowed; font-size: 15px; opacity: 0.6;"
                                onmouseover="if(!this.disabled) { this.style.background='rgba(102, 126, 234, 0.15)'; this.style.borderColor='#667eea'; }"
                                onmouseout="if(!this.disabled) { this.style.background='rgba(102, 126, 234, 0.08)'; this.style.borderColor='rgba(102, 126, 234, 0.2)'; }">
                                <i class="ti ti-refresh"></i> Kirim Ulang (<span id="timer">60</span>s)
                            </button>
                        </form>
                    </div>
                </div>
            </form>
        </div>

        <!-- Decorative Circle Bottom -->
        <div style="position: absolute; bottom: -80px; right: -80px; width: 160px; height: 160px; background: rgba(255, 255, 255, 0.08); border-radius: 50%; animation: float 10s ease-in-out infinite; pointer-events: none;"></div>

        <!-- Footer Text -->
        <p style="text-align: center; color: rgba(255, 255, 255, 0.7); margin-top: 30px; font-size: 12px;">
            © 2026 PPDB Online - SMK ANTARTIKA 1 SIDOARJO. All rights reserved.
        </p>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts_content'); ?>
<script>
    // Countdown Timer Logic
    let timeLeft = 60;
    const timerElem = document.getElementById('timer');
    const resendBtn = document.getElementById('resendBtn');
    
    const countdown = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(countdown);
            resendBtn.disabled = false;
            resendBtn.style.opacity = '1';
            resendBtn.style.cursor = 'pointer';
            resendBtn.innerHTML = '<i class="ti ti-refresh"></i> Kirim Ulang Kode';
        } else {
            timerElem.textContent = timeLeft;
            timeLeft -= 1;
        }
    }, 1000);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/auth/reset-password-otp.blade.php ENDPATH**/ ?>