<div style="max-width: 50%">
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <div class="text-center">
                                    <h4>Sign In</h4>
                                    <p>Sign In to your account</p>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="inputEmail" class="form-label">Phone or Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="inputEmail">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="inputPassword">
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input"
                                        id="loginModalCheck1">
                                    <label class="form-check-label" for="loginModalCheck1">Remember
                                        Me</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 text-end">
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="col-12 text-center">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <div class="">
                                    <br>
                                    <span>Don’t have an account? </span><a href="{{ route('login') }}"
                                        style="font-size: 18px; color:#2874F0">Sign Up Now!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
