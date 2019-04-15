@include('admin.header')
<title>用户查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
	<img class="avatar size-XL l" src="{{$user -> avatarUrl}}">
	<dl style="margin-left:80px; color:#fff">
		<dt>
			<span class="f-18">{{$user -> membername}}</span>
			<span class="pl-10 f-12">余额：40</span>
		</dt>
		<dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd>
	</dl>
</div>
<div class="pd-20">
	<table class="table">
		<tbody>
			<tr>
				<th class="text-r" width="80">昵称：</th>
				<td>{{ $user -> name }}</td>
			</tr>
			<tr>
				<th class="text-r" width="80">性别：</th>
				<td>{{ $user -> gender }}</td>
			</tr>
			<tr>
				<th class="text-r">手机：</th>
				<td>{{$user -> mobile}}</td>
			</tr>
			<tr>
				<th class="text-r">邮箱：</th>
				<td>{{$user -> email}}</td>
			</tr>
			<tr>
				<th class="text-r">地址：</th>
				<td>
					@foreach($area as $val)
					{{$val}}
					@endforeach
				</td>
			</tr>
			<tr>
				<th class="text-r">注册时间：</th>
				<td>{{$user -> created_at}}</td>
			</tr>
			<!-- <tr>
				<th class="text-r">积分：</th>
				<td>330</td>
			</tr> -->
		</tbody>
	</table>
</div>
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本-->
</body>
</html>