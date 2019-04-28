@include('admin.header')
<title>角色管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','{{ route('admin_role_add') }}','800')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span> <span class="r">共有数据：<strong>{{$data -> count()}}</strong> 条</span> </div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="6">角色管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<th width="40">ID</th>
				<th width="200">角色名</th>
				<th>管理员列表</th>
				<th width="300">描述</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $val)
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{{$val -> id}}</td>
				<td>{{$val -> rolename}}</td>
				<td>
				@foreach( $val -> manager_name as $name)
				<u style="cursor:pointer" class="text-primary" onClick="manager_show('查看管理员','{{route('admin_manager_page')}}','{{$name -> id}}','400','450')" title="查看管理员">{{$name -> username}}</u>
				&nbsp;&nbsp;
				@endforeach
				</td>
				<td>{{$val -> description}}</td>
				<td class="f-14">
					<a title="编辑权限" href="javascript:;" onclick="admin_role_edit('权限编辑','{{route('admin_role_edit_auth')}}','{{$val -> id}}','',500)" style="text-decoration:none">
					<i class="Hui-iconfont">&#xe716;</i>
					</a>
					<a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','{{route('admin_role_edit')}}','{{$val -> id}}','',300)" style="text-decoration:none">
					<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a title="删除" href="javascript:;" onclick="admin_role_del(this,'{{$val -> id}}')" class="ml-5" style="text-decoration:none">
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
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(function(){
	//datatables初始化
	$('table').DataTable({
		"columnDefs" : [{"orderable": false,"targets":0}],
		"order": [[1,"asc"]]
	});
});

/*管理员-查看*/
function manager_show(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{ route("admin_role_delete") }}',
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