@include('admin.header')
<title>添加用户</title>
<meta name="keywords" content="">
<meta name="description" content="">
<!-- 载入webuploader.css文件 -->
<link rel="stylesheet" type="text/css" href="/admin/webuploader/webuploader.css">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="mobile" name="mobile">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户账户：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="membername" name="membername">
			</div>
		</div>
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password2" name="password2">
		</div>
	</div>
	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">用户昵称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">邮箱：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="@" name="email" id="email">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">地区：</label>
			<div class="formControls col-xs-8 col-sm-2"> <span class="select-box">
				<select class="select" size="1" name="country_id">
					<option value="" selected>国家</option>
					@foreach($country as $val)
					<option value="{{$val -> id}}">{{$val -> area}}</option>
					@endforeach
				</select>
				</span> </div>
			<div class="formControls col-xs-8 col-sm-2"> <span class="select-box">
				<select class="select" size="1" name="province_id">
					<option value="" selected>地区/省份</option>
				</select>
				</span> </div>
			<div class="formControls col-xs-8 col-sm-2"> <span class="select-box">
				<select class="select" size="1" name="city_id">
					<option value="" selected>城市</option>
				</select>
				</span> </div>
			<div class="formControls col-xs-8 col-sm-2"> <span class="select-box">
			<select class="select" size="1" name="county_id">
				<option value="" selected>区/县</option>
			</select>
			</span> </div>
		</div>
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="gender" type="radio" id="sex-1">
				<label for="sex-1" value="男">男</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2"  value="女" name="gender">
				<label for="sex-2" value="女">女</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-3" value="保密" name="gender" checked>
				<label for="sex-3" value="保密" >保密</label>
			</div>
		</div>
		</div>
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户类型：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="type" type="radio" id="type-1" checked>
				<label for="type-1" value="1">类型一</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="type-2"  value="2" name="type">
				<label for="type-2" value="2">类型二</label>
			</div>
		</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">头像：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<div id="uploader-demo">
					<!--用来存放item-->
					<div id="fileList" class="uploader-list"></div>
					<div id="filePicker">选择图片</div>
					<!-- 隐藏域存放头像地址 -->
					<input type="hidden" name="avatarUrl" id="avatarUrl" value="">
				</div>
			</div>
		</div>
		{{csrf_field()}}
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/admin/webuploader/webuploader.min.js"></script>
<script type="text/javascript">
$(function(){
	
	var $ = jQuery,
	$list = $('#fileList'),
	// 优化retina, 在retina下这个值是2
	ratio = window.devicePixelRatio || 1,

	// 缩略图大小
	thumbnailWidth = 100 * ratio,
	thumbnailHeight = 100 * ratio,

	// Web Uploader实例
	uploader;

    // 初始化Web Uploader
    uploader = WebUploader.create({

		//追加自定义的参数
		formData: {_token:"{{csrf_token()}}"},

        // 自动上传。
        auto: true,

        // swf文件路径
        swf: '/admin/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: "{{ route('webuploader') }}",

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择文件，可选。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });

    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                '</div>'
                ),
            $img = $li.find('img');
			//删除之前上传的图片预览
			$('.thumbnail').remove();
        $list.append( $li );

        // 创建缩略图
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, thumbnailWidth, thumbnailHeight );
    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	// 第二个参数是ajax的返回值
    uploader.on( 'uploadSuccess', function( file , response ) {
		$( '#'+file.id ).addClass('upload-state-done');
		//写入隐藏域
		if(response.code == 0)
		{
			layer.msg(response.msg,{icon:1,time:1500});
			$('#avatarUrl').val(response.filepath);
		}else{
			layer.msg(response.msg,{icon:2,time:1500});
		}
    });

    // 文件上传失败，现实上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });

	

	//jQuery四级联动操作
	//jQuery的联动二级
	$('select[name=country_id]').change(function(){
		// 获取当前选中的值
		var _id = $(this).val();
		$.get("{{ route('admin_user_getAreaById') }}",{id: _id},function(data){
			//初始化一个空的变量
			var _options = '';
			//循环遍历
			$.each(data,function(index,el){
				// console.log(el);
				_options += "<option value='" + el.id + "'>" + el.area + "</option>";
			});
			//先清空原有的数据(options)
			$('select[name=province_id]').find('option:gt(0)').remove();
			$('select[name=city_id]').find('option:gt(0)').remove();
			$('select[name=county_id]').find('option:gt(0)').remove();
			//将拼凑好的option追加到页面中去(province_id)
			$('select[name=province_id]').append(_options);
		},'json');
	});

	//jQuery的联动三级
	$('select[name=province_id]').change(function(){
		// 获取当前选中的值
		var _id = $(this).val();
		$.get("{{ route('admin_user_getAreaById') }}",{id: _id},function(data){
			//初始化一个空的变量
			var _options = '';
			//循环遍历
			$.each(data,function(index,el){
				// console.log(el);
				_options += "<option value='" + el.id + "'>" + el.area + "</option>";
			});
			//先清空原有的数据(options)
			$('select[name=city_id]').find('option:gt(0)').remove();
			$('select[name=county_id]').find('option:gt(0)').remove();
			//将拼凑好的option追加到页面中去(province_id)
			$('select[name=city_id]').append(_options);
		},'json');
	});

	//jQuery的联动四级
	$('select[name=city_id]').change(function(){
		// 获取当前选中的值
		var _id = $(this).val();
		$.get("{{ route('admin_user_getAreaById') }}",{id: _id},function(data){
			//初始化一个空的变量
			var _options = '';
			//循环遍历
			$.each(data,function(index,el){
				// console.log(el);
				_options += "<option value='" + el.id + "'>" + el.area + "</option>";
			});
			//先清空原有的数据(options)
			$('select[name=county_id]').find('option:gt(0)').remove();
			//将拼凑好的option追加到页面中去(province_id)
			$('select[name=county_id]').append(_options);
		},'json');
	});

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			mobile:{
				required:true,
				isMobile:true,
			},
			membername:{
				required:true,
			},
			password:{
				required:true,
				minlength:6,
			},
			password2:{
				required:true,
				minlength:6,
				equalTo: "#password"
			},
			name:{
				required:true,
			},
			email:{
				required:true,
				email:true,
			},
			uploadfile:{
				required:true,
			},
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "" ,
				dataType:"json",
				success: function(data){
					//判断是否成功
					if(data.code == '0'){
						layer.msg(data.msg,{icon:1,time:1000},function(){
							var index = parent.layer.getFrameIndex(window.name);
							// parent.$('.btn-refresh').click();
							parent.location.href = parent.location.href;
							parent.layer.close(index);
						});
					}else{
						layer.msg(data.msg,{icon:2,time:1000});
					}
					
				},
                // error: function(XmlHttpRequest, textStatus, errorThrown){
                error: function(data){
					var json = JSON.parse(data.responseText);
					alert(json.errors.name);
					// layer.msg(json.errors.name);
				}
			});			
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>