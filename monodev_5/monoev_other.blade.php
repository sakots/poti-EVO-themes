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
			<a href="{{$home}}" target="_top">[ホーム]</a>
			<a href="{{$self}}?mode=admin">[管理モード]</a>
		</div>
		<hr>
		<div>
			<nav class="menu">
				<a href="{{$self2}}">[トップ]</a>
				@if($for_new_post)
				<a href="{{$self}}?mode=newpost">[投稿]</a>
				@endif
				<a href="{{$self}}?mode=catalog">[カタログ]</a>
				<a href="{{$self}}">[通常モード]</a>
				<a href="{{$self}}?mode=piccom">[投稿途中の絵]</a>
				<a href="#footer" title="一番下へ">[↓]</a>
			</nav>
		</div>
		<hr>
		{{-- <!-- 変則的に管理者お絵かきモードをここにも挿入 --> --}}
		@if($post_mode)
		@if($regist)
		<script type="text/javascript" src="loadcookie.js"></script>
		@endif
		@if($admin)@if($rewrite)@else
		<div class="epost">

			{{-- ペイントフォーム --}}
			@include('parts.monoev_paint_form',['admin'=>$admin])

		</div>
		@endif @endif
		@endif
		{{-- <!-- 管理者お絵かきモードおわり --> --}}
	</header>
	<main>
		@if($post_mode)
		{{-- ========== POST MODE(投稿モード) start ========== --}}
		{{-- 【NEW(新規投稿)、OEKAKI(お絵かき投稿)、UPDATE(編集)】 --}}

		<section>
			<div class="thread">
				<h2 class="oekaki">投稿フォーム @if($admin) - ADMIN MODE-@endif</h2>
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
								<input class="button" type="submit" value="送信する">
								@if($regist)
								<input type="hidden" name="mode" value="regist">
								@endif
								{{-- <!--モード指定:編集--> --}}
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
								<!--レスお絵かき対応-->
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
								<small>(記事の編集削除用)</small></td>
						</tr>
						@endif
					</table>
					@if($regist)
					<ul>
						@if($upfile)
						<li>添付可能ファイルはGIF, JPG, PNG, WEBPです。</li>
						<li>画像は幅 {{$maxw}}px、高さ {{$maxh}}pxを超えると縮小表示されます。</li>
						<li>最大投稿データ量は {{$maxkb}} KB までです。sage機能付き。</li>
						@endif
						@if($rewrite)
						<li>編集では クッキーは保存されません。さらにsageを入れても位置は変わりません。</li>
						<li>最大投稿データ量は {{$maxkb}} KB までです。sage機能付き。</li>
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
		<!-- (========== POST MODE(投稿モード) end ==========) -->
		@endif
		@if($admin_in)
		<!-- (========== ADMIN MODE -LOGIN-(管理モード(認証)) start ==========) -->
		<section>
			<div class="thread">
				<h2 class="oekaki">管理モード</h2>
				<form action="{{$self}}" method="post" class="adminin">
					<label><input type="radio" name="admin" value="update" checked>ログ更新</label>
					<label><input type="radio" name="admin" value="del">記事削除</label>
					<label><input type="radio" name="admin" value="post">管理人投稿</label>
					<input type="hidden" name="mode" value="admin">
					<input class="form" type="password" name="pass">
					<input class="button" type="submit" value="ADMIN IN">
				</form>
			</div>
		</section>
		<!-- (========== ADMIN MODE -LOGIN-(管理モード(認証)) end ==========) -->
		@endif
		@if($admin_del)
		<!-- (========== ADMIN MODE -DELETE-(管理モード(削除)) start ==========) -->
		<section>
			<div class="thread">
				<h2 class="oekaki">管理モード</h2>
				<form action="{{$self}}" method="post">
					<input type="hidden" name="admin" value="update">
					<input type="hidden" name="mode" value="admin">
					<input type="hidden" name="pass" value="{{$pass}}">
					<input type="submit" value="ログ更新" class="button">
					htmlファイルの更新を行います
				</form>
				<hr>
				<form action="{{$self}}" method="post" class="delmode">
					<input type="hidden" name="mode" value="admin">
					<input type="hidden" name="admin" value="del">
					<input type="hidden" name="pass" value="{{$pass}}">
					<p>削除したい記事のチェックボックスにチェックを入れ、削除ボタンを押して下さい。</p>
					<input class="button" type="submit" value="削除">
					<input class="button" type="reset" value="リセット">
					<label>[<input type="checkbox" name="onlyimgdel" value="on">ImageOnly]</label>
					<table class="delfo">
						<tr>
							<th>Check</th>
							<th>No</th>
							<th>Time</th>
							<th>題名</th>
							<th>名前</th>
							<th>コメント</th>
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
					<input class="button" type="submit" value="削除">
					<input class="button" type="reset" value="リセット">
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
		{{-- <!-- (========== ADMIN MODE -DELETE-(管理モード(削除)) end ==========) --> --}}
		@endif
		@if($err_mode)
		{{-- <!-- (========== ERROR MODE(エラー画面) start ==========) --> --}}
		<section>
			<div class="thread">
				<h2 class="oekaki">ERROR</h2>
				<p class="err">{!!$mes!!}</p>
				<p><a href="#" onclick="javascript:window.history.back(-1);return false;">[もどる]</a></p>
			</div>
		</section>
		{{-- <!-- (========== ERROR MODE(エラー画面) end ==========) --> --}}
		@endif
	</main>
	<footer>
		{{-- <!-- 著作権表示 削除しないでください --> --}}
		@include('parts.monoev_copyright')
	</footer>
	<script src="{{$skindir}}jquery-3.5.1.min.js"></script>
	<script>
		window.onpageshow = function () {
			var $btn = $('[type="submit"]');
			//disbledを解除
			$btn.prop('disabled', false);
			$btn.click(function () { //送信ボタン2度押し対策
				$(this).prop('disabled', true);
				$(this).closest('form').submit();
			});
		}
	</script>
</body>

</html>