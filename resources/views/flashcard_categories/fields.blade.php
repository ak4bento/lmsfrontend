<!-- Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', 'Level:') !!}
    <select onchange="onChangeLevel()" name="level" class="form-control select2" id="level" style="width: 100%;">
        <option value="1">
            Level 1
        </option>
        <option value="2">
            Level 2
        </option>
        <option value="3">
            Level 3
        </option>
        <option value="4">
            Level 4
        </option>
    </select>
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6" id="one" style="display: none;">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <select name="parent_id" class="form-control select2" id="parent_id" style="width: 100%;">
        <option value="">Pilih</option>
        @foreach (App\Models\FlashcardCategories::where('level',1)->get() as $item)
        <option value="{{ $item->id }}">
            {{ $item->category }}
        </option>
        @endforeach
    </select>

</div>

<!-- Second Parent Id Field -->
<div class="form-group col-sm-6 col-lg-6" id="two" style="display: none;">
    {!! Form::label('second_parent_id', 'Second Parent Id:') !!}
    <select name="second_parent_id" class="form-control select2" id="second_parent_id" style="width: 100%;">
        <option value="">Pilih</option>

        @foreach (App\Models\FlashcardCategories::where('level',2)->get() as $item)
        <option value="{{ $item->id }}">
            {{ $item->category }}
        </option>
        @endforeach
    </select>
</div>

<!-- Third Parent Id Field -->
<div class="form-group col-sm-6 col-lg-6" id="three" style="display: none;">
    {!! Form::label('third_parent_id', 'Third Parent Id:') !!}
    <select name="third_parent_id" class="form-control select2" id="third_parent_id" style="width: 100%;">
        <option value="">Pilih</option>

        @foreach (App\Models\FlashcardCategories::where('level',3)->get() as $item)
        <option value="{{ $item->id }}">
            {{ $item->category }}
        </option>
        @endforeach
    </select>
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::text('category', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

@push('page_scripts')
<script type="text/javascript">
    function onChangeLevel() {
        var x = document.getElementById("level").value;
        console.log('ini change : ', x);
        if(x == 1){ 
            document.getElementById("one").setAttribute("style", "display:none");
            document.getElementById("two").setAttribute("style", "display:none");
            document.getElementById("three").setAttribute("style", "display:none");
        } else if(x == 2){
            document.getElementById("one").setAttribute("style", "display:inline");
            document.getElementById("two").setAttribute("style", "display:none");
            document.getElementById("three").setAttribute("style", "display:none");
        }else if(x == 3){
            document.getElementById("one").setAttribute("style", "display:inline");
            document.getElementById("two").setAttribute("style", "display:inline");
            document.getElementById("three").setAttribute("style", "display:none");
        }
        else if(x == 4){
            document.getElementById("one").setAttribute("style", "display:inline");
            document.getElementById("two").setAttribute("style", "display:inline");
            document.getElementById("three").setAttribute("style", "display:inline");
        }
    }
</script>

@endpush