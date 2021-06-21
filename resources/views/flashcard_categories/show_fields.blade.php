<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{{ $flashcardCategories->parent_id }}</p>
</div>

<!-- Second Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('second_parent_id', 'Second Parent Id:') !!}
    <p>{{ $flashcardCategories->second_parent_id }}</p>
</div>

<!-- Third Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('third_parent_id', 'Third Parent Id:') !!}
    <p>{{ $flashcardCategories->third_parent_id }}</p>
</div>

<!-- Level Field -->
<div class="col-sm-12">
    {!! Form::label('level', 'Level:') !!}
    <p>{{ $flashcardCategories->level }}</p>
</div>

<!-- Category Field -->
<div class="col-sm-12">
    {!! Form::label('category', 'Category:') !!}
    <p>{{ $flashcardCategories->category }}</p>
</div>

