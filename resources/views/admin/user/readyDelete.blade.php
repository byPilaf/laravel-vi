@include('admin.header')
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span style="width:105px" class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> 
		<a href="javascript:;" onclick="export_excel()" class="btn btn-success radius"><i class="Hui-iconfont">&#xe644;</i> 导出到 Excel</a></span> 
		<span class="r">共有数据：<strong>{{$data -> count()}}</strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="90">手机</th>
				<th width="80">用户账户</th>
				<th width="100">用户昵称</th>
				<th width="150">邮箱</th>
				<th width="40">用户类型</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $val)
			<tr class="text-c">
				<td><input type="checkbox" value="{{$val -> id}}" name="del_id[]"></td>
				<td>{{$val -> id}}</td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{$val -> membername}}','{{route('admin_user_page')}}','{{$val -> id}}','500','600')">{{$val -> mobile}}</u></td>
				<td>{{$val -> membername}}</td>
				<td>{{$val -> name}}</td>
				<td>{{$val -> email}}</td>
				<td>{{$val -> type}}</td>
				<td class="td-manage">
					<a title="彻底删除" href="javascript:;" onclick="member_del(this,'{{ $val -> id }}')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
</div>
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,7]}// 制定列不参与排序
		]
	});
	
});

/*导出Excel */
function export_excel(){
	//只需要将跳转地址转到导出页面
	location.href = "{{route('admin_user_exportDeleteManager')}}";
}

/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}

/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type:'POST',
			url:'{{ route("admin_user_stop") }}',
			data:{id:id,_token:"{{csrf_token()}}"},
			dataType:"json",
			success: function(data){
				if(data.code == '0')
				{
					layer.msg(data.msg,{icon:1,time:1000},function(){
						location.href = location.href;
					});
				}
				else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
			},
			error: function(){
				layer.msg('停用请求失败',{icon:2,time:1000});
			},
		});
	});
}


/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type:'POST',
			url:'{{ route("admin_user_start") }}',
			data:{id:id,_token:"{{csrf_token()}}"},
			dataType:"json",
			success: function(data){
				if(data.code == '0')
				{
					layer.msg(data.msg,{icon:1,time:1000},function(){
						location.href = location.href;
					});
				}
				else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
			},
			error: function(){
				layer.msg('启用请求失败',{icon:2,time:1000});
			},
		});
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{ route("admin_user_foreverDeleteManager") }}',
			data: {id:id,_token:"{{csrf_token()}}"},
			dataType: 'json',
			success: function(data){
				if(data.code == '0')
				{
					layer.msg(data.msg,{icon:1,time:1000},function(){
						location.href = location.href;
						// $(obj).parents("tr").remove();
					});
				}
				else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
				// $(obj).parents("tr").remove();
				// layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

</script> 
</body>
</html>