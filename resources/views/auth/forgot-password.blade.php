@extends('layouts.auth')

@section('title', 'Lupa Password - PPDB')

@section('content')
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
                        <i class="ti ti-lock-question" style="font-size: 36px; color: white;"></i>
                    </div>
                    <h2 class="text-white mb-2" style="font-weight: 700; margin: 0; letter-spacing: -0.5px;">Lupa Password?</h2>
                    <p class="text-white" style="margin: 0; opacity: 0.9; font-size: 14px; font-weight: 300;">Masukkan email terdaftar untuk menerima kode OTP</p>
                </div>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div style="padding: 40px 30px;">
                    @if ($errors->any())
                        <div style="background: linear-gradient(135deg, #fee 0%, #fdd 100%); border-radius: 12px; padding: 15px; margin-bottom: 20px; border-left: 4px solid #dc3545; color: #721c24;">
                            @foreach ($errors->all() as $error)
                                <div style="margin: 5px 0;"><i class="ti ti-alert-circle"></i> {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    @if (session('success'))
                        <div style="background: linear-gradient(135deg, #dff0d8 0%, #d0e8d0 100%); border-radius: 12px; padding: 15px; margin-bottom: 20px; border-left: 4px solid #28a745; color: #155724;">
                            <i class="ti ti-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    <!-- Email Input -->
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333; font-size: 14px;">Email Address</label>
                        <div style="display: flex; border-radius: 12px; overflow: hidden; border: 2px solid #e0e0e0; transition: all 0.3s ease; background: #f8f9fa;">
                            <span style="background: transparent; border: none; padding: 14px 16px; color: #667eea; font-size: 18px;">
                                <i class="ti ti-mail"></i>
                            </span>
                            <input type="email" class="form-control" name="email" 
                                placeholder="nama@email.com"
                                value="{{ old('email') }}" autocomplete="off" required
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
                            <i class="ti ti-send"></i> Kirim Kode OTP
                        </button>
                    </div>

                    <!-- Divider -->
                    <div style="text-align: center; margin-bottom: 18px; position: relative;">
                        <span style="color: #999; font-size: 13px; background: white; padding: 0 10px; position: relative;">atau</span>
                        <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #e0e0e0; z-index: -1;"></div>
                    </div>

                    <!-- Back to Login -->
                    <div>
                        <a href="{{ route('login') }}" style="width: 100%; display: block; text-align: center; background: rgba(102, 126, 234, 0.08); color: #667eea; border-radius: 12px; border: 2px solid rgba(102, 126, 234, 0.2); padding: 14px 20px; font-weight: 600; transition: all 0.3s ease; cursor: pointer; text-decoration: none; box-sizing: border-box; font-size: 15px;"
                            onmouseover="this.style.background='rgba(102, 126, 234, 0.15)'; this.style.borderColor='#667eea';"
                            onmouseout="this.style.background='rgba(102, 126, 234, 0.08)'; this.style.borderColor='rgba(102, 126, 234, 0.2)';">
                            <i class="ti ti-arrow-left"></i> Kembali ke Login
                        </a>
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
@endsection
