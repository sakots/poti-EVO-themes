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
	<style>
		.input_disp_none {
			display: none;
		}
	</style>

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

	<title>{{$title}}</title>
	@if($notres)
	{{-- このあたりは各自変更してもらえると嬉しいです
詳しい意味はgoogle先生に訊いてください。 --}}
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="">
	<meta property="og:site_name" content="">
	<meta property="og:title" content="{{$title}}">
	<meta property="og:type" content="article">
	<meta property="og:description" content="">
	<meta property="og:image" content="{{$rooturl}}{{$skindir}}img/og.png">
	<meta property="og:image:width" content="1028">
	<meta property="og:image:height" content="1028">
	<meta property="og:url" content="{{$rooturl}}">
	<meta name="description" content="">
	@endif
	@if($resno)
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="">
	<meta property="og:site_name" content="">
	<meta property="og:title"
		content="[{{$oya[0][0]['no']}}] {{$oya[0][0]['sub']}} by {{$oya[0][0]['name']}} - {{$title}}">
	<meta property="og:type" content="article">
	<meta property="og:description" content="{{$oya[0][0]['descriptioncom']}}">
	<meta property="og:url" content="{{$rooturl}}{{$self}}?res={{$oya[0][0]['no']}}">
	@if ($oya[0][0]['src'])
	<meta property="og:image" content="{{$rooturl}}{{$oya[0][0]['imgsrc']}}" />
	<meta property="og:description" content="{{$oya[0][0]['descriptioncom']}}" />
	@endif
	@endif
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
	<header id="header">
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
				[通常モード]
				<a href="{{$self}}?mode=piccom">[投稿途中の絵]</a>
				<a href="#footer" title="一番下へ">[↓]</a>
			</nav>
			<hr>
			@if($resno)
			@if($form)
			<p class="resm">
				レス送信モード
				@if($resname)
				<script>
					function add_to_com() {
						document.getElementById("p_input_com").value +=
							"{!! htmlspecialchars($resname,ENT_QUOTES,'utf-8') !!}{{$_san}}";
					}
				</script>
				{{-- コピーボタン  --}}
				<button class="copy_button" onclick="add_to_com()">投稿者名をコピー</button>
				@endif
			</p>
			<hr>
			@endif
			@endif
			@if($paintform)
			@if($paint and ($resno or !$diary))

			@if($resno)
			<p class="resm">お絵かきレス</p>
			<hr>
			@endif
			<div class="epost">

				{{-- ペイントボタン --}}
				<form action="{{$self}}" method="post" enctype="multipart/form-data">
					<p>
						幅：<input name="picw" type="number" title="幅" class="form" value="{{$pdefw}}" min="300"
							max="{{$pmaxw}}">
						高さ：<input name="pich" type="number" title="高さ" class="form" value="{{$pdefh}}" min="300"
							max="{{$pmaxh}}">
						@if($select_app)
						ツール:
						<select name="shi">
							<option value="neo">PaintBBS NEO</option>
							@if($use_shi_painter)<option value="1" class="for_pc">しぃペインター</option>@endif
							@if($use_chickenpaint)<option value="chicken">ChickenPaint</option>@endif
							@if($use_klecks)<option value="klecks">Klecks</option>@endif
						</select>
						@else
						{{-- <!-- 選択メニューを出さない時に起動するアプリ --> --}}
						<input type="hidden" name="shi" value="neo">
						@endif

						@if($use_select_palettes)
						パレット：<select name="selected_palette_no" title="パレット"
							class="form">{!!$palette_select_tags!!}</select>
						@endif
						@if($resno)
						<input type="hidden" name="resto" value="{{$resno}}">
						@endif
						@if($anime)<label><input type="checkbox" value="true" name="anime" title="動画記録"
								@if($animechk){{$animechk}}@endif>動画記録</label>@endif
						<input type="hidden" name="mode" value="paint">
						<input class="button" type="submit" value="お絵かき">
					</p>
				</form>
				@endif
				@if ($notres and (!$diary or $addinfo))
				<ul>
					@if ($paint2 and !$diary)
					<li>お絵かきできる画像のサイズは幅 300～{{$pmaxw}}、高さ 300～{{$pmaxh}}の範囲内です。</li>
					<li>画像は幅 {{$maxw}}px、高さ {{$maxh}}pxを超えると縮小表示されます。</li>
					@endif
					{!!$addinfo!!}
				</ul>
				@endif	
			</div>
			@endif
			@if($form)
			<div>
				<form action="{{$self}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="token" value="@if($token){{$token}}@endif">
					<input type="hidden" name="mode" value="regist">
					@if($resno)<input type="hidden" name="resto" value="{{$resno}}">@endif
					<input type="hidden" name="MAX_FILE_SIZE" value="{{$maxbyte}}">
					<table>
						<tr>
							<td>Name @if($usename){{$usename}}@endif</td>
							<td><input class="form" type="text" name="name" size="28" value="" autocomplete="username">
							</td>
						</tr>
						<tr>
							<td>Mail</td>
							<td><input class="form" type="text" name="email" size="28" value="" autocomplete="email">
							</td>
						</tr>
						<tr>
							<td>URL</td>
							<td><input class="form" type="text" name="url" size="28" autocomplete="url"></td>
						</tr>
						<tr>
							<td>Sub @if($usesub){{$usesub}}@endif</td>
							<td>
								<input class="form" type="text" name="sub" size="20" value="@if($resub){{$resub}}@endif"
									autocomplete="section-sub">
								<input class="button" type="submit" value="送信する">
							</td>
						</tr>
						<tr>
							<td>Com @if($usecom){{$usecom}}@endif</td>
							<td><textarea class="form" name="com" cols="28" rows="4" wrap="soft"
									id="p_input_com"></textarea></td>
						</tr>
						@if($upfile)
						<tr>
							<td>UpFile</td>
							<td>
								<input class="form" type="file" name="upfile" accept="image/*">
								<span class="preview"></span>
							</td>
						</tr>
						@endif
						<tr>
							<td>Pass</td>
							<td><input class="form" type="password" name="pwd" value=""
									autocomplete="current-password"><small>(記事の編集削除用)</small></td>
						</tr>
					</table>
					<ul>
						@if($upfile)
						@if($resno)
						@endif
						<li>添付可能ファイルはGIF, JPG, PNG, WEBPです。</li>
						<li>画像は幅 {{$maxw}}px、高さ {{$maxh}}pxを超えると縮小表示されます。</li>
						@endif
						<li>最大投稿データ量は {{$maxkb}} KB までです。sage機能付き。</li>
						{!!$addinfo!!}
					</ul>
				</form>
			</div>
			@endif
		</div>
	</header>

	<main>
		<section>
			{{-- スレッドのループ --}}
			@foreach ($oya as $i=>$ress)
			<div class="thread">

				@if(isset($ress) and !@empty($ress))
				@foreach ($ress as $res)
				{{-- 記事表示 --}}
				@if ($loop->first)
				{{-- 最初のループ --}}
				{{-- レスモードの時 --}}
				@if($resno)
				<h2><span class="oyano">[{{$res['no']}}]</span> {{$res['sub']}}</h2>
				@else
				<h2><a href="{{$self}}?res={{$res['no']}}"><span class="oyano">[{{$res['no']}}]</span>
						{{$res['sub']}}</a></h2>
				@endif
				{{-- 親記事のヘッダ --}}
				<h3>
					<span class="name"><a
							href="search.php?page=1&amp;imgsearch=on&amp;query={{$res['encoded_name']}}&amp;radio=2"
							target="_blank" rel="noopener">{{$res['name']}}</a></span><span
						class="trip">{{$res['trip']}}</span> :
					{{$res['now']}}@if($res['id']) ID : {{$res['id']}}@endif @if($res['url']) <span class="url">[<a
							href="{{$res['url']}}" target="_blank" rel="nofollow noopener noreferrer">URL</a>]</span>
					@endif @if($res['updatemark']){{$res['updatemark']}}@endif
				</h3>
				<hr>
				@else
				<hr>
				{{-- 子レス --}}
				<div class="res">
					{{-- 子レスヘッダ --}}
					<h4>
						<span class="oyaresno">[{{$res['no']}}]</span>
						<span class="rsub">{{$res['sub']}}</span> :
						<span class="name"><a
								href="search.php?page=1&amp;imgsearch=on&amp;query={{$res['encoded_name']}}&amp;radio=2"
								target="_blank" rel="noopener">{{$res['name']}}</a></span><span
							class="trip">{{$res['trip']}}</span> : {{$res['now']}}@if($res['id']) ID :
						{{$res['id']}}@endif @if($res['url']) <span class="url">[<a href="{{$res['url']}}"
								target="_blank" rel="nofollow noopener noreferrer">URL</a>]</span>@endif
						@if($res['updatemark']) {{$res['updatemark']}}@endif
					</h4>
				{{-- 子レスヘッダここまで --}}
				@endif
					{{-- 親子共通 --}}
					@if($res['src'])
					<div class="img_info_wrap">
						<a href="{{$res['src']}}" title="{{$res['sub']}}" target="_blank">{{$res['srcname']}}</a>
						({{$res['size']}} B)
						@if($res['thumb']) - サムネイル表示中 - @endif @if($res['painttime']) PaintTime :
						{{$res['painttime']}}@endif
						<br>
						@if($res['continue']) <a
							href="{{$self}}?mode=continue&amp;no={{$res['continue']}}">●続きを描く</a>@endif
						@if($res['spch'])<span class="for_pc">@endif @if($res['pch']) <a
								href="{{$self}}?mode=openpch&amp;pch={{$res['pch']}}" target="_blank">●動画</a>@endif
							@if($res['spch'])</span>@endif
					</div>
					<figure @if($res['w']>=750) style="float:none;margin-right:0"@endif>
						@if($res['thumb'])
						<a href="{{$res['src']}}" target="_blank" rel="noopener">
							@endif
							<img src="{{$res['imgsrc']}}" alt="{{$res['sub']}} by {{$res['name']}}"
								title="{{$res['sub']}} by {{$res['name']}}" width="{{$res['w']}}"
								height="{{$res['h']}}" loading="lazy">
							@if($res['thumb'])
						</a>
						@endif
					</figure>
					@endif
					<div class="comment_wrap">
						<p>{!!$res['com']!!}</p>
						{{-- 親のコメント部分 --}}
						@if ($loop->first)
						@if ($res['skipres'])
						<hr>
						<div class="article_skipres">レス{{$res['skipres']}}件省略中。</div>
						@endif
					</div>
					@endif
					{{-- 子レスなら --}}
					@if (!$loop->first)
				</div>
			</div>
			@endif
			@endforeach
			@endif
			<div class="thfoot">
				<hr>
				@if($sharebutton)
				{{-- シェアボタン --}}
				<span class="share_button">
					<a target="_blank"
						href="https://twitter.com/intent/tweet?&text=%5B{{$ress[0]['encoded_no']}}%5D%20{{$ress[0]['share_sub']}}%20by%20{{$ress[0]['share_name']}}%20-%20{{$encoded_title}}&url={{$encoded_rooturl}}{{$encoded_self}}?res={{$ress[0]['encoded_no']}}"><span
							class="icon-twitter button"><img src="{{$skindir}}img/twitter.svg" alt=""> tweet</span></a>
					<a target="_blank" class="fb btn"
						href="http://www.facebook.com/share.php?u={{$encoded_rooturl}}{{$encoded_self}}?res={{$ress[0]['encoded_no']}}"><span
							class="icon-facebook2 button"><img src="{{$skindir}}img/facebook.svg" alt="">
							share</span></a>
				</span>
				@endif
				@if($notres)<span class="button"><a href="{{$self}}?res={{$ress[0]['no']}}"><img
							src="{{$skindir}}img/rep.svg" alt="">@if($ress[0]['disp_resbutton']) 返信 @else
						 表示 @endif</a></span>@endif
				<a href="#header" title="上へ">[&uarr;]</a>
			</div>
			</div>
			@endforeach
			{{-- スレッドループここまで --}}
		</section>
	</main>


	<footer id="footer">
		<div>

			<nav>
				@if($resno)
				<div class="pcdisp page">

					@if($res_prev)<a href="{{$self}}?res={{$res_prev['no']}}">≪{{$res_prev['substr_sub']}}</a>@endif
					| <a href="{{$self2}}">Top</a> |
					@if($res_next)<a href="{{$self}}?res={{$res_next['no']}}">
						{{$res_next['substr_sub']}}≫</a>@endif
				</div>

				<div class="mobiledisp">
					@if($res_prev)
					Prev: <a href="{{$self}}?res={{$res_prev['no']}}">{{$res_prev['sub']}}</a>
					<br>
					@endif
					@if($res_next)
					Next: <a href="{{$self}}?res={{$res_next['no']}}">{{$res_next['sub']}}</a>
					<br>
					@endif
				</div>

				@if($view_other_works)
				<div class="view_other_works">
					@foreach($view_other_works as $view_other_work)<div><a
							href="{{$self}}?res={{$view_other_work['no']}}"><img src="{{$view_other_work['imgsrc']}}" alt="{{$view_other_work['sub']}} by {{$view_other_work['name']}}" title="{{$view_other_work['sub']}} by {{$view_other_work['name']}}" width="{{$view_other_work['w']}}" height="{{$view_other_work['h']}}" loading="lazy"></a></div>@endforeach
				</div>
				@endif

				@endif

				@if($notres)

				{{-- 前、次のナビゲーション --}}
				@include('parts.monoev_prev_next')

				@endif
			</nav>
			{{-- <!-- メンテナンスフォーム欄 --> --}}
			@include('parts.monoev_mainte_form')

			<script src="loadcookie.js"></script>
			<script>
				l(); //LoadCookie
			</script>
		</div>
		{{-- <!-- 著作権表示 削除しないでください --> --}}
		@include('parts.monoev_copyright')
	</footer>
	<script src="{{$skindir}}jquery-3.5.1.min.js"></script>
	<script>
		colorIdx = GetCookie('colorIdx');
		document.getElementById("mystyle").selectedIndex = colorIdx;

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