<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name EN:') !!}
    {!! Form::text('name:en', null, ['class' => 'form-control','maxlength' => 50]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name AR:') !!}
    {!! Form::text('name:ar', null, ['class' => 'form-control','maxlength' => 50]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description EN:') !!}
    {!! Form::text('description:en', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description AR:') !!}
    {!! Form::text('description:ar', null, ['class' => 'form-control']) !!}
</div>
