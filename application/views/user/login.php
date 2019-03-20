<div class="wrapper wrapper-full-page white-bg">        
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row justify-content-md-center">                   
                    <div class="col-md-4 col-sm-6 py-3 px-md-5 border" style="margin:30px 0">
                        <h3 class="center">Đăng nhập</h3>
						<form method="POST" action="">
							<p><?=@$error;?></p>
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input name="email" type="email" required="" placeholder="Email" class="form-control">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Mật khẩu</label>
								<input name="pass" type="password" required="" placeholder="Mật khẩu" class="form-control">
							</div>
							<div class="form-group form-check">
								<input type="checkbox" data-toggle="checkbox" value="" name="remember_me" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1">Nhớ tôi</label>
							</div>
							<button type="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt"></i> Đăng nhập</button>
							<a href="/dang-ky" class="btn btn-info"><i class="fa fa-clipboard"></i> Đăng ký</a>
						</form>
                    </div>                    
                </div>
            </div>
        </div>
	</div>                             
</div>