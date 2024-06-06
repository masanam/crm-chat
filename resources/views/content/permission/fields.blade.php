<!-- Name Field -->
<input type="hidden" name="id" id="id" class="dt-data-id">
<div class="form-group col-sm-12 p-2">
    {!! Form::label('name', 'Name:', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control dt-name','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>
<div class="form-group col-sm-12 p-2">
    {!! Form::label('code', 'Code:', ['class' => 'form-label']) !!}
    {!! Form::text('code', null, ['class' => 'form-control dt-code','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>
<div class="form-group col-sm-12 p-2">
    {!! Form::label('description', 'Description:', ['class' => 'form-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control dt-description','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('brand', 'Brand:', ['class' => 'form-label']) !!}
    {!! Form::text('brand', null, ['class' => 'form-control dt-brand','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('type', 'Type:', ['class' => 'form-label']) !!}
    {!! Form::text('type', null, ['class' => 'form-control dt-type','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-12 p-2">
    {!! Form::label('category', 'Category:', ['class' => 'form-label']) !!}
    {!! Form::text('category', null, ['class' => 'form-control dt-category','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>
<!-- Grade Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('stock', 'Stock:', ['class' => 'form-label']) !!}
    {!! Form::text('stock', null, ['class' => 'form-control dt-stock','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- School Id Field -->
<div class="form-group col-sm-12 p-2">
    {!! Form::label('price', 'Price:', ['class' => 'form-label']) !!}
    {!! Form::text('price', null, ['class' => 'form-control dt-price','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>
<div class="form-group col-sm-12 p-2">
    {!! Form::label('image', 'Image:', ['class' => 'form-label']) !!}
    {!! Form::text('image', null, ['class' => 'form-control dt-image','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>
<div class="form-group col-sm-12 p-2">
    {!! Form::label('video', 'Video:', ['class' => 'form-label']) !!}
    {!! Form::text('video', null, ['class' => 'form-control dt-video','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 p-2">
    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
</div>