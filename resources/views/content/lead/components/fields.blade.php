<!-- Name Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('customer_name', 'Customer Name:', ['class' => 'form-label']) !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control dt-customer-name','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Grade Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('phone', 'Whatsapp:', ['class' => 'form-label']) !!}
    {!! Form::text('phone', null, ['class' => 'form-control dt-phone','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Course Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('location', 'Location:', ['class' => 'form-label']) !!}
    {!! Form::text('location', null, ['class' => 'form-control dt-location','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- School Id Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('age', 'Age:', ['class' => 'form-label']) !!}
    {!! Form::text('age', null, ['class' => 'form-control dt-age','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('gender', 'Gender:', ['class' => 'form-label']) !!}
    {!! Form::text('gender', null, ['class' => 'form-control dt-gender','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('income_level', 'Income Level:', ['class' => 'form-label']) !!}
    {!! Form::text('income_level', null, ['class' => 'form-control dt-income-level','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('job_title', 'Job Title:', ['class' => 'form-label']) !!}
    {!! Form::text('job_title', null, ['class' => 'form-control dt-job-title','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 p-2">
    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
</div>