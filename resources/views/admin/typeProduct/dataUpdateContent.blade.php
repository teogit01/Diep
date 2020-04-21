<?php session_start();
// Nếu click vào nút Lưu Session
	if (isset($_POST['save-session']))
	{
    	// Lưu Session
    	$_SESSION['name'] = $_POST['username'];
	}
?>

	@if (isset($data))
	@foreach($data as $index => $item)
	<tr>
		<td class='stt'>{{$index+1}}</td>
		<td class="ma">{{$item->id}}</td>
		<td class="ten">{{$item->ten}}</td>
		<td><div class="action">
				<a href="#" onclick='del({{$item->id}})'>Xoa</a>
				<a href="#">sua</a>
			</div>
		</td>
	</tr>
	@endforeach
	@endif
