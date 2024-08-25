<!-- Name Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('customer_name', 'Customer Name:', ['class' => 'form-label']) !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control dt-customer-name','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Grade Field -->
<div class="form-group col-sm-12 p-2">
    <label for="phone" class="form-label">Whatsapp:</label>
    <input class="form-control dt-phone" maxlength="255" name="phone" type="number" id="phone">
</div>

<!-- Course Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('location', 'Location:', ['class' => 'form-label']) !!}
    {!! Form::text('location', null, ['class' => 'form-control dt-location','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- School Id Field -->
<div class="form-group col-sm-12 p-2">
    <label for="age" class="form-label">Age:</label>
    <input class="form-control dt-age" maxlength="255" name="age" type="number" id="age">
</div>

<!-- Phone Field -->
<div class="form-group col-sm-12 p-2">
    <label for="gender" class="form-label">Gender:</label>
    <select class="dt-gender select2 form-select" name="gender" id="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="None">None</option>
    </select>
</div>

<div class="form-group col-sm-12 p-2">
    <label for="income_level" class="form-label">Income Level:</label>
    <select class="dt-income-level select2 form-select" name="income_level" id="income_level">
        <option value="A">Type A</option>
        <option value="B">Type B</option>
        <option value="C">Type C</option>
        <option value="Uncategorized">Uncategorized</option>
    </select>
</div>

<div class="form-group col-sm-12 p-2">
    <label for="job_title" class="form-label">Job Title:</label>
    <select class="dt-job-title select2 form-select" name="job_title" id="job_title">
        @foreach ($list_job as $key => $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 p-2">
    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
</div>