<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{asset('template-login/style.css')}}" />
        <title>Sign in & Sign up Form</title>
        <link rel="shortcut icon" href="/sejawat-logo-mobile.png">
    </head>
    <body>
        <div class="container">
            <div class="forms-container">
                <div class="signin-signup">
                    <form  action="{{ url('/login') }}" method="POST" class="sign-in-form">
                        @csrf
                        <h2 class="title">Sign in</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" />
                        </div>
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Password" name="password"  class="@error('password') is-invalid @enderror"/>
                        </div>
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="submit" value="Login" class="btn solid" />
                         
                    </form>
                    <form  method="post" action="{{ route('register') }}" class="sign-up-form">
                        <h2 class="title">Sign up</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" class="@error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Full name">
                        </div>
                        @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror" placeholder="Email">
                        </div>
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password"
                            class="@error('password') is-invalid @enderror" placeholder="Password">
                        </div>
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Retype password">
                        </div>
                        <input type="submit" class="btn" value="Sign up" />
                    </form>
                </div>
            </div>

            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>New here ?</h3>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, ex ratione. Aliquid!
                        </p>
                        <button class="btn transparent" id="sign-up-btn">
                            Sign up
                        </button>
                    </div>
                    <img src="template-login/img/log.svg" class="image" alt="" />
                </div>
                <div class="panel right-panel">
                    <div class="content">
                        <h3>One of us ?</h3>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum laboriosam ad deleniti.
                        </p>
                        <button class="btn transparent" id="sign-in-btn">
                            Sign in
                        </button>
                    </div>
                    <img src="template-login/img/register.svg" class="image" alt="" />
                </div>
            </div>
        </div>

        <script src="{{asset('template-login/app.js')}}"></script>
    </body>
</html>
