<!-- Name Field -->
<input type="hidden" name="id" id="id" class="dt-data-id">
<div class="form-group col-sm-12 p-2">
    {!! Form::label('project_id', 'Project:', ['class' => 'form-label']) !!}
    {!! Form::text('project_id', null, ['class' => 'form-control dt-project','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('user_id', 'User:', ['class' => 'form-label']) !!}
    {!! Form::text('user_id', null, ['class' => 'form-control dt-user','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('status_id', 'Status:', ['class' => 'form-label']) !!}
    {!! Form::text('status_id', null, ['class' => 'form-control dt-status','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('title', 'Title:', ['class' => 'form-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control dt-title','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('deadline', 'Deadline:', ['class' => 'form-label']) !!}
    {!! Form::text('deadline', null, ['class' => 'form-control dt-deadline','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>
<!-- Grade Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('description', 'Description:', ['class' => 'form-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control dt-description','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- School Id Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('priority', 'Priority:', ['class' => 'form-label']) !!}
    {!! Form::text('priority', null, ['class' => 'form-control dt-priority','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 p-2">
    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
</div>