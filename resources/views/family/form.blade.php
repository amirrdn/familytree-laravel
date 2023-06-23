<div class=" g-3">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        {{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name', 'required', 'placeholder' => 'Input nama']) }}
    </div>
    <div class="mb-3">
        <label for="parent" class="form-label">Parent</label>
        {{-- {!! Form::select('parent', $family, null ,array('required','class'=>'form-control')) !!} --}}
        <select class="form-control" name="parent">
            <option value="0" 
                @if($vfamily && $vfamily->parent === 0)
                    {{'selected'}}
                @endif
            >No Paretn</option>
            @foreach($family as $b)
                <option value="{{$b->id}}"
                    @if($vfamily && $vfamily->parent === $b->id)
                        {{'selected'}}
                    @endif    
                >{{$b->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        {!! Form::select('gender', array('1' => 'Male','2' => 'Female','0' => 'Gender'), $gender ,array('required','class'=>'form-control')) !!}
    </div>
    <div class="mb-3">
        <button class="btn btn-sm btn-primary float-end">Submit</button>
    </div>
</div>