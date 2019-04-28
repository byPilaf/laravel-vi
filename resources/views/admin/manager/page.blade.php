@include('admin.header')
<title>用户查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
	<dl style="color:#fff">
		<dt>
			<span class="f-18">{{$manager -> username}}</span>
		</dt>
	</dl>
</div>
<div class="pd-20">
	<table class="table">
		<tbody>
			<tr>
				<th class="text-r" width="80">账号：</th>
				<td>{{ $manager -> username }}</td>
			</tr>
			<tr>
				<th class="text-r" width="80">性别：</th>
				<td>{{ $manager -> gender }}</td>
			</tr>
			<tr>
				<th class="text-r">手机：</th>
				<td>{{$manager -> mobile}}</td>
			</tr>
			<tr>
				<th class="text-r">邮箱：</th>
				<td>{{$manager -> email}}</td>
			</tr>
			<tr>
				<th class="text-r">注册时间：</th>
				<td>{{$manager -> created_at}}</td>
			</tr>
		</tbody>
	</table>
</div>
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本-->
</body>
</html>