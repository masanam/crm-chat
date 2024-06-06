<!-- Name Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('name', 'First Name:', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control dt-name1','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('name', 'Last Name:', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control dt-name2','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>


<!-- Grade Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('grade', 'Role:', ['class' => 'form-label']) !!}
    {!! Form::select('role', $roles->pluck('name', 'id'), null, ['class' => 'form-select dt-team']) !!}
</div>

<!-- School Id Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('school_id', 'Dealer:', ['class' => 'form-label']) !!}
    {!! Form::select('dealer', $dealers->pluck('name', 'id'), null, ['class' => 'form-select dt-team']) !!}
</div>

<!-- School Id Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('school_id', 'Team:', ['class' => 'form-label']) !!}
    {!! Form::select('team', $teams->pluck('name', 'id'), null, ['class' => 'form-select dt-team']) !!}

</div>

<div class="form-group col-sm-12 p-2">
    <label class="form-label" for="user-plan">Select Plan</label>
    <select id="user-plan" class="form-select">
        <option value="basic">Basic</option>
        <option value="enterprise">Enterprise</option>
        <option value="company">Company</option>
        <option value="team">Team</option>
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 p-2">
    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
</div>