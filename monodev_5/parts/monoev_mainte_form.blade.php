<form class="delf" action="{{$self}}" method="post">
	@if($notres)
	@if($logfilename)<input type="hidden" name="logfilename" value="{{$logfilename}}">@endif
	@if($catalog_pageno)<input type="hidden" name="catalog_pageno" value="{{$catalog_pageno}}">@endif
	@if($mode_catalog)<input type="hidden" name="mode_catalog" value="on">@endif
	@endif
	@if($resno)
	@if($resno)<input type="hidden" name="thread_no" value="@if($oya[0][0]['no']){{$oya[0][0]['no']}}@endif">@endif
	@endif
	<p>
		No <input class="form" type="number" min="1" name="del[]" value="" autocomplete="off">
		<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
		Pass <input class="form" type="password" name="pwd" value="" autocomplete="current-password">
		<select class="form" name="mode" tabindex="1">
			<option value="edit" selected>編集</option>
			@if($userdel)
			<option value="usrdel">削除</option>
			@endif
		</select>
		<label>[<input type="checkbox" name="onlyimgdel" value="on">ImageOnly]</label>
		<input class="button" type="submit" value=" OK ">
		<span class="stylechanger">Style: 
			<select class="form" id="mystyle" onchange="SetCss(this);">
				<option>DEV</option>
				<option>Dark</option>
				<option>Deep</option>
				<option>MAYO</option>
				<option>MONO</option>
				<option>REITA</option>
			</select>
		</span>
	</p>
</form>
