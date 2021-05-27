<!-- Question Field -->
<div class="col-sm-12">
    {!! Form::label('question', 'Question:') !!}
    <p>{{ $flashcardQuestion->question }}</p>
</div>

<!-- Images Field -->
<div class="col-sm-12">
    {!! Form::label('images', 'Images:') !!}
    <p><img src="/flashcardfiles/images/{{ $flashcardQuestion->images }}" alt="" width="200px" height="200px"></p>
</div>

<!-- Explanation Field -->
<div class="col-sm-12">
    {!! Form::label('explanation', 'Explanation:') !!}
    <p>{{ $flashcardQuestion->explanation }}</p>
</div>

<!-- Images Explanation Field -->
<div class="col-sm-12">
    {!! Form::label('images_explanation', 'Images Explanation:') !!}
    <p><img src="/flashcardfiles/images_explanation/{{ $flashcardQuestion->images_explanation }}" alt="" width="200px" height="200px"></p>
    <p></p>
</div>

<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>Flashcard Categories</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($flashcardCategoriesQuestions as $flashcardCategoriesQuestion)
            <tr>
                <td>{{ App\Models\FlashcardCategories::find($flashcardCategoriesQuestion->flashcard_categories_id)->category }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardCategoriesQuestions.destroy', $flashcardCategoriesQuestion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardCategoriesQuestions.show', [$flashcardCategoriesQuestion->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('flashcardCategoriesQuestions.edit', [$flashcardCategoriesQuestion->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
