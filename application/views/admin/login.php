<!DOCTYPE html>
<html lang="en"><script id="tinyhippos-injected">if (window.top.ripple) { window.top.ripple("bootstrap").inject(window, document); }</script>
<head>
    <meta charset="UTF-8">
    <title>AdminCP Login</title>
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="<?=base_url('assets/css/light-bootstrap-dashboard.css')?>" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link href="<?=base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/pe-icon-7-stroke.css')?>" rel="stylesheet">
	
	<script src="<?=base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/jquery-ui.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>

	<script src="<?=base_url('assets/js/jquery.validate.min.js')?>"></script>
	<script src="<?=base_url('assets/js/moment.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-datetimepicker.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-selectpicker.js')?>"></script>
	<script src="<?=base_url('assets/js/bootstrap-checkbox-radio-switch-tags.js')?>"></script>
	<script src="<?=base_url('assets/js/chartist.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-notify.js')?>"></script>
	<script src="<?=base_url('assets/js/sweetalert2.js')?>"></script>
	<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>"></script>
	<script src="<?=base_url('assets/ckeditor/config.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery-jvectormap.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.bootstrap.wizard.min.js')?>"></script>
	<script src="<?=base_url('assets/js/bootstrap-table.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery.datatables.js')?>"></script>
    <script src="<?=base_url('assets/js/fullcalendar.min.js')?>"></script>
	<script src="<?=base_url('assets/js/light-bootstrap-dashboard.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.sharrre.js')?>"></script>
    <script src="<?=base_url('assets/js/demo.js')?>"></script>
</head>

<body> 

<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">    
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="<?=base_url('assets/img/POH_Official_Logo.png')?>" width="180px"></a>
        </div>
        <div class="collapse navbar-collapse">       
            
            <ul class="nav navbar-nav navbar-right">
                <li>
                   
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="purple" data-image="<?=base_url('assets/img/full-screen-image-2.jpg')?>">   
        
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">                   
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form method="POST" action="">
                            
                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card">
                                <div class="header text-center">Login</div>
                                <div class="content">
                                    <div class="form-group">
                                        <label>Email đăng nhập</label>
                                        <input name="email" type="email" required="" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input name="pass" type="password" required="" placeholder="Password" class="form-control" style="border-radius: 0">
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="checkbox">
                                            <span class="icons"><span class="first-icon fa fa-square-o"></span><span class="second-icon fa fa-check-square-o"></span></span>
											<input type="checkbox" data-toggle="checkbox" value="" name="remember_me">
                                            Remember me
                                        </label>    
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-fill btn-warning btn-wd">Login</button>
                                </div>
                            </div>
                                
                        </form>
                                
                    </div>                    
                </div>
            </div>
        </div>
    	
    	<footer class="footer footer-transparent">
            <div class="container">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    © 2018 <a href="http://akanice.com">CRTEAM</a> - Made for poh.vn
                </p>
            </div>
        </footer>

    <div class="full-page-background" style="background-image: url('<?=base_url('assets/img/full-screen-image-3.jpg')?>"></div></div>                             
       
</div>

</body>

