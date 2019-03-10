<div class="wrapper wrapper-full-page white-bg">        
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row justify-content-md-center">                   
                    <div class="col-md-4 col-sm-6 py-3 px-md-5 border" style="margin:30px 0">
                        <h3 class="center">Đăng ký</h3>
						<form method="POST" action="">
							<div class="form-group">
								<label for="inputName">Họ tên của bạn</label>
								<input name="name" type="text" required="" placeholder="Họ tên" class="form-control" id="inputName">
							</div>
							<div class="form-group">
								<label for="inputAddress">Địa chỉ</label>
								<input name="address" type="text" required="" placeholder="địa chỉ" class="form-control" id="inputAddress">
							</div>
							<div class="form-group">
								<label for="inputPhone">Số điện thoại</label>
								<input name="phone" type="text" required="" placeholder="điện thoại" class="form-control" id="inputPhone">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input name="email" type="email" required="" placeholder="Email" class="form-control">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Mật khẩu</label>
								<input name="pass" type="password" required="" placeholder="Mật khẩu" class="form-control">
							</div>
							<p><?=@$error;?></p>
							<button type="submit" class="btn btn-success" style="width:100%"><i class="fa fa-clipboard"></i> Đăng ký</button>
						</form>
                    </div>                    
                </div>
            </div>
        </div>
	</div>                             
</div>