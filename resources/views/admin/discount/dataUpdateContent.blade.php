
	@if (isset($data))
	@foreach($data as $index => $item)
	<tr>
		<td class='stt'>{{$index+1}}</td>
		<td class="ma">{{$item->code}}</td>
		<td class="ten">{{$item->name}}</td>
		<td><div class="action">
				<a href="#" onclick='del({{$item->id}})'>Xoa</a>
				<a href="#">sua</a>
			</div>
		</td>
	</tr>
	@endforeach
	@endif
