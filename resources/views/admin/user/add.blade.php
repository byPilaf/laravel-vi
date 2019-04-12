@include('admin.header')
<title>添加用户</title>
<meta name="keywords" content="">
<meta name="description" content="">
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
			<div class="formControls col-xs-8 col-sm-9"> <span class="btn-upload form-group">
				<input class="input-text upload-url" type="text" name="uploadfile" id="uploadfile" readonly nullmsg="请添加附件！" style="width:200px">
				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
				<input type="file" multiple name="file-2" class="input-file">
				</span> </div>
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
<script type="text/javascript">
$(function(){
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