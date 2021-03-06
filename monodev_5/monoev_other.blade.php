<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="{{$skindir}}css/mono_dev.css">
	<link rel="stylesheet" href="{{$skindir}}css/mono_dark.css" id="css1" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_deep.css" id="css2" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_mayo.css" id="css3" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_main.css" id="css4" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_reita.css" id="css5" disabled>

	<script>
		var colorIdx = GetCookie("_monodev_colorIdx");
		switch (Number(colorIdx)) {
			case 1:
				document.getElementById("css1").removeAttribute("disabled");
				break;
			case 2:
				document.getElementById("css2").removeAttribute("disabled");
				break;
			case 3:
				document.getElementById("css3").removeAttribute("disabled");
				break;
			case 4:
				document.getElementById("css4").removeAttribute("disabled");
				break;
			case 5:
				document.getElementById("css5").removeAttribute("disabled");
				break;
		}

		function SetCss(obj) {
			var idx = obj.selectedIndex;
			SetCookie("_monodev_colorIdx", idx);
			window.location.reload();
		}

		function GetCookie(key) {
			var tmp = document.cookie + ";";
			var tmp1 = tmp.indexOf(key, 0);
			if (tmp1 != -1) {
				tmp = tmp.substring(tmp1, tmp.length);
				var start = tmp.indexOf("=", 0) + 1;
				var end = tmp.indexOf(";", start);
				return (decodeURIComponent(tmp.substring(start, end)));
			}
			return ("");
		}

		function SetCookie(key, val) {
			document.cookie = key + "=" + encodeURIComponent(val) + ";max-age=31536000;";
		}
	</script>

	<style>
		.del_page form {
			display: inline-block;
		}

		.del_page {
			margin: 6px 0;
			display: inline-block;
		}
	</style>
	<title>{{$title}}</title>
	<style id="for_mobile"></style>
	<script>
		function is_mobile() {
			if (navigator.maxTouchPoints && (window.matchMedia && window.matchMedia('(max-width: 768px)').matches))
			return true;
			return false;
		}
		if (is_mobile()) {
			document.getElementById("for_mobile").textContent = ".for_pc{display: none;}";
		}
	</script>

</head>

