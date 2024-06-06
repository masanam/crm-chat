<!-- Name Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('name', 'Name:', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control dt-name','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Grade Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('grade', 'Email:', ['class' => 'form-label']) !!}
    {!! Form::text('grade', null, ['class' => 'form-control dt-email','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- School Id Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('school_id', 'Phone:', ['class' => 'form-label']) !!}
    {!! Form::text('course', null, ['class' => 'form-control dt-phone','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 p-2">
    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
</div>