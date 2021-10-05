
@if ($errors->any())
<div class="alert text-center" style="background: #F1948A; color: #B03A2E;" >
    <button type="button" class="close" data-dismiss="alert">×</button>
    <ul>
      @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
       @endforeach
    </ul>
</div>
@endif


