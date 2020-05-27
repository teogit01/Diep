
@if (isset($data))
@foreach($data as $index => $item)
<tr ondblclick="detail({{$item->id}})">
	<td class="stt">{{$index+1}}</td>
	<td>
		
		<img style="width: 100px;height: 150px" src='{{asset("img/products/")}}/{{json_decode($item->image)[0]}}'>
		
	</td>
	<td>{{$item->code}}</td>
	<td>{{$item->name}}</td>									
	<td  colspan="2">
		@foreach (json_decode($item->color) as $color)
		{{$color}}
		@endforeach
	</td>
	<td>{{$item->price}} đ</td>
	<td>{{$item->amount}}</td>
	<td><div class="action">
		<a href="#" onclick='del({{$item->id}})'>Xoa</a>
		<a href="#">sua</a>
	</div>
</td>
</tr>
@endforeach
@endif