<body>
	<header>
		<h1><a href="{{$self2}}">{{$title}}</a></h1>
		<div>
			<a href="{{$home}}" target="_top">[?????????]</a>
			<a href="{{$self}}?mode=admin">[???????????????]</a>
		</div>
		<hr>
		<div>
			<nav class="menu">
				<a href="{{$self2}}">[?????????]</a>
				@if($for_new_post)
				<a href="{{$self}}?mode=newpost">[??????]</a>
				@endif
				<a href="{{$self}}?mode=catalog">[????????????]</a>
				<a href="{{$self}}">[???????????????]</a>
				<a href="{{$self}}?mode=piccom">[??????????????????]</a>
				<a href="#footer" title="????????????">[???]</a>
			</nav>
		</div>
		<hr>
		{{-- <!-- ??????????????????????????????????????????????????????????????? --> --}}
		@if($post_mode)
		@if($regist)
		<script type="text/javascript" src="loadcookie.js"></script>
		@endif
		@if($admin)@if($rewrite)@else
		<div class="epost">

			{{-- ???????????????????????? --}}
			@include('parts.monoev_paint_form',['admin'=>$admin])

		</div>
		@endif @endif
		@endif
		{{-- <!-- ??????????????????????????????????????? --> --}}
	</header>
	<main>
		@if($post_mode)
		{{-- ========== POST MODE(???????????????) start ========== --}}
		{{-- ???NEW(????????????)???OEKAKI(??????????????????)???UPDATE(??????)??? --}}

		<section>
			<div class="thread">
				<h2 class="oekaki">?????????????????? @if($admin) - ADMIN MODE-@endif</h2>
				@if($pictmp)
				<div class="tmpimg">
					@if($notmp)
					<p>Not OEKAKI image</p>
					@endif
					@if($tmp)
					<div>
						@foreach ($tmp as $tmpimg)
						<figure>
							<img src="{{$tmpimg['src']}}">
							<figcaption>{{$tmpimg['srcname']}}[{{$tmpimg['date']}}]</figcaption>
						</figure>
						@endforeach
					</div>
					@endif
				</div>
				@endif
				<hr class="hr">
				@if($ptime)<p class="ptime">PaintTime : {{$ptime}}</p>
				@endif
				<form class="" action="{{$self}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="token" value="{{$token}}">

					<table>
						<tr>
							<td>Name @if($usename){{$usename}}@endif</td>
							<td><input class="form" type="text" name="name" size="28" autocomplete="username" @if($name)
									value="{{$name}}" @endif></td>
						</tr>
						<tr>
							<td>Mail</td>
							<td><input class="form" type="text" name="email" size="28" autocomplete="email" @if($email)
									value="{{$email}}" @endif></td>
						</tr>
						<tr>
							<td>URL</td>
							<td>
								<input class="form" type="text" name="url" size="28" autocomplete="url" @if($url)
									value="{{$url}}" @endif></td>
						</tr>
						<tr>
							<td>Sub @if($usesub){{$usesub}}@endif</td>
							<td>
								<input class="form" type="text" name="sub" size="20" autocomplete="section-sub"
									@if($sub) value="{{$sub}}" @endif>
								<input class="button" type="submit" value="????????????">
								@if($regist)
								<input type="hidden" name="mode" value="regist">
								@endif
								{{-- <!--???????????????:??????--> --}}
								@if($rewrite)
								<input type="hidden" name="mode" value="rewrite">
								@if($thread_no)<input type="hidden" name="thread_no" value="{{$thread_no}}">@endif
								@if($logfilename)<input type="hidden" name="logfilename" value="{{$logfilename}}">@endif
								@if($mode_catalog)<input type="hidden" name="mode_catalog"
									value="{{$mode_catalog}}">@endif
								@if($catalog_pageno)<input type="hidden" name="catalog_pageno"
									value="{{$catalog_pageno}}">@endif
								@if(!$catalog_pageno)<input type="hidden" name="catalog_pageno" value="0">@endif
								<input type="hidden" name="no" value="{{$rewrite}}">
								<input type="hidden" name="pwd" value="{{$pwd}}">
								@endif
								@if($admin)
								<input type="hidden" name="admin" value="{{$admin}}">
								@endif
								@if($pictmp)
								<input type="hidden" name="pictmp" value="{{$pictmp}}">
								@endif
								@if($ptime)
								<input type="hidden" name="ptime" value="{{$ptime}}">
								@endif
								<!--????????????????????????-->
								@if($resno)
								<input type="hidden" name="resto" value="{{$resno}}">
								@endif
								<input type="hidden" name="MAX_FILE_SIZE" value="{{$maxbyte}}">
								@if($ipcheck)Checking IP address ...@endif
							</td>
						</tr>
						<tr>
							<td>com @if($usecom){{$usecom}}@endif</td>
							<td><textarea class="form" name="com" cols="48" rows="4"
									wrap="soft">@if($com){{$com}}@endif</textarea></td>
						</tr>
						@if($upfile)
						<tr>
							<td>UpFile</td>
							<td><input class="form" type="file" name="upfile" size="35" accept="image/*">
							</td>
						</tr>
						@endif
						@if($tmp)
						@php 
						rsort($tmp);
						@endphp
		
						<tr>
							<td>Images</td>
							<td><select name="picfile">
									@foreach ($tmp as $tmpimg)
									<option value="{{$tmpimg['srcname']}}">{{$tmpimg['srcname']}}</option>
									@endforeach
								</select></td>
						</tr>
						@endif
						@if($regist)
						<tr>
							<td>Pass</td>
							<td><input class="form" type="password" name="pwd" value="" autocomplete="current-password">
								<small>(????????????????????????)</small></td>
						</tr>
						@endif
					</table>
					@if($regist)
					<ul>
						@if($upfile)
						<li>???????????????????????????GIF, JPG, PNG, WEBP?????????</li>
						<li>???????????? {{$maxw}}px????????? {{$maxh}}px??????????????????????????????????????????</li>
						<li>??????????????????????????? {{$maxkb}} KB ???????????????sage???????????????</li>
						@endif
						@if($rewrite)
						<li>???????????? ????????????????????????????????????????????????sage?????????????????????????????????????????????</li>
						<li>??????????????????????????? {{$maxkb}} KB ???????????????sage???????????????</li>
						@endif
					</ul>
					@endif
				</form>
				@if($regist)
				<script type="text/javascript">
					l(); //LoadCookie
				</script>
				@endif
			</div>
		</section>
		<!-- (========== POST MODE(???????????????) end ==========) -->
		@endif
		@if($admin_in)
		<!-- (========== ADMIN MODE -LOGIN-(???????????????(??????)) start ==========) -->
		<section>
			<div class="thread">
				<h2 class="oekaki">???????????????</h2>
				<form action="{{$self}}" method="post" class="adminin">
					<label><input type="radio" name="admin" value="update" checked>????????????</label>
					<label><input type="radio" name="admin" value="del">????????????</label>
					<label><input type="radio" name="admin" value="post">???????????????</label>
					<input type="hidden" name="mode" value="admin">
					<input class="form" type="password" name="pass">
					<input class="button" type="submit" value="ADMIN IN">
				</form>
			</div>
		</section>
		<!-- (========== ADMIN MODE -LOGIN-(???????????????(??????)) end ==========) -->
		@endif
		@if($admin_del)
		<!-- (========== ADMIN MODE -DELETE-(???????????????(??????)) start ==========) -->
		<section>
			<div class="thread">
				<h2 class="oekaki">???????????????</h2>
				<form action="{{$self}}" method="post">
					<input type="hidden" name="admin" value="update">
					<input type="hidden" name="mode" value="admin">
					<input type="hidden" name="pass" value="{{$pass}}">
					<input type="submit" value="????????????" class="button">
					html????????????????????????????????????
				</form>
				<hr>
				<form action="{{$self}}" method="post" class="delmode">
					<input type="hidden" name="mode" value="admin">
					<input type="hidden" name="admin" value="del">
					<input type="hidden" name="pass" value="{{$pass}}">
					<p>??????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>
					<input class="button" type="submit" value="??????">
					<input class="button" type="reset" value="????????????">
					<label>[<input type="checkbox" name="onlyimgdel" value="on">ImageOnly]</label>
					<table class="delfo">
						<tr>
							<th>Check</th>
							<th>No</th>
							<th>Time</th>
							<th>??????</th>
							<th>??????</th>
							<th>????????????</th>
							<th>Host</th>
							<th>Image (size)</th>
							<th>MD5</th>
						</tr>
						@foreach ($dels as $del)
						<tr>
							<td><input type="checkbox" name="del[]" value="{{$del['no']}}"></td>
							<td>{{$del['no']}}</td>
							<td>{{$del['now']}}</td>
							<td>{{$del['sub']}}</td>
							<td>{!!$del['name']!!}</td>
							<td>{{$del['com']}}</td>
							<td>{{$del['host']}}</td>
							<td>@if($del['clip']){!!$del['clip']!!}({{$del['size']}})byte @endif</td>
							<td>@if($del['clip']){{$del['chk']}}@endif</td>
						</tr>
						@endforeach
					</table>
					<input class="button" type="submit" value="??????">
					<input class="button" type="reset" value="????????????">
				</form>
				@if($del_pages)
				@foreach($del_pages as $del_page)
				<span class="del_page">[
					<form action="{{$self}}" method="post" id="form_page{{$del_page['no']}}">
						<input type="hidden" name="mode" value="admin">
						<input type="hidden" name="admin" value="del">
						<input type="hidden" name="pass" value="{{$pass}}">
						<input type="hidden" name="del_pageno" value="{{$del_page['no']}}">
						@if($del_page['notlink'])
						{{$del_page['pageno']}}
					</form>
					]</span>
				@else
				<a href="javascript:form_page{{$del_page['no']}}.submit()">{{$del_page['pageno']}}</a></form>
				]</span>
				@endif

				@endforeach
				@endif



				<p>&lt;&lt;Image all size : {{$all}} KB &gt;&gt;</p>
			</div>
		</section>
		{{-- <!-- (========== ADMIN MODE -DELETE-(???????????????(??????)) end ==========) --> --}}
		@endif
		@if($err_mode)
		{{-- <!-- (========== ERROR MODE(???????????????) start ==========) --> --}}
		<section>
			<div class="thread">
				<h2 class="oekaki">ERROR</h2>
				<p class="err">{!!$mes!!}</p>
				<p><a href="#" onclick="javascript:window.history.back(-1);return false;">[?????????]</a></p>
			</div>
		</section>
		{{-- <!-- (========== ERROR MODE(???????????????) end ==========) --> --}}
		@endif
	</main>
	<footer>
		{{-- <!-- ??????????????? ?????????????????????????????? --> --}}
		@include('parts.monoev_copyright')
	</footer>
	<script src="{{$skindir}}jquery-3.5.1.min.js"></script>
	<script>
		window.onpageshow = function () {
			var $btn = $('[type="submit"]');
			//disbled?????????
			$btn.prop('disabled', false);
			$btn.click(function () { //???????????????2???????????????
				$(this).prop('disabled', true);
				$(this).closest('form').submit();
			});
		}
	</script>
</body>

</html>