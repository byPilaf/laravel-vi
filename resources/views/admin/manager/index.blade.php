@include('admin.header')
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加管理员','{{ route('admin_manager_add') }}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a></span> <span class="r">共有数据：<strong>{{ $data -> count() }}</strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="10">管理员列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">账号名</th>
				<th width="50">性别</th>
				<th width="90">手机</th>
				<th width="250">邮箱</th>
				<th width="100">角色</th>
				<th width="130">加入时间</th>
				<th width="100">是否已启用</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $val)
			<tr class="text-c">
				<td><input type="checkbox" value="{{ $val -> id }}" name="check_id"></td>
				<td>{{ $val -> id }}</td>
				<td>{{ $val -> username }}</td>
				<td>{{ $val -> gender }}</td>
				<td>{{ $val -> mobile}}</td>
				<td>{{ $val -> email}}</td>
				<td>{{ $val -> rel_role -> rolename}}</td>
				<td>{{ $val -> created_at}}</td>
				<td class="td-status">
				@if($val -> status == '1')
				<span class="label radius">已停用</span>
				@else
				<span class="label label-success radius">已启用</span>
				@endif
				</td>
				<td class="td-manage">
				@if($val -> status == '2')
					<a style="text-decoration:none" onClick="admin_stop(this,'{{ $val -> id }}')" href="javascript:;" title="停用">
						<i class="Hui-iconfont">&#xe631;</i>
					</a> 
				@else
					<a style="text-decoration:none" onClick="admin_start(this,'{{ $val -> id }}')" href="javascript:;" title="启用">
						<i class="Hui-iconfont">&#xe615;</i>
					</a>
				@endif
					<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','{{ route('admin_manager_edit') }}','{{ $val -> id }}','800','500')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a title="删除" href="javascript:;" onclick="admin_del(this,'{{ $val -> id }}')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@include('admin.footer')

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	//datatables初始化
	$('table').DataTable({
		"columnDefs" : [{"orderable": false,"targets":0}],
		"order": [[1,3,"asc"]]
	});
});
</script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/

/* 批量删除 */


/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{ route("admin_manager_delete") }}',
			data: {id:id,_token:"{{csrf_token()}}"},
			dataType: 'json',
			success: function(data){
				if(data.code == '0')
				{
					layer.msg(data.msg,{icon:1,time:1000},function(){
						// location.href = location.href;
						$(obj).parents("tr").remove();
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

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type:'POST',
			url:'{{ route("admin_manager_stop") }}',
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

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type:'POST',
			url:'{{ route("admin_manager_start") }}',
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
		// $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		// $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		// $(obj).remove();
		// layer.msg('已启用!', {icon: 6,time:1000});
	});
}
</script>
</body>
</html>