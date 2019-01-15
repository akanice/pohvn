<div class="content">
    <div class="container-fluid">
        <div class="row">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                <div class="col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Tạo mới</h4>
                        </div>
                        <div class="content">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control username-search" name="meta_keywords">
                                </div>
                                <div class="btn btn-primary btn-fill btn-search">Search</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">List User Available</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-1">ID</div>
                                        <div class="col-md-3">Username</div>
                                        <div class="col-md-4">Email</div>
                                        <div class="col-md-2">Phone</div>
                                        <div class="col-md-2">Action</div>
                                    </div>
                                    <div class="row list-users"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
                                    <a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        var $ = jQuery.noConflict();

        function IsJsonString (str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }


        var $c = 0;
        jQuery(document).ready(function ($) {
            var count = <?php echo $c = 0; ?>;
            $(".add_package").click(function () {
                count = count + 1;
                $('#output-package').append('\
			<div class="package-item clearfix"> \
				<div class="col-sm-3"><input type="text" class="form-control" name="pricingPackage[' + count + '][packitemfrom]" value="" /></div>\
				<div class="col-sm-3"><input type="text" class="form-control" name="pricingPackage[' + count + '][packitemto]" value="" /></div>\
				<div class="col-sm-5"><input type="text" class="form-control" name="pricingPackage[' + count + '][packdetails]" value="" /></div>\
				<div class="col-sm-1"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>\
			</div>');
                return false;
            });
            $(document.body).on('click', '.remove-package', function () {
                $(this).closest('div.package-item').remove();
            });

            $('.btn-search').on('click', function () {
                var usernameSearch = $('.username-search').val();
                $.ajax({
                    type: "POST",
                    url: "http://poh.com/admin/ajax/searchUser",
                    data: {'username': usernameSearch},
                    //dataType: 'JSON',
                    cache: false,
                    success: function (res) {
                        if (!IsJsonString(res)) return;
                        var usersData = JSON.parse(res);
                        var container = $('.list-users');
                        for (var i in usersData) {
                            var userData = usersData[i];
                            var htmlData = '<div class="col-md-1" user-id="' + userData.id + '">' + userData.id +
                                '</div><div class="col-md-3" user-id="' + userData.id + '">' + userData.name +
                                '</div><div class="col-md-4" user-id="' + userData.id + '">' + userData.email +
                                '</div><div class="col-md-2" user-id="' + userData.id + '">' + userData.phone +
                                '</div><div class="col-md-2" user-id="' + userData.id + '"><div class="btn btn-primary add-new-affi-user" user-id="' + userData.id + '">Add</div></div>';
                            container.append(htmlData);
                        }
                    }
                });
            });

            $('.list-users').on('click', '.add-new-affi-user', function () {
                var userId = $(this).attr('user-id');
                $.ajax({
                    type: "POST",
                    url: "http://poh.com/admin/ajax/addAffiUser",
                    data: {'id': userId},
                    //dataType: 'JSON',
                    cache: false,
                    success: function (res) {
                        if(res != 'false'){
                            alert('user add success');
                            window.location.replace("/admin/affiliate/users");
                        }
                    }
                });
                return false;
            })
        });
    </script>
