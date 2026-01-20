@component('mail::message')
# Reset Password - Kode OTP

Halo,

Anda menerima email ini karena ada permintaan reset password untuk akun Anda di **PPDB Online**.

Gunakan kode OTP berikut untuk melanjutkan:

@component('mail::panel')
<div style="text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 8px; color: #667eea;">
{{ $otp }}
</div>
@endcomponent

**Kode ini akan kedaluwarsa dalam 10 menit.**

Jika Anda tidak meminta reset password, abaikan email ini. Akun Anda tetap aman.

Terima kasih,<br>
{{ config('app.name') }}

---
<small style="color: #999;">Email ini dikirim secara otomatis. Mohon jangan membalas email ini.</small>
@endcomponent
